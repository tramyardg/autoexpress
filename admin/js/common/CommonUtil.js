function CommonUtil() {

  this.getFilename = function () {
    let locHref = location.href;
    let startIndex = (locHref.lastIndexOf("/") + 1); // returns an index
    let fileName = locHref.substr(startIndex);

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
    {name: "logout.php", title: "Signing out..."},
    {name: "updateCar.php", title: "Update Car"}
  ];

  // dynamically show the models of data selected
  this.selectCarMake = function (make) {
    let modelsSelect = $('select#model');
    modelsSelect.empty();

    let selectedMake = $(make).val();
    $.getJSON("js/data/models.json", function (json) {
      json.map((k) => {
        if (k.title === selectedMake) {
          k.models.map((k1) => {
            modelsSelect.append(`<option value="${k1.value}" title="${k1.value}">${k1.value}</option>`);
          })
        }
      })
    });
  };

  this.pageEnum = {
    dashboard: 0,
    inventory: 1,
    admin: 2,
    preferences: 3,
    login: 4,
    register: 5,
    notFound: 6,
    logout: 7,
    updateCar: 8
  }

}