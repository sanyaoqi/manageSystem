
require("./ReturnConfig");

var edge = require('edge-js');
var MySQL  = require('../mysql/MySQL').MySQL;
var mysql = new MySQL();

exports.testInterface = function (req, callback) {
    var StudyMath = edge.func({
        assemblyFile: 'SDK/IFace/TestLibrary.dll',             // assemblyFile为dll路径
        atypeName: 'TestLibrary.Startup',   // RockyNamespace为命名空间，Study为类名
//        assemblyFile: 'SDK/IDcard/ClassLibrary1/bin/Debug/ClassLibrary1.dll',             // assemblyFile为dll路径
//        atypeName: 'IDcard.Startup',   // RockyNamespace为命名空间，Study为类名
        methodName: 'GetAllUserInfo'                     //Connect_Net GetGeneralLogData GetAllUserInfo
    });

// s为传递方法传递的参数，result为方法返回的结果
    StudyMath ({"IP":"192.168.199.201","Port":"4370"}, function (error, result) {
        if (error) console.log("error === ", error);
        console.log("result === ", result); // Success
        if ("1" == result)
            console.log("aaaaaaaaaaaaaaa"); // Success
        else
            console.log("bbbbbbbbbbbbbbb"); // Failure
    });
    callback(returnRight({user:"aaa"}));
};


