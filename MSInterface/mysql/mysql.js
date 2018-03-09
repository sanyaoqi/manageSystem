require('./Config');

var mysql  = require('mysql');

var MySQL = function () {
};

function handleError (err) {
    if (err) {
        // 如果是连接断开，自动重新连接
        if (err.code === 'PROTOCOL_CONNECTION_LOST') {
            connect();
        } else {
            console.error(err.stack || err);
        }
    }
}

// 连接数据库
function connect () {
    MySQL.prototype.db = mysql.createConnection(config);
    MySQL.prototype.db.connect(handleError);
    MySQL.prototype.db.on('error', handleError);
    console.log("连接MySQL数据库...");
}

connect();
exports.MySQL = MySQL;