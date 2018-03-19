/**
 * Created by Administrator on 18-3-19.
 */

require("./ReturnConfig");
var edge = require('edge-js');

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
    callback(returnRight({}));
}