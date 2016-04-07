/**
 * Created by kernel on 2016/4/6.
 */
var isEmpty = function (str) {
    str = str.trim();
    return (str === null || str === "");
};

var isValidEmail = function (email) {
    var reg = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
    return reg.test(email);
};

var createRandomStr = function (randomStrLen) {
    var len = randomStrLen || 1,
        chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
        max = chars.length,
        str = '';

    for (var i = 0; i < len; i++) {
        str += chars.charAt(Math.floor(Math.random() * max));
    }

    return str;
};

