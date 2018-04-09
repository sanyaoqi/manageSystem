/**
 * Created by Administrator on 18-3-19.
 */

require("./ReturnConfig");
var edge = require('edge-js');
var AipFace = require('baidu-aip-sdk').face; //这个‘baidu-ai’就是上面自定义的package.json中名字
var fs = require('fs');
var MySQL  = require('../mysql/MySQL').MySQL;
var mysql = new MySQL();
var attConfigJson = require('../public/json/config.json');

exports.readAttMacList = function (req, callback) {
    console.log(attConfigJson);
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
            callback(returnWrong(result[0]));
        }
        else {
            // 插入数据
            mysql.db.query(
                'SELECT * FROM db_ars.tbl_attendance where type=0 order by aid desc limit 1;',
                function selectCb(err, results, fields) {
                    console.log(err, results);
                    if (err) {
                        callback(returnWrong(err));
                    }
                    if(results) {
                        var date = "";
                        if (results.length) {
                            // date = new Date( results[0].created_at * 1000 );//.转换成毫秒
                            date = results[0].created_at;//.转换成毫秒
                            console.log( date );
                        }
                        var index = 0;
                        if (date != "") {
                            for (var i = 0; i < result.length; i ++) {
                                var idate = new Date(result[i].date);
                                if (idate.getTime()/1000 > date) {
                                    index = i;
                                    break;
                                }
                            }
                        }
                        console.log(index , result.length);
                        findNewAttendance(index, result.length, result, function(res){
                            callback(res);
                        });
                    }
                }
            );

            //插入新数据（多条）：INSERT INTO `db_ars`.`tbl_attendance` (`uid`,`type`,`date`,`created_at`) VALUES(1,1,1514736000,1521646049),(2,2,1514736000,1521646049),(3,1,1514736000,1521646049);
//            callback(returnRight({}));
        }
    });
};

function findNewAttendance(index, length, arr, callback) {
    if (index == length) {
        callback(returnRight({}));
    }
    else {
        // 查找当天该用户有没有签到，有的话算签退，没有的话，插入签到
        console.log(index, "  findNewAttendance -----------------------------------------------   findNewAttendance");
        var idate = new Date(arr[index].date);
        var day = new Date(arr[index].date.split(" ")[0]);
        mysql.db.query(
            'SELECT * FROM db_ars.tbl_attendance where date=' + parseInt(day.getTime()/1000) + ' and uid=' + arr[index].sdwEnrollNumber,
            function selectCb(err, results, fields) {
                console.log(err, results);
                if (err) {
                    callback(returnWrong(err));
                }
                if(results) {
                    if (results.length) {
                        // 有数据 算做签退
                        addGoAwayData(results[0], arr[index], function(res){
                            if (res) {
                                findNewAttendance(index + 1, length, arr, callback);
                            }
                        })
                    }
                    else {
                        // 没数据，判断一下是签退还是签到
                        var middle = new Date(arr[index].date.split(" ")[0] + ' ' + attConfigJson['1'].middle);
                        if (idate.getTime() > middle.getTime()) {
                            // 算签退
                            addTwoData(arr[index], function(res){
                                if (res) {
                                    findNewAttendance(index + 1, length, arr, callback);
                                }
                            });
                        }
                        else {
                            insertData(arr[index], function(res){
                                if (res) {
                                    findNewAttendance(index + 1, length, arr, callback);
                                }
                            });
                        }
                    }
                }
            }
        );
    }
}

function insertData(data, callback) {
    console.log("insertData -------------------------------------------   insertData");
    var sql = "INSERT INTO `db_ars`.`tbl_attendance` (`uid`,`type`,`date`,`created_at`) VALUES ";
    var idate = new Date(data.date);
    var day = new Date(data.date.split(" ")[0]);
    sql += "(" + data.sdwEnrollNumber + ", " + "0" + "," + parseInt(day.getTime()/1000) + "," +  parseInt(idate.getTime()/1000) + ")";
    console.log("insertData --->>> ", sql);
    mysql.db.query(
        sql,
        function selectCb(err, results, fields) {
            console.log(err, results);
            if (err) {
                callback(false);
            }
            if(results) {
                callback(true);
            }
        }
    );
}

function addGoAwayData(result, data, callback) {
    // result 是签到数据，data是签退数据 先查找是否有签退的，没有插入，有就更新
    console.log("addGoAwayData -----------------------------------------------   addGoAwayData");
    mysql.db.query(
        'SELECT * FROM db_ars.tbl_go_away where aid=' + result.aid,
        function selectCb(err, results, fields) {
            console.log(err, results);
            if (err) {
                callback(false);
            }
            if(results) {
                if (results.length) {
                    // 有数据 更新
                    console.log("addGoAwayData -----更新");
                    callback(true);
                }
                else {
                    // 没数据，插入
                    var sql = "INSERT INTO `db_ars`.`tbl_go_away` (`aid`,`uid`,`type`,`date`,`created_at`) VALUES ";
                    var idate = new Date(data.date);
                    var day = new Date(data.date.split(" ")[0]);
                    sql += "(" + result.aid + ", " + data.sdwEnrollNumber + ", " + "0" + "," + parseInt(day.getTime()/1000) + "," +  parseInt(idate.getTime()/1000) + ")";
                    console.log("addGoAwayData --->>> ", sql);
                    mysql.db.query(
                        sql,
                        function selectCb(err, results, fields) {
                            console.log(err, results);
                            if (err) {
                                callback(false);
                            }
                            if(results) {
                                callback(true);
                            }
                        }
                    );
                }
            }
        }
    );
}

function addTwoData(data, callback) {
    console.log("addTwoData -------------------------------------------   addTwoData");
    var sql = "INSERT INTO `db_ars`.`tbl_attendance` (`uid`,`type`,`date`,`created_at`) VALUES ";
    var idate = new Date(data.date.split(" ")[0] + ' ' + attConfigJson['1'].start);
    var day = new Date(data.date.split(" ")[0]);
    sql += "(" + data.sdwEnrollNumber + ", " + "3" + "," + parseInt(day.getTime()/1000) + "," +  parseInt(idate.getTime()/1000) + ")";
    console.log("addTwoData --->>> ", sql);
    mysql.db.query(
        sql,
        function selectCb(err, results, fields) {
            console.log(err, results);
            if (err) {
                callback(false);
            }
            if(results) {
                sql = "INSERT INTO `db_ars`.`tbl_go_away` (`aid`,`uid`,`type`,`date`,`created_at`) VALUES ";
                idate = new Date(data.date);
                day = new Date(data.date.split(" ")[0]);
                sql += "(" + results.insertId + ", " + data.sdwEnrollNumber + ", " + "0" + "," + parseInt(day.getTime()/1000) + "," +  parseInt(idate.getTime()/1000) + ")";
                console.log("addGoAwayData --->>> ", sql);
                mysql.db.query(
                    sql,
                    function selectCb(err, results, fields) {
                        console.log(err, results);
                        if (err) {
                            callback(false);
                        }
                        if(results) {
                            callback(true);
                        }
                    }
                );
            }
        }
    );
}

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
        var time = parseInt(new Date().getTime()/1000);
        var theTime = new Date();
        var day = parseInt(new Date(theTime.getYear() + "-" + theTime.getMonth() + "-" + theTime.getDate()).getTime()/1000);
        var path = imagePath + time + ".jpg";

        for (var i = 0; i < result.result_num; i ++) {
            if (arr[i].scores[0] > 80) {
                recordAttendance(arr, i, path, dataBuffer, time, day, function(res){
                    callback(res);
                })
            }
            else {
                // 记录陌生人来访
                recordGuest(client, file, path, dataBuffer, time, day, function(res){
                    callback(res);
                })
            }
        }
//        callback(returnRight(result));
    }).catch(function(err) {
        // 如果发生网络错误
        console.log(err);
    });
};

function recordAttendance(arr, i, path, dataBuffer, time, day, callback) {
    console.log(arr[i].uid, ", i see you !\ni see you !\ni see you !\ni see you !\n", new Date());
    // 记录签到一次 先判断短时间内有没有这记录
    mysql.db.query(
        "SELECT created_at FROM db_ars.tbl_attendance where uid=" + arr[i].uid + " order by aid Desc limit 1",
        function selectCb(err, results, fields) {
            console.log(err, results);
            if (err) {
                callback(returnWrong(err));
            }
            if(results) {
                var att = results[0];
                var date = att.created_at;
                var idate = new Date();
                if (idate.getTime()/1000 - 30 * 60 < date) {
                    // 重复了，不算
                    console.log("重复了，不算");
                    callback(returnWrong("re"));
                    return;
                }
                fs.writeFile(
                    "public/images/" + time + ".jpg",
                    dataBuffer,
                    function(err) {
                        if(err){
                            console.log(err);
                        }else{
                            console.log("保存成功！");
                        }
                    });
                console.log(i, "---   这里 -------->>>>>>>", arr);
                mysql.db.query(
                    //若非员工，插入新数据：INSERT INTO `db_ars`.`tbl_guests` (`created_at`, `uid`, `image`, `status`) VALUES ( '1521725598', '111111', 'http://xxxx.xxx.xxx/xxxxxxx', '0');
                    "INSERT INTO `db_ars`.`tbl_attendance` (`created_at`, `date`, `uid`, `status`) VALUES ( " + time + ", " + day + ", " + arr[i].uid + ", '1');",
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
        }
    )
}

function recordGuest(client, file, path, dataBuffer, time, day, callback) {
    client.detect(file, {"face_fields":"faceshape,qualities"}).then(function(result) {
        var arrDetect = result.result;
        for (var i = 0; i < result.result_num; i ++) {
            if (arrDetect[i].face_probability > 0.999 && arrDetect[i].blur < 0.7 && arrDetect[i].type.human > 0.999) {
                console.log("detect ------>>>>>>>>", result);
                console.log("detect ------>>>>>>>>", JSON.stringify(result));
                console.log("i don't know who are you !", new Date());
                fs.writeFile(
                    "public/images/" + time + ".jpg",
                    dataBuffer,
                    function(err) {
                        if(err){
                            console.log(err);
                        }else{
                            console.log("保存成功！");
                        }
                    });
                mysql.db.query(
                    //若非员工，插入新数据：INSERT INTO `db_ars`.`tbl_guests` (`created_at`, `uid`, `image`, `status`) VALUES ( '1521725598', '111111', 'http://xxxx.xxx.xxx/xxxxxxx', '0');
                    "INSERT INTO `db_ars`.`tbl_guests` (`created_at`, `date`, `uid`, `image`, `status`) VALUES ( " + time + ", " + day + ", " + null + ", '" + path + "', '1');",
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
                return;
            }
            else {
                console.log("花了，不算！");
                callback("aaa");
            }
        }
    }).catch(function(err) {
            // 如果发生网络错误
            console.log(err);
        });
}