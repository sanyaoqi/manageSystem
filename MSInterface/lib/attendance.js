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
    var file = req.files;
    var APP_ID = "10858660";
    var API_KEY = "ZLhxHOjbdY4VEt8VzIX9Sxv7";
    var SECRET_KEY = "mOlxnVSZ5a4xutPMpx3oGruWlUvEi6Dd";

    //读取待识别图像并base64编码
    var bitmap = fs.readFileSync('testImg/006.png'); // 相对于app.js
    var base64str1 = new Buffer(bitmap).toString('base64');
    var bitmap2 = fs.readFileSync('testImg/002.jpeg'); // 相对于app.js
    var base64str2 = new Buffer(bitmap2).toString('base64');

    var client = new AipFace(APP_ID, API_KEY, SECRET_KEY);
    client.multiIdentify("test_001", base64str1, {"detect_top_num": "10"}).then(function(result) {
        console.log(result);
        console.log(JSON.stringify(result));
        var arr = result.result;
        for (var i = 0; i < result.result_num; i ++) {
            if (arr[i].scores[0] > 80) {
                console.log(arr[i].uid, ", i see you !");
                // 记录签到一次
            }
            else {
                console.log("i don't know who are you !");
                // 记录陌生人来访
            }
        }
        callback(returnRight(result));
    }).catch(function(err) {
            // 如果发生网络错误
            console.log(err);
        });


}