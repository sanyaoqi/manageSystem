/**
 * Created by ccwonline on 2018/3/9.
 */

returnRight = function (result) {
    return {code:0, result: result, message: ""};
};
returnWrong = function (message) {
    return {code:1, result: {}, message: message};
};

returnDBError = {code: 1000, result:"", message: "数据库错误"};


APP_ID = "10858660";
API_KEY = "ZLhxHOjbdY4VEt8VzIX9Sxv7";
SECRET_KEY = "mOlxnVSZ5a4xutPMpx3oGruWlUvEi6Dd";

groupId = "test_001";

attMachineIP = "192.168.199.201";
attMachinePort = "4370";

imagePath = "http://localhost:9200/images/";