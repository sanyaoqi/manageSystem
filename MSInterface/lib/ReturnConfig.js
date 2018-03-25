/**
 * Created by ccwonline on 2018/3/9.
 */

global.warnCode = {
    adminDbError:{code:1000, message:"数据库错误"},
    userNotExistError :{code:1001, message:"用户不存在"},
    userHaveBeenExistError :{code:1001, message:"用户已存在"}

};

returnRight = function (result) {
    return {code:0, result: result, message: ""};
};


returnDBError = {code: 1000, result:"", message: "数据库错误"};


var APP_ID = "10858660";
var API_KEY = "ZLhxHOjbdY4VEt8VzIX9Sxv7";
var SECRET_KEY = "mOlxnVSZ5a4xutPMpx3oGruWlUvEi6Dd";