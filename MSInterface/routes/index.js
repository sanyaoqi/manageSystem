var express = require('express');
var log4js = require('log4js');
var logger = log4js.getLogger('normal');
var router = express.Router();
var fs = require("fs")
// test = require('../lib/test');

/* GET home page. */
router.get('/', function(req, res, next) {
    res.send("welcome node.js !");
});

router.use('*', function(req, res, next) {
    // console.log("router --------->>> ", req.originalUrl); // '/admin/new'
    // console.log(req.baseUrl); // '/admin'
    // console.log(req.path); // '/new'
    // console.log(req.baseUrl.split("/")); // '/new'
    testCommand(req, res, function (moudle, interface) {
        moudle[interface](req, function(sendResponse){
            sendRes(sendResponse, res);
        });
    })
});

module.exports = router;


var testCommand = function (req, res, callback) {
    // console.log("bbb --->>> ", req.method);
    // console.log(req.originalUrl); // '/admin/new'
    // console.log(req.baseUrl); // '/admin'
    // console.log("path --->>>", req.path); // '/new'
    // console.log(req.body); // '/new'
    // console.log(req.query); // '/new'
    if (req.method == "POST") {
        logger.debug("req.body:", req.body);
        logger.debug("req.query:", req.query);
        logger.debug("req.files:", req.files);
    }
    else {
        logger.debug("req.query:", req.query);
    }
    var arr = req.originalUrl.slice(1).split("/");
    if (arr.length < 2) {
        sendRes({code: '10000',message: "参数错误，path/文件名/接口名，亲！"}, res);
    }
    else {
        fs.exists('./lib/' + arr[0] + '.js', function(exists) {
            if (exists) {
                var moudle = require('../lib/' + arr[0]);
                if (moudle[arr[1]] == null) {
                    logger.warn({code: 2000, message: '接口命令不存在，path/文件名/接口名，亲！'} + ":" + req.url + ":" + req.query);
                    sendRes({code: 2000, message: '接口命令不存在，path/文件名/接口名，亲！'} , res);
                }
                else {
                    callback(moudle, arr[1]);
                }
            }
            else {
                sendRes({code: '10000',message: "文件名错误，path/文件名/接口名，亲！"}, res);
            }
        });
    }
};

//发送数据
var sendRes = function(sendResponse, res){
    logger.debug('result -->>',sendResponse);
    console.log('result -->>',sendResponse);
    res.send(sendResponse);
};