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
        {name: "dashboard.php", title:"Admin - Dashboard"},
        {name: "inventory.php", title:"Manage Vehicles"},
        {name: "admin.php", title:"Manage user admin"},
        {name: "preferences.php", title:"Account settings"},
        {name: "sign-in.php", title: "Admin login"},
        {name: "register.php", title: "Admin registration"},
        {name: "logout.php", title: "Signing out..."}
    ];

}