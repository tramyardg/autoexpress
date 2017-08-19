function CommonUtil() {
    this.msg = {
        pass_not_match: {text: '<span class="util-msg">Password not match.</span>'},
        empty_form_field: {text: '<span class="util-msg">Empty form field.</span>'}
    };

    this.getFilename = function () {
        var locHref = location.href;
        var startIndex = (locHref.lastIndexOf("/") + 1); // returns an index
        var fileName = locHref.substr(startIndex);

        if (fileName.indexOf("?") > 0) {
            return locHref.substr(startIndex, fileName.lastIndexOf('?'));
        } else {
            return locHref.substr(startIndex);
        }
    };

    this.isEmpty = function (str) {
        return (!str || 0 === str.length);
    };

    // only main page here, no sub page
    this.pageName = [
        {name: "dashboard.php", title: "Admin - Dashboard"},
        {name: "inventory.php", title: "Manage Vehicles"},
        {name: "admin.php", title: "Manage user admin"},
        {name: "preferences.php", title: "Account settings"},
        {name: "sign-in.php", title: "Admin login"},
        {name: "register.php", title: "Admin registration"},
        {name: "not-found.php", title: "404 - Not Found Page"},
        {name: "logout.php", title: "Signing out..."}
    ];

    this.addCommaSeparatedDec = function (str) {
       var strArr = str.split('');
       var strLen = strArr.length;
       if(strLen === 5) {
           strArr.splice(2, 0, ",");
           return strArr.join("");
       } else if(strLen === 6) {
           strArr.splice(3, 0, ",");
           return strArr.join("");
       } else {
           return str;
       }
    };

}