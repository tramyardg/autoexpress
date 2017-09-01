<?php
require_once 'admin/server/CarDAO.php';
require_once 'admin/server/DiagramDAO.php';

$v = new CarDAO();
$all_cars = $v->getAllCars();
$num_cars = $v->countAllCars();

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>AutoExpress.com</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container_custom">
    <div class="header">
        <div>Your <span class="orange-logo-text">Logo</span> Here</div>
        <div class="clear-both"></div>
        <div class="menu-header">
            <div id="menu-header-left-section">
                <span><a href="#"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Used Vehicles</a></span>
            </div>
            <div class="clear-both"></div>
        </div>
    </div>
    <div class="sidebar1">
        <div class="search-menu">
            <form method="get" action="">
                <ul>
                    <li><label><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Advance Search</label></li>
                    <li>Make</li>
                    <li>
                        <select name="make">
                            <option value="%">Select all</option>
                            <option value="BMW">BMW</option>
                            <option value="Honda">Honda</option>
                            <option value="Infiniti">Infiniti</option>
                            <option value="Jeep">Jeep</option>
                            <option value="Lexus">Lexus</option>
                            <option value="Toyota">Toyota</option>
                        </select>
                    </li>
                    <li>Year: min</li>
                    <li>
                        <select name="min_year">
                            <option value="1990">Select year&nbsp;</option>
                            <option value="2000">2000</option>
                            <option value="2001">2001</option>
                            <option value="2002">2002</option>
                            <option value="2003">2003</option>
                            <option value="2004">2004</option>
                            <option value="2005">2005</option>
                            <option value="2006">2006</option>
                            <option value="2007">2007</option>
                            <option value="2008">2008</option>
                            <option value="2009">2009</option>
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                        </select>
                    </li>
                    <li>Year: max</li>
                    <li>
                        <select name="max_year">
                            <option value="2020">Select year</option>
                            <option value="2000">2000</option>
                            <option value="2001">2001</option>
                            <option value="2002">2002</option>
                            <option value="2003">2003</option>
                            <option value="2004">2004</option>
                            <option value="2005">2005</option>
                            <option value="2006">2006</option>
                            <option value="2007">2007</option>
                            <option value="2008">2008</option>
                            <option value="2009">2009</option>
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                        </select>
                    </li>
                    <li>Price:</li>
                    <li><input type="number" name="min_price" placeholder="from"></li>
                    <li><input type="number" name="max_price" placeholder="to"></li>
                    <li><input type="submit" name="search" value="Search"></li>
                </ul>
            </form>
        </div>
    </div>
    <div class="content">
        <div class="content-car-section">

            <!-- car items -->
            <?php for($i = 0; $i < $num_cars; $i++) { ?>
            <table id="car-item-<?php echo $i; ?>">
                <tbody>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th class="car-info-column">&nbsp;</th>
                </tr>
                <tr>
                    <td>
                        <div class="row car-images">
                            <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTcxIiBoZWlnaHQ9IjE4MCIgdmlld0JveD0iMCAwIDE3MSAxODAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MTgwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTVlMzljYjA0ZGIgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNWUzOWNiMDRkYiI+PHJlY3Qgd2lkdGg9IjE3MSIgaGVpZ2h0PSIxODAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI1OS41NTQ2ODc1IiB5PSI5NC41Ij4xNzF4MTgwPC90ZXh0PjwvZz48L2c+PC9zdmc+">
                            <span class="badge">4</span>
                        </div>
                    </td>
                    <td>
                        <div class="feature_links">
                            <a href="#" data-toggle="modal" data-target="#shareLinkModal" title="Share this link">
                                <p><i class="fa fa-share-alt" aria-hidden="true"></i>&nbsp;Share</p>
                            </a>
                            <a href="#" class="calculate-payment-link" data-toggle="modal"
                               data-target="#calculatePaymentModal" data-price="<?php echo $all_cars[$i]->getPrice(); ?>" >
                                <p><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Estimate payment</p>
                            </a>
                            <a href="" title="View more details">
                                <p><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;More Details</p>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="car_info">
                            <p>
                                <span class="car-title"><?php echo $all_cars[$i]->getHeadingTitle(); ?> - </span>
                                <span class="price-style">$<?php echo $all_cars[$i]->getPrice(); ?></span>
                            </p>
                            <p><span class="availability"><?php echo $all_cars[$i]->getStatus(); ?></span></p>
                            <p>
                                <span class="mileage"><?php echo $all_cars[$i]->getMileage(); ?> KM</span>&nbsp;|&nbsp;
                                <span class="transmission"><?php echo $all_cars[$i]->getTransmission(); ?></span>&nbsp;|&nbsp;
                                <span class="drivetrain"><?php echo $all_cars[$i]->getDrivetrain(); ?></span>
                            </p>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <?php } ?>
            
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>

        <!-- share modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="shareLinkModal" aria-labelledby="shareLinkModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Copy the URL below to share</h4>
                    </div>
                    <div class="modal-body">
                        <label>Paste this link in email or IM</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3">https://example.com/users/</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- payment calculator modal -->
        <div class="modal fade" id="calculatePaymentModal" tabindex="-1"  role="dialog" aria-labelledby="calculatePaymentModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Estimate your monthly or bi-weekly payment</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="calculateTbl">
                                    <tbody>
                                    <tr>
                                        <td>Vehicle price</td>
                                        <td></td>
                                        <td>&nbsp;</td>
                                        <td><input title="Car price" readonly type="text" class="modal-car-price" name="modal-car-price" value=""></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Trade</td>
                                        <td></td>
                                        <td>&nbsp;</td>
                                        <td><input placeholder="0" title="Trade" type="text" class="modal-trade" name="modal-trade" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Down payment</td>
                                        <td></td>
                                        <td>&nbsp;</td>
                                        <td><input placeholder="0" title="Down payment" type="text" class="modal-down-payment" name="modal-down-payment" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Term by months</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <select title="Term" class="modal-term" name="modal-term" onchange="">
                                                <option value="12">12 months</option>
                                                <option value="24">24 months</option>
                                                <option value="36">36 months</option>
                                                <option value="48">48 months</option>
                                                <option selected="selected" value="60">60 months</option>
                                                <option value="72">72 months</option>
                                                <option value="84">84 months</option>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Interest rate</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td><input value="5.99" placeholder="%" title="Interest rate" type="text" class="modal-int-rate" name="modal-int-rate" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Sales tax</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td><input placeholder="%" title="Sales tax" type="text" class="modal-sales-tax" name="modal-sales-tax" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td><input type="button" class="modal-calculate-btn" name="modal-calculate-btn" value="Calculate"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Monthly payments</td>
                                        <td>&nbsp;</td>
                                        <td>$</td>
                                        <td>&nbsp;<span class="modal-monthly-payment"></span></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Bi-Weekly</td>
                                        <td>&nbsp;</td>
                                        <td>$</td>
                                        <td>&nbsp;<span class="modal-bi-weekly"></span></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <p id="payment-value-notice">Note: This payment calculator uses loan amortization formula and inputs are based on the information you entered. Payment does not include other fees.</p>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="footer">
        <div id="footer-content">
            <p>Copyright © 2012-2014 | Raymart De Guzman | Leo Sudarma</p>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/PaymentCalculator.js"></script>
<script>
    $(document).ready(function () {
       PaymentCalculator.init();
    });
</script>
</body>
</html>