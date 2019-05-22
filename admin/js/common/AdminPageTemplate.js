class AdminPageTemplate {

  static footer() {
    let currentYear = (new Date().getYear()) + "";
    return `<footer class="templatemo-footer">   
               <div class="templatemo-copyright">   
               <p>Copyright  @20${currentYear.substr(1)} AutoExpress.co.nf - Raymart De Guzman</p>   
               </div>   
            </footer>`;
  }

  static sideBar(username) {
    return `
        <div class="navbar-collapse collapse templatemo-sidebar">   
          <ul class="templatemo-sidebar-menu">   
            <li><a href="dashboard.php?username=${username}"><i class="fa fa-home"></i>Dashboard</a></li>   
            <li><a href="inventory.php?username=${username}"><i class="fa fa-car"></i>Manage Inventory</a></li>   
            <li><a href="admin.php?username=${username}"><i class="fa fa-user-circle"></i>View Admin Level</a></li>   
            <li><a href="preferences.php?username=${username}"><i class="fa fa-cog"></i>Preferences</a></li>   
            <li><a href="#" data-toggle="modal" data-target="#confirmModalLogout"><i class="fa fa-sign-out"></i>Sign Out</a></li>   
          </ul>   
        </div>`;
  }

  static navBar() {
    return `
        <div class="navbar navbar-inverse" role="navigation">
           <div class="pull-right" style="position: relative; top: 10px; right: 10px;"><p></p></div>
           <div class="navbar-header">
              <div class="logo">
                 <h1>Dashboard - Admin</h1>
              </div>
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span   
                 class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span   
                 class="icon-bar"></span> <span class="icon-bar"></span></button>   
           </div>
        </div>`;
  }

  static logoutModal() {
    return `
        <div class="modal fade" id="confirmModalLogout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">   
           <div class="modal-dialog">
                <div class="modal-content">   
                    <div class="modal-header text-center-important no-border">   
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span   
                        class="sr-only">Close</span></button>   
                        <h4 class="modal-title" id="myModalLabel">Are you sure you want to sign out?</h4>   
                    </div>
                   <div class="modal-footer text-center-important no-border" >   
                        <a href="logout.php" class="btn btn-primary btn-sm">Yes</a>   
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>   
                   </div>   
               </div>
           </div>   
         </div>`;
  }

}