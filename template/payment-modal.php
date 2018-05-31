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
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>