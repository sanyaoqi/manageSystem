/**
 * Created by Administrator on 18-3-19.
 */


var edge = require('edge-js');
/*
 `uid` INT NOT NULL AUTO_INCREMENT,
 `email` VARCHAR(64) NULL,
 `mobile` INT(11) NULL,
 `passwd` VARCHAR(64) NOT NULL,
 `real_name` VARCHAR(45) NULL,
 `id_card` CHAR(30) NULL COMMENT '身份证号',
 `fingerprint` INT NULL COMMENT '指纹id',
 `ic_card` VARCHAR(64) NULL COMMENT 'IC卡号',
 `created_at` INT(10) NULL,
*/

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
        if (error) console.log("error === ", error);
        console.log("result === ", result); // Success
        if ("1" == result)
            console.log("aaaaaaaaaaaaaaa"); // Success
        else
            console.log("bbbbbbbbbbbbbbb"); // Failure
    });
    callback(returnRight({user:"aaa"}));
};

exports.setUserPicture = function (req, callback) {

};