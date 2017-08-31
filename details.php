<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>AutoExpress.com</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/search.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>

    </style>
</head>
<body>
<div class="container_custom">
    <div class="header">
        <div>Your <span class="orange-logo-text">Logo</span> Here</div>
        <div style="clear:both"></div>
        <div class="menu_header">
            <div id="menu_header_left_section">
                <span><a href="#"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Used Vehicles</a></span>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
    <div class="content">


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
        <div id="footer_content">
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