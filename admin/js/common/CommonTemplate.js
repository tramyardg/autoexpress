/**
 * Created by RAYMARTHINKPAD on 2017-02-03.
 */
function CommonTemplate() {

    this.pageTitle = function (pageTitle) {
      return '<title>'+pageTitle+'</title>'
    };

    this.sideBarElement = function (username) {
        return '   <div class="navbar-collapse collapse templatemo-sidebar">  ' +
            '      <ul class="templatemo-sidebar-menu">  ' +
            '         <li><a href="dashboard.php?username='+username+'"><i class="fa fa-home"></i>Dashboard</a></li>  ' +
            '         <li><a href="inventory.php?username='+username+'"><i class="fa fa-car"></i>Manage Inventory</a></li>  ' +
            '         <li><a href="admin.php?username='+username+'"><i class="fa fa-user-circle"></i>Manage / View Admin</a></li>  ' +
            '         <li><a href="preferences.php?username='+username+'"><i class="fa fa-cog"></i>Preferences</a></li>  ' +
            '         <li><a href="#" data-toggle="modal" data-target="#confirmModalLogout"><i class="fa fa-sign-out"></i>Sign Out</a></li>  ' +
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
        return  '   <div class="navbar navbar-inverse" role="navigation">  '  +
            '       <div class="pull-right" style="position: relative; top: 10px; right: 10px;  '  +
            '   "><p></p></div>  '  +
            '       <div class="navbar-header">  '  +
            '           <div class="logo"><h1>Dashboard - Admin</h1></div>  '  +
            '           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span  '  +
            '                       class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span  '  +
            '                       class="icon-bar"></span> <span class="icon-bar"></span></button>  '  +
            '       </div>  '  +
            '  </div>  ' ;
    };

    this.confirmModalLogout = function () {
        return '<div class="modal fade" id="confirmModalLogout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  '  +
            '                aria-hidden="true">  '  +
            '               <div class="modal-dialog">  '  +
            '                   <div class="modal-content">  '  +
            '                       <div class="modal-header text-center-important no-border">  '  +
            '                           <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span  '  +
            '                                   class="sr-only">Close</span></button>  '  +
            '                           <h4 class="modal-title" id="myModalLabel">Are you sure you want to sign out?</h4>  '  +
            '                       </div>  '  +
            '                       <div class="modal-footer text-center-important no-border" >  '  +
            '                           <a href="logout.php" class="btn btn-primary btn-sm">Yes</a>  '  +
            '                           <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>  '  +
            '                       </div>  '  +
            '                   </div>  '  +
            '               </div>  '  +
            '          </div>  ' ;
    };

    this.confirmDeleteRecord = function () {
        return '<div class="modal fade" id="confirm-delete-record" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  '  +
            '                aria-hidden="true">  '  +
            '               <div class="modal-dialog">  '  +
            '                   <div class="modal-content">  '  +
            '                       <div class="modal-header text-center-important no-border">  '  +
            '                           <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span  '  +
            '                                   class="sr-only">Close</span></button>  '  +
            '                           <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete this record?</h4>  '  +
            '                       </div>  '  +
            '                       <div class="modal-footer text-center-important no-border" id="delete-confirm-btn">  '  +
            '                           <button type="button" class="btn btn-danger btn-sm" id="delete-yes" >Yes</button>  '  +
            '                           <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>  '  +
            '                       </div>  '  +
            '                   </div>  '  +
            '               </div>  '  +
            '          </div>  ' ;
    };

    this.rowAffectedSuccessfully = function () {
        return '<div class="modal fade" id="row-affected-successfully" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  '  +
            '                aria-hidden="true">  '  +
            '               <div class="modal-dialog">  '  +
            '                   <div class="modal-content">  '  +
            '                       <div class="modal-header text-center-important no-border">  '  +
            '                           <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span  '  +
            '                                   class="sr-only">Close</span></button>  '  +
            '                           <h4 class="modal-title" id="myModalLabel">1 row affected.</h4>  '  +
            '                       </div>  '  +
            '                       <div class="modal-footer text-center-important no-border">  '  +
            '                           <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Ok</button>  '  +
            '                       </div>  '  +
            '                   </div>  '  +
            '               </div>  '  +
            '          </div>  ' ;
    }
}