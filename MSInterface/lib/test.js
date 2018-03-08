

var mysql = require('mysql');


exports.testInterface = function (req, callback) {


    var TEST_DATABASE = 'msdata';

    var TEST_TABLE = 'user';

//创建连接

    var client = mysql.createConnection({

        user: 'root',

        password: '123456'

    });

    client.connect();

    client.query("use " + TEST_DATABASE);

    client.query(

        'SELECT * FROM '+TEST_TABLE,

        function selectCb(err, results, fields) {
            console.log(results);
            if (err) {

                throw err;

            }

            if(results)

            {

                for(var i = 0; i < results.length; i++)

                {

                    console.log("%d\t%s\t%s", results[i].id, results[i].name, results[i].age);

                }

            }

            client.end();

        }

    );

    callback({code: 0});
};