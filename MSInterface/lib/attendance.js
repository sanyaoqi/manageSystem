/**
 * Created by Administrator on 18-3-19.
 */

require("./ReturnConfig");
var edge = require('edge-js');
var AipFace = require('baidu-aip-sdk').face; //这个‘baidu-ai’就是上面自定义的package.json中名字
var fs = require('fs');

exports.readAttMacList = function (req, callback) {
    var readAtt = edge.func({
//     assemblyFile: 'SDK/IFace_x64/AccessControl/TestLibrary/bin/Debug/TestLibrary.dll',             // assemblyFile为dll路径
//     atypeName: 'TestLibrary.Startup',   // RockyNamespace为命名空间，Study为类名
        assemblyFile: 'SDK/IFace/TestLibrary.dll',             // assemblyFile为dll路径
        atypeName: 'TestLibrary.Startup',   // RockyNamespace为命名空间，Study为类名
        methodName: 'GetGeneralLogData'                     //Connect_Net GetGeneralLogData GetAllUserInfo
    });

// s为传递方法传递的参数，result为方法返回的结果
    readAtt ({"IP":"192.168.199.201","Port":"4370"}, function (error, result) {
        if (error) console.log("error === ", error);
        console.log("result === ", result); // Success
        if ("1" == result)
            console.log("aaaaaaaaaaaaaaa"); // Success
        else
            console.log("bbbbbbbbbbbbbbb"); // Failure

        callback(returnRight(result));
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


    var event = req.body.event;
    // if (event == "onUpdate") {

        var client = new AipFace(APP_ID, API_KEY, SECRET_KEY);
        client.multiIdentify("test_001", file, {"detect_top_num": "10"}).then(function(result) {
            console.log(result);
            console.log(JSON.stringify(result));
            var arr = result.result;
            for (var i = 0; i < result.result_num; i ++) {
                if (arr[i].scores[0] > 80) {
                    console.log(arr[i].uid, ", i see you !\ni see you !\ni see you !\ni see you !\n", new Date());
                    // 记录签到一次
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
                                    "./testImg/" + Math.random() + ".html",
                                    "<html><img src='data:image/png;base64," + file + "'/></html>",
                                    function(err) {
                                        if(err){
                                            console.log(err);
                                        }else{
                                            console.log("保存成功！");
                                        }
                                    });
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


    // }
    // else {
    //
    //     callback(returnDBError);
    // }
};