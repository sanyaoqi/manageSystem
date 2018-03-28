/**
 * Created by Administrator on 18-3-19.
 */

require("./ReturnConfig");
// var edge = require('edge-js');
var AipFace = require('baidu-aip-sdk').face; //这个‘baidu-ai’就是上面自定义的package.json中名字
var fs = require('fs');
var MySQL  = require('../mysql/MySQL').MySQL;
var mysql = new MySQL();

exports.readAttMacList = function (req, callback) {
    var readAtt = edge.func({
//     assemblyFile: 'SDK/IFace_x64/AccessControl/TestLibrary/bin/Debug/TestLibrary.dll',             // assemblyFile为dll路径
//     atypeName: 'TestLibrary.Startup',   // RockyNamespace为命名空间，Study为类名
        assemblyFile: 'SDK/IFace/TestLibrary.dll',             // assemblyFile为dll路径
        atypeName: 'TestLibrary.Startup',   // RockyNamespace为命名空间，Study为类名
        methodName: 'GetGeneralLogData'                     //Connect_Net GetGeneralLogData GetAllUserInfo
    });

// s为传递方法传递的参数，result为方法返回的结果
    readAtt ({"IP": attMachineIP,"Port": attMachinePort}, function (error, result) {
        if (error) {
            callback(returnWrong(error));
            return;
        }
        console.log("result --->>>", result);
        if (typeof result[0] == 'string') {
            callback(returnWrong(result.message));
        }
        else {
            // 插入数据
            mysql.db.query(
                'SELECT * FROM db_ars.tbl_attendance order by aid desc limit 1;',
                function selectCb(err, results, fields) {
                    console.log(err, results);
                    if (err) {
                        callback(returnWrong(err));
                    }
                    if(results) {
                        var sql = "INSERT INTO `db_ars`.`tbl_attendance` (`uid`,`type`,`date`,`created_at`) VALUES ";
                        var index = 0;
                        if (results.length) {
                            var att = results[0];
                            var date = att.date;
                            for (var i = 0; i < result.length; i ++) {
                                var idate = new Date(result[i].date);
                                if (idate.getTime()/1000 > att.date) {
                                    index = i;
                                    break;
                                }
                            }
                        }
                        for (var i = index; i < result.length; i ++) {
                            var idate = new Date(result[i].date);
                            sql += "(" + result[i].sdwEnrollNumber + ", " + result[i].idwVerifyMode + "," + idate.getTime()/1000 + "," + new Date().getTime()/1000 + ")";
                            if (i != result.length - 1) {
                                sql += ",";
                            }
                            else {
                                sql += ";";
                            }
                        }
                        console.log(sql);
                    }
                }
            );

            //插入新数据（多条）：INSERT INTO `db_ars`.`tbl_attendance` (`uid`,`type`,`date`,`created_at`) VALUES(1,1,1514736000,1521646049),(2,2,1514736000,1521646049),(3,1,1514736000,1521646049);
            callback(returnRight({}));
        }
    });
};


exports.receivePicture = function (req, callback) {
    // console.log("req.body --->>>", req.body);
    var file = req.body.images;

    //读取待识别图像并base64编码
    var bitmap = fs.readFileSync('testImg/006.png'); // 相对于app.js
    var base64str1 = new Buffer(bitmap).toString('base64');
    var bitmap2 = fs.readFileSync('testImg/002.jpeg'); // 相对于app.js
    var base64str2 = new Buffer(bitmap2).toString('base64');

    var client = new AipFace(APP_ID, API_KEY, SECRET_KEY);
    client.multiIdentify(groupId, file, {"detect_top_num": "10"}).then(function(result) {
        console.log(result);
        console.log(JSON.stringify(result));
        var arr = result.result;
        var dataBuffer = new Buffer(file, 'base64');
        var time = new Date().getTime()/1000;
        var path = imagePath + time + ".jpg";

        for (var i = 0; i < result.result_num; i ++) {
            if (arr[i].scores[0] > 80) {
                console.log(arr[i].uid, ", i see you !\ni see you !\ni see you !\ni see you !\n", new Date());
                // 记录签到一次 先判断短时间内有没有这记录 TODO
                fs.writeFile(
                    path,
                    dataBuffer,
                    function(err) {
                        if(err){
                            console.log(err);
                        }else{
                            console.log("保存成功！");
                        }
                    });
                mysql.db.query(
                    //若非员工，插入新数据：INSERT INTO `db_ars`.`tbl_guests` (`created_at`, `uuid`, `image`, `status`) VALUES ( '1521725598', '111111', 'http://xxxx.xxx.xxx/xxxxxxx', '0');
                    "INSERT INTO `db_ars`.`xxx` (`created_at`, `uuid`, `image`, `status`) VALUES ( " + time + ", " + arr[i].uid + ", " + path + ", '0');",
                    function selectCb(err, results, fields) {
                        console.log(err, results);
                        if (err) {
                            callback(returnWrong(err));
                        }
                        if(results) {
                            callback(returnRight({}));
                        }
                    }
                )
            }
            else {
                // 记录陌生人来访
                client.detect(file, {"face_fields":"faceshape,qualities"}).then(function(result) {
                    var arrDetect = result.result;
                    for (var i = 0; i < result.result_num; i ++) {
                        if (arrDetect[i].face_probability > 0.999 && arrDetect[i].blur < 0.7 && arrDetect[i].type.human > 0.999) {
                            console.log("detect ------>>>>>>>>", result);
                            console.log("detect ------>>>>>>>>", JSON.stringify(result));
                            console.log("i don't know who are you !", new Date());
                            fs.writeFile(
                                path,
                                dataBuffer,
                                function(err) {
                                    if(err){
                                        console.log(err);
                                    }else{
                                        console.log("保存成功！");
                                    }
                                });
                            return;
                        }
                        else {
                            console.log("花了，不算！");
                        }
                    }
                }).catch(function(err) {
                    // 如果发生网络错误
                    console.log(err);
                });
            }
        }
        callback(returnRight(result));
    }).catch(function(err) {
        // 如果发生网络错误
        console.log(err);
    });
};