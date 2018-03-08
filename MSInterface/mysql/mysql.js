require('./Config');

var mysql  = require('mysql');

var connection = mysql.createConnection({

    host     : '127.0.0.1',

    user     : 'root',

    password : '123456',

    port: '3306',

    database: 'msdata'

});



connection.connect();

// function handleError (err) {
//     if (err) {
//         // 如果是连接断开，自动重新连接
//         if (err.code === 'PROTOCOL_CONNECTION_LOST') {
//             connect();
//         } else {
//             console.error(err.stack || err);
//         }
//     }
// }
//
// // 连接数据库
// function connect () {
//     db = mysql.createConnection(config);
//     db.connect(handleError);
//     db.on('error', handleError);
// }
//
// var db;
// connect();