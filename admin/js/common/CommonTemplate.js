/**
 * Created by RAYMARTHINKPAD on 2017-02-03.
 */
function CommonTemplate() {

    this.sideBarElement = function () {
        return '   <div class="navbar-collapse collapse templatemo-sidebar">  ' +
            '      <ul class="templatemo-sidebar-menu">  ' +
            '         <li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li>  ' +
            '         <li><a href="inventory.html"><i class="fa fa-car"></i><span class="badge pull-right">NEW</span>Manage Inventory</a></li>  ' +
            '         <li><a href="admin.html"><i class="fa fa-user-circle"></i><span class="badge pull-right">NEW</span>Manage User Admin</a></li>  ' +
            '         <li><a href="preferences.html"><i class="fa fa-cog"></i>Preferences</a></li>  ' +
            '         <li><a href="javascript:;" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-sign-out"></i>Sign Out</a></li>  ' +
            '      </ul>  ' +
            '  </div>  ';
    };

    this.footerElement = function () {
        return '<footer class="templatemo-footer">  ' +
            '               <div class="templatemo-copyright">  ' +
            '                   <p>Copyright © 2084 Your Company Name <!-- Credit: www.templatemo.com --></p>  ' +
            '               </div>  ' +
            '          </footer>  ';
    };


    this.navBarHeaderElem = function () {
        return '   <div class="navbar navbar-inverse" role="navigation">  ' +
            '           <div class="navbar-header">  ' +
            '               <div class="logo"><h1>Dashboard - Admin</h1></div>  ' +
            '               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">  ' +
            '                   <span class="sr-only">Toggle navigation</span>  ' +
            '                   <span class="icon-bar"></span>  ' +
            '                   <span class="icon-bar"></span>  ' +
            '                   <span class="icon-bar"></span>  ' +
            '               </button>  ' +
            '           </div>  ' +
            '      </div>  ';
    };
}