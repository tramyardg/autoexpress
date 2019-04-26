$(document).ready(function () {

  CommonHTML.init();
  sidebarActive();

  switch (util.getFilename()) {
    case util.pageName[0].name: // dashboard
      break;
    case util.pageName[1].name:
      CarActions.init();
      break;
    case util.pageName[2].name:
      break;
    case util.pageName[3].name:
      break;
    case util.pageName[4].name: // sign-in
      break;
    case util.pageName[5].name: // register
      break;
    default:
  }

});

function sidebarActive() {
  // goes by order of sidebar item
  let urlFileNameWithExt = util.getFilename();
  let $sidebarMenuItem = $(".templatemo-sidebar-menu li");
  if (urlFileNameWithExt === util.pageName[0].name) {
    $sidebarMenuItem.eq(0).addClass('active');
  } else if (urlFileNameWithExt === util.pageName[1].name) {
    $sidebarMenuItem.eq(1).addClass('active');
  } else if (urlFileNameWithExt === util.pageName[2].name) {
    $sidebarMenuItem.eq(2).addClass('active');
  } else if (urlFileNameWithExt === util.pageName[3].name) {
    $sidebarMenuItem.eq(3).addClass('active');
  } else if (urlFileNameWithExt === util.pageName[util.pageName.length - 1].name) {
    $sidebarMenuItem.eq(1).addClass('active');
  }
}
