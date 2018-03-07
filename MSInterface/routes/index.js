var express = require('express');
var log4js = require('log4js');
var logger = log4js.getLogger('normal');
var router = express.Router();

var test = require('../lib/test');

/* GET home page. */
router.get('/', function(req, res, next) {
    res.send("welcome node.js !");
});

router.all('/test', function(req, res, next) {
    testCommand(req, res, test, function (command) {
        test[command](req, function(sendResponse){
            sendRes(sendResponse, res);
        });
    })
});

module.exports = router;


var testCommand = function (req, res, libName, callback) {
    // console.log("bbb --->>> ", req);
    if (req.method == "POST") {
        var command = req.body.command;
        logger.debug("req.body:", req.body);
        logger.debug("req.query:", req.query);
        logger.debug("req.files:", req.files);
    }
    else {
        var command = req.query.command;
        logger.debug("req.query:", req.query);
    }
    logger.debug("command:", command);
    if (command == null) {
        sendRes({code: '10000',message: "参数错误，没有command啊，亲！"}, res);
    }
    else {
        if (libName[command] == null) {
            logger.warn({code: 2000, message: '命令不存在'} + ":" + req.url + ":" + req.query);
            sendRes({code: 2000, message: '命令不存在'} , res);
        } else {
            callback(command);
        }
    }
};

//发送数据
var sendRes = function(sendResponse, res){
    logger.debug('result -->>',sendResponse);
    res.send(sendResponse);
};