var Util = {

    msg: {},
    getFilename: function () {
        return location.href.split('/').pop();
    },
    isEmpty: function (str) {
        return (!str || 0 === str.length);
    }


};
