/**
 * Created by RAYMARTHINKPAD on 2017-02-03.
 */
function CommonHTML() {
	
    this.sideBarFn = function() {
		return '   <div class="navbar-collapse collapse templatemo-sidebar">  '  + 
			 '      <ul class="templatemo-sidebar-menu">  '  + 
			 '         <li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li>  '  + 
			 '         <li><a href="inventory.html"><i class="fa fa-car"></i><span class="badge pull-right">NEW</span>Manage Inventory</a></li>  '  +
			 '         <li><a href="admin.html"><i class="fa fa-user-circle"></i><span class="badge pull-right">NEW</span>Manage User Admin</a></li>  '  +
			 '         <li><a href="preferences.html"><i class="fa fa-cog"></i>Preferences</a></li>  '  + 
			 '         <li><a href="javascript:;" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-sign-out"></i>Sign Out</a></li>  '  + 
			 '      </ul>  '  + 
			 '  </div>  ' ; 		
	};
}