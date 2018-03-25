var express = require('express');
var log4js = require('log4js');
var logger = log4js.getLogger('normal');
var router = express.Router();
var fs = require("fs")
var path = require('path');

/* GET home page. */
router.get('/php', function(req, res, next) {
    var options = {
        // root: __dirname ,
        dotfiles: 'deny',
        headers: {
            'x-timestamp': Date.now(),
            'x-sent': true
        }
    };

    var fileName = "../yiiars/backend/web/index.php";
    console.log(path.resolve(fileName));
    res.sendFile(path.resolve(fileName), options, function (err) {
        if (err) {
            console.log(err);
            res.status(err.status).end();
        }
        else {
            console.log('Sent:', fileName);
        }
    });
    // res.sendFile(fileName, options, function (err) {
    //     if (err) {
    //         console.log(err);
    //         res.status(err.status).end();
    //     }
    //     else {
    //         console.log('Sent:', fileName);
    //     }
    // });
});


module.exports = router;