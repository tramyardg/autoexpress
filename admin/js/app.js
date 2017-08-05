$(document).ready(function () {
	

	Sidebar.init();
	sidebarActive();
	
});

function sidebarActive() {
    var urlFileNameWithExt = Util.getFilename();
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