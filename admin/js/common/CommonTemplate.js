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
            '                   <p>Copyright © 2017 AutoExpress.co.nf</p>  ' +
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
    };

    this.getPhotosByCarIdModalContent = function () {
        return '{{#diagrams}}<div class="col-xs-6 col-md-3"><div class="thumbnail"><img src="{{_diagram}}" alt=""><div class="caption"><p></p><p><a class="delete-car"  href="?action=deleteCarPhoto&id={{_diagramId}}" delete-photos="{{_diagramId}}" role="button">Delete</a></p></div></div></div>{{/diagrams}}';
    };

    this.updateCarInfoModalContent = function () {
        return '   <div class="row">  '+
            '   	<div class="col-md-12">  '+
            '   		<div class="col-md-12">  '+
            '   			<form action="" method="post" onsubmit="" class="margin-top-15">  '+
            '   				<div class="panel panel-primary">  '+
            '   					<div class="panel-heading">General vehicle info</div>  '+
            '   					<div class="panel-body">  '+
            '   						<table cellspacing="1" id="update-car-general-info-table">  '+
            '   							<tbody>  '+
            '                               <tr><td><input type="hidden" class="hidden" value="{{_vehicleId}}" name="update-vehicle-id" id="update-vehicle-id"></td></tr>' +
            '   							<tr>  '+
            '   								<td>Make<span class="input-required"> *</span></td>  '+
            '   								<td><input type="text" readonly value="{{_make}}" name="update-make" id="update-make" ></td>  '+
            '   							</tr>  '+
            '   							<tr>  '+
            '   								<td>Year<span class="input-required"> *</span></td>  '+
            '   								<td>  '+
            '   									<select name="year" id="year" title="year" required >  '+
                '                               <option selected="selected" value="">Select year</option>'+
            '   										<option value="2018">2018</option>  '+
            '   										<option value="2017">2017</option>  '+
            '   										<option value="2016">2016</option>  '+
            '   										<option value="2015">2015</option>  '+
            '   										<option value="2014">2014</option>  '+
            '   										<option value="2013">2013</option>  '+
            '   										<option value="2012">2012</option>  '+
            '   										<option value="2011">2011</option>  '+
            '   										<option value="2010">2010</option>  '+
            '   										<option value="2009">2009</option>  '+
            '   										<option value="2008">2008</option>  '+
            '   										<option value="2007">2007</option>  '+
            '   										<option value="2006">2006</option>  '+
            '   										<option value="2005">2005</option>  '+
            '   										<option value="2004">2004</option>  '+
            '   										<option value="2003">2003</option>  '+
            '   										<option value="2002">2002</option>  '+
            '   										<option value="2001">2001</option>  '+
            '   										<option value="2000">2000</option>  '+
            '   										<option value="1999">1999</option>  '+
            '   										<option value="1998">1998</option>  '+
            '   										<option value="1997">1997</option>  '+
            '   										<option value="1996">1996</option>  '+
            '   										<option value="1995">1995</option>  '+
            '   										<option value="1994">1994</option>  '+
            '   										<option value="1993">1993</option>  '+
            '   										<option value="1992">1992</option>  '+
            '   										<option value="1991">1991</option>  '+
            '   										<option value="1990">1990</option>  '+
            '   										<option value="1989">1989</option>  '+
            '   										<option value="1988">1988</option>  '+
            '   										<option value="1987">1987</option>  '+
            '   										<option value="1986">1986</option>  '+
            '   										<option value="1985">1985</option>  '+
            '   										<option value="1984">1984</option>  '+
            '   										<option value="1983">1983</option>  '+
            '   										<option value="1982">1982</option>  '+
            '   										<option value="1981">1981</option>  '+
            '   										<option value="1980">1980</option>  '+
            '   									</select>  '+
            '   									<b style="font-size: 10px; color: red;" id="year-err">&nbsp;</b>  '+
            '   								</td>  '+
            '   							</tr>  '+
            '   							<tr>  '+
            '   								<td>Model<span class="input-required"> *</span></td>  '+
            '   								<td><input type="text" readonly value="{{_model}}" name="update-model" id="update-model" ></td>  '+
            '   							</tr>  '+
            '   							<tr>  '+
            '   								<td>Price<span class="input-required"> *</span></td>  '+
            '   								<td>  '+
            '   									<input type="number" name="price" id="price" title="price" min="0" max="999999" required value="{{_price}}" />  '+
            '   									<b style="font-size: 10px; color: red;" id="price-err">&nbsp;</b>  '+
            '   								</td>  '+
            '   							</tr>  '+
            '   							<tr>  '+
            '   								<td>Mileage(Km)<span class="input-required"> *</span></td>  '+
            '   								<td>  '+
            '   									<input type="number" name="mileage" id="mileage" title="mileage" min="0" max="999999" required/ value="{{_mileage}}">  '+
            '   									<b style="font-size: 10px;  color: red;" id="mileage-err">&nbsp;</b>  '+
            '   								</td>  '+
            '   							</tr>  '+
            '   							<tr>  '+
            '   								<td>Transmission<span class="input-required"> *</span></td>  '+
            '   								<td>  '+
            '   									<input type="radio" name="transmission" id="transmission" value="Automatic" title="transmission" required> Automatic  '+
            '   									<input type="radio" name="transmission" id="transmission" value="Manual" title="transmission" required> Manual  '+
            '   									<b style="font-size: 10px; color: red;" id="transmission-err">&nbsp;</b>  '+
            '   								</td>  '+
            '   							</tr>  '+
            '   							<tr>  '+
            '   								<td>Drivetrain<span class="input-required"> *</span></td>  '+
            '   								<td>  '+
            '   									<input type="radio" name="drivetrain" id="drivetrain" value="AWD" title="drivetrain" required> AWD  '+
            '   									<input type="radio" name="drivetrain" id="drivetrain" value="FWD" title="drivetrain" required> FWD  '+
            '   									<input type="radio" name="drivetrain" id="drivetrain" value="RWD" title="drivetrain" required> RWD  '+
            '   									<input type="radio" name="drivetrain" id="drivetrain" value="4X4" title="drivetrain" required> 4X4  '+
            '   									<b style="font-size: 10px; color: red;" id="drivetrain-err">&nbsp;</b>  '+
            '   								</td>  '+
            '   							</tr>  '+
            '                               <tr>  '  +
            '   	                            <td>Status</td>  '  +
            '   	                            <td>  '  +
            '   		                            <input type="radio" name="status" id="status" value="Available" title="status" checked> Available  '  +
    '   		                                    <input type="radio" name="status" id="status" value="SOLD" title="status"> Sold  '  +
            '   	                            </td>  '  +
        '                                   </tr>  '  +
            '   							</tbody>  '+
            '   						</table>  '+
            '   						<span class="input-required">*</span> <span class="label label-danger">Required fields</span>  '+
            '   					</div>  '+
            '   				</div>  '+
            '   				<div class="panel panel-primary">  '+
            '   					<div class="panel-heading">Category</div>  '+
            '   					<div class="panel-body">  '+
            '   						<div class="row">  '+
            '   							<div class="col-md-5">  '+
            '   								<b>Car</b><br/>  '+
            '   								<input required class="right_side" type="radio" name="category" id="category" title="category" value="Subcompact car"> Subcompact car <br/>  '+
            '   								<input required class="right_side" type="radio" name="category" id="category" title="category" value="Compact car"> Compact car <br />  '+
            '   								<input required class="right_side" type="radio" name="category" id="category" title="category" value="Mid-size car"> Mid-size car <br />  '+
            '   								<input required class="right_side" type="radio" name="category" id="category" title="category" value="Entry-level luxury car"> Entry-level luxury car <br />  '+
            '   								<input required class="right_side" type="radio" name="category" id="category" title="category" value="Mid-size luxury car"> Mid-size luxury car <br />  '+
            '   								<input required class="right_side" type="radio" name="category" id="category" title="category" value="Full-size car"> Full-size car  '+
            '   							</div>  '+
            '   							<div class="col-md-5">  '+
            '   								<b>Truck</b><br/>  '+
            '   								<input required class="right_side" type="radio" name="category" id="category" title="category" value="Minivan"> Minivan<br />  '+
            '   								<input required class="right_side" type="radio" name="category" id="category" title="category" value="Van"> Van<br />  '+
            '   								<input required class="right_side" type="radio" name="category" id="category" title="category" value="Compact SUV"> Compact SUV<br />  '+
            '   								<input required class="right_side" type="radio" name="category" id="category" title="category" value="Mid-size SUV"> Mid-size SUV<br />  '+
            '   								<input required class="right_side" type="radio" name="category" id="category" title="category" value="Full-size SUV"> Full-size SUV<br />  '+
            '   								<input required class="right_side" type="radio" name="category" id="category" title="category" value="Pickup"> Pickup  '+
            '   							</div>  '+
            '   							<div class="col-md-2"></div>  '+
            '   						</div>  '+
            '   						<span class="input-required">*</span> <span class="label label-danger">Required fields</span>  '+
            '   					</div>  '+
            '   				</div>  '+
            '   				<div class="panel panel-primary">  '+
            '   					<div class="panel-heading">Engine and chassis</div>  '+
            '   					<div class="panel-body">  '+
            '   						<table>  '+
            '   							<tbody>  '+
            '   							<tr>  '+
            '   								<td>Cylinder<span class="input-required"> *</span></td>  '+
            '   								<td>  '+
            '   									<input required type="radio" name="cylinder" id="cylinder" title="cylinder" value="4"> 4  '+
            '   									<input required type="radio" name="cylinder" id="cylinder" title="cylinder" value="6"> V6  '+
            '   									<input required type="radio" name="cylinder" id="cylinder" title="cylinder" value="8"> V8  '+
            '   									<input required type="radio" name="cylinder" id="cylinder" title="cylinder" value="10"> V10  '+
            '   								</td>  '+
            '   							</tr>  '+
            '   							<tr>  '+
            '   								<td>Capacity (Litre) <span class="input-required"> *</span></td>  '+
            '   								<td>  '+
            '   									<input value="{{_engineCapacity}}" type="text" name="capacity" id="capacity" minlength="0" maxlength="4" title="capacity" required>  '+
            '   									<b style="font-size: 10px; color: red;" id="capacity-err">&nbsp;</b>  '+
            '   								</td>  '+
            '   							</tr>  '+
            '   							<tr>  '+
            '   								<td>Doors<span class="input-required"> *</span></td>  '+
            '   								<td>  '+
            '   									<input value="{{_doors}}" type="number" name="doors" id="doors" title="doors" required min="2" max="6">  '+
            '   									<b style="font-size: 10px; color: red;" id="door-err">&nbsp;</b>  '+
            '   								</td>  '+
            '   							</tr>  '+
            '   							</tbody>  '+
            '   						</table>  '+
            '   						<span class="input-required">*</span> <span class="label label-danger">Required fields</span>  '+
            '   					</div>  '+
            '   				</div>  '+
            '   				<div class="panel panel-success">  '+
            '   					<div class="panel-heading">Submit form</div>  '+
            '   					<div class="panel-body">  '+
            '   						<table>  '+
            '   							<tbody>  '+
            '   							<tr>  '+
            '   								<td>  '+
            '   									<input type="submit" class="btn btn-primary btn-sm" name="update-car-submit" id="update-car-submit" value="Submit">  '+
            '   									<input type="button" class="btn btn-default btn-sm" data-dismiss="modal" aria-label="Close" value="Cancel">  '+
            '   								</td>  '+
            '   							</tr>  '+
            '   							</tbody>  '+
            '   						</table>  '+
            '   					</div>  '+
            '   				</div>  '+
            '   			</form>  '+
            '   		</div>  '+
            '   	</div>  '+
            '  </div>  ';

    }
}