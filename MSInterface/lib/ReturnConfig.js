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