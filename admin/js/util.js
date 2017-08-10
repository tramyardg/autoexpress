function CommonUtil() {
    this.msg = {};

    this.getFilename = function () {
        return location.href.split('/').pop();
    };

    this.isEmpty = function (str) {
        return (!str || 0 === str.length);
    };

    // only main page here, no sub page
    this.pageName = [
        "dashboard.php", // 0
        "inventory.php", // 1
        "admin.php",
        "preferences.php",
        "sign-in.php",
        "register.php",
        "logout.php"
    ];

}