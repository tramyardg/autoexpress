$(document).ready(function () {

	CommonHTML.init();
	sidebarActive();
    sideBarmenuClick();

});

var util = new CommonUtil();
function sidebarActive() {
    // goes by order of sidebar item
    var urlFileNameWithExt = util.getFilename();
    var $sidebarMenuItem = $(".templatemo-sidebar-menu li");
    if(urlFileNameWithExt === util.pageName[0]) {
        $sidebarMenuItem.eq(0).addClass('active');
    } else if(urlFileNameWithExt === util.pageName[1]){
        $sidebarMenuItem.eq(1).addClass('active');
    } else if(urlFileNameWithExt === util.pageName[2]){
        $sidebarMenuItem.eq(2).addClass('active');
    } else if(urlFileNameWithExt === util.pageName[3]){
        $sidebarMenuItem.eq(3).addClass('active');
	}
}

function sideBarmenuClick() {
    $(".templatemo-sidebar-menu li.sub a").click(function () {
        $(this).parent().hasClass("open") ? $(this).parent().removeClass("open") : $(this).parent().addClass("open")
    });
}