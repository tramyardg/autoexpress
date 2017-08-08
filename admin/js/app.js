$(document).ready(function () {

	CommonHTML.init();
	sidebarActive();
    sideBarmenuClick();

});

var util = new CommonUtil();
function sidebarActive() {
    var urlFileNameWithExt = util.getFilename();
    var urlFileName = urlFileNameWithExt.substr(0, urlFileNameWithExt.indexOf("."));
    var $sidebarMenuItem = $(".templatemo-sidebar-menu li");
    if(urlFileName === "index") {
        $sidebarMenuItem.eq(0).addClass('active');
    } else if(urlFileName === "inventory"){
        $sidebarMenuItem.eq(1).addClass('active');
    } else if(urlFileName === "admin"){
        $sidebarMenuItem.eq(2).addClass('active');
    } else if(urlFileName === "preferences"){
        $sidebarMenuItem.eq(3).addClass('active');
	}
}

function sideBarmenuClick() {
    $(".templatemo-sidebar-menu li.sub a").click(function () {
        $(this).parent().hasClass("open") ? $(this).parent().removeClass("open") : $(this).parent().addClass("open")
    });
}