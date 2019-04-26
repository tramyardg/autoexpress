class AdminPageTemplate {

  constructor(options) {
    this.id = options.id;
    this.make = options.make;
    this.model = options.model;
    this.year = options.year;
    this.price = options.price;
    this.cylinder = options.cylinder;
    this.drivetrain = options.drivetrain;
    this.status = options.status;
    this.transmission = options.transmission;
  }

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
            <li><a href="admin.php?username=${username}"><i class="fa fa-user-circle"></i>Manage / View Admin</a></li>   
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

  // contains update modal
  updateCarModalContainer() {
    return `
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                ${this.updateCarModalForm()}
                </div>
            </div>
        </div>`;
  }

  updateCarModalForm() {
    return `
      <form action="" method="post" onsubmit="" class="margin-top-15">   
        <div class="panel panel-primary">   
          <div class="panel-heading">General vehicle info</div>   
            <div class="panel-body">   
              <table cellspacing="1" id="update-car-general-info-table">   
                <tbody>
                ${this.updateCarModal_HiddenVid()}
                ${this.updateCarModal_SelectMake()}
                ${this.updateCarModal_SelectYear()}
                ${this.updateCarModal_Model()}
                ${this.updateCarModal_Price()}
                </tbody>
              </table>
            </div>
        </div>
      </form>
      `;
  }

  updateCarModal_HiddenVid() {
    return `<tr><td><input type="hidden" class="hidden" value="${this.id}" name="update-vehicle-id" id="update-vehicle-id"></td></tr>`;
  }

  updateCarModal_SelectMake() {
    return `<tr>
                <td>Make<span class="input-required"> *</span></td>   
                <td><input type="text" readonly value="${this.make}" name="update-make" id="update-make" ></td>   
            </tr>`;
  }

  updateCarModal_SelectYear() {
    return `<tr>
        <td>Year<span class="input-required"> *</span></td>   
        <td>   
            <select name="year" id="year" title="year" required >   
                <option selected="selected" value="">Select year</option> 
                <option value="2019">2019</option>   
                <option value="2018">2018</option>   
                <option value="2017">2017</option>   
                <option value="2016">2016</option>   
                <option value="2015">2015</option>   
                <option value="2014">2014</option>   
                <option value="2013">2013</option>   
                <option value="2012">2012</option>   
                <option value="2011">2011</option>   
                <option value="2010">2010</option>   
                <option value="2009">2009</option>   
                <option value="2008">2008</option>   
                <option value="2007">2007</option>   
                <option value="2006">2006</option>   
                <option value="2005">2005</option>   
                <option value="2004">2004</option>   
                <option value="2003">2003</option>   
                <option value="2002">2002</option>   
                <option value="2001">2001</option>   
                <option value="2000">2000</option>   
                <option value="1999">1999</option>   
                <option value="1998">1998</option>   
                <option value="1997">1997</option>   
                <option value="1996">1996</option>   
                <option value="1995">1995</option>   
                <option value="1994">1994</option>   
                <option value="1993">1993</option>   
                <option value="1992">1992</option>   
                <option value="1991">1991</option>   
                <option value="1990">1990</option>   
                <option value="1989">1989</option>   
                <option value="1988">1988</option>   
                <option value="1987">1987</option>   
                <option value="1986">1986</option>   
                <option value="1985">1985</option>   
                <option value="1984">1984</option>   
                <option value="1983">1983</option>   
                <option value="1982">1982</option>   
                <option value="1981">1981</option>   
                <option value="1980">1980</option>   
            </select>   
            <b style="font-size: 10px; color: red;" id="year-err">&nbsp;</b>   
        </td></tr>`;
  }

  updateCarModal_Model() {
    return `<tr>
                <td>Model<span class="input-required"> *</span></td>
                <td><input type="text" readonly value="${this.model}" name="update-model" id="update-model" ></td>
            </tr>`;
  }

  updateCarModal_Price() {
    return `
    <tr>
        <td>Price<span class="input-required"> *</span></td>
        <td>
         <input type="number" name="price" id="price" title="price" min="0" max="999999" required value="${this.price}" />
         <b style="font-size: 10px; color: red;" id="price-err">&nbsp;</b>
        </td>
    </tr>`;
  }
  
  updateCarModal() {

  }
}