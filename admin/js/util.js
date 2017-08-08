function CommonUtil() {
    this.msg = {};

    this.getFilename = function () {
        return location.href.split('/').pop();
    };

    this.isEmpty = function (str) {
        return (!str || 0 === str.length);
    };
}