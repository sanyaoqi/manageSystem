
require("./ReturnConfig");

var MySQL  = require('../mysql/MySQL').MySQL;
var mysql = new MySQL();

exports.testInterface = function (req, callback) {
    mysql.db.query(
        'SELECT * FROM user',
        function (err, results, fields) {
            console.log(err, results);
            if (err) {
                callback(returnDBError);
            }
            else {
                callback(returnRight(results));
            }
        });
};


