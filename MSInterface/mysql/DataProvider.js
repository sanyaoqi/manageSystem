/**
 * Created by ccwonline on 2018/3/9.
 */

var Provider = require('./MySQL').Provider,
    util = require('util');

var DataProvider = function () {
};

util.inherits(DataProvider, Provider);

DataProvider.prototype.find = function (selector, options, callback) {
    // this.db.query("use msdata");
    this.db.query(
        'SELECT * FROM user',
        function selectCb(err, results, fields) {
            console.log(err, results, fields);
            if (err) {
                throw err;
            }
            if(results) {
                for(var i = 0; i < results.length; i++) {
                    console.log("%s\t%s\t%s", results[i].name, results[i].sex, results[i].age);
                }
            }
        }
    );
};



exports.DataProvider = DataProvider;