/**
 * Created by Administrator on 18-3-19.
 */


require("./ReturnConfig");
var edge = require('edge-js');
var AipFace = require('baidu-aip-sdk').face; //这个‘baidu-ai’就是上面自定义的package.json中名字
var fs = require('fs');
var MySQL  = require('../mysql/MySQL').MySQL;
var mysql = new MySQL();


exports.readIDCard = function (req, callback) {
    var read = edge.func({
        assemblyFile: 'SDK/IDcard/ClassLibrary1.dll',             // assemblyFile为dll路径
        atypeName: 'IDcard.Startup',   // RockyNamespace为命名空间，Study为类名
//        assemblyFile: 'SDK/IDcard/ClassLibrary1/bin/Debug/ClassLibrary1.dll',             // assemblyFile为dll路径
//        atypeName: 'IDcard.Startup',   // RockyNamespace为命名空间，Study为类名
        methodName: 'ReadIDCardData'                     //Connect_Net GetGeneralLogData GetAllUserInfo
    });

// s为传递方法传递的参数，result为方法返回的结果
    read ({}, function (error, result) {
        if (error) {
            callback(returnWrong(error));
            return;
        }

        console.log("result === ", result); // Success
        if (result.Code == '0') {
            var json = {
                "name":result.Name,
                "sex":result.Sex,
                "nation":result.Nation,
                "birthday":result.Date,
                "IDNum":result.IDNum,
                "issue":result.Issue,
                "begin":result.Begin
            };
            callback(returnRight(json));
        }
        else {
            callback(returnWrong(result.Message));
        }
    });
};

exports.setUserPicture = function (req, callback) {

    var pic = req.body.pic;
    var uid = req.body.uid;

    var client = new AipFace(APP_ID, API_KEY, SECRET_KEY);
    client.addUser(uid, {}, groupId, pic, {"action_type": "append"}).then(function(result) {
        console.log(result);
        console.log(JSON.stringify(result));
        callback(returnRight(result));
    }).catch(function(err) {
        // 如果发生网络错误
        console.log(err);
    });
};

exports.addUserToAttMac = function (req, callback) {
    var read = edge.func({
        assemblyFile: 'SDK/IDcard/ClassLibrary1.dll',             // assemblyFile为dll路径
        atypeName: 'IDcard.Startup',   // RockyNamespace为命名空间，Study为类名
//        assemblyFile: 'SDK/IDcard/ClassLibrary1/bin/Debug/ClassLibrary1.dll',             // assemblyFile为dll路径
//        atypeName: 'IDcard.Startup',   // RockyNamespace为命名空间，Study为类名
        methodName: 'ReadIDCardData'                     //Connect_Net GetGeneralLogData GetAllUserInfo
    });

// s为传递方法传递的参数，result为方法返回的结果
    read ({}, function (error, result) {
        if (error) {
            callback(returnWrong(error));
            return;
        }

        console.log("result === ", result); // Success
        if (result.Code == '0') {

        }
        else {
            callback(returnWrong(result.Message));
        }
    });
};