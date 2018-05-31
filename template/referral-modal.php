<form action="" method="post" id="referral-modal-form">
    <div class="modal fade" id="referACarModal" tabindex="-1"  role="dialog" aria-labelledby="referACarModalLabel">
        <div class="modal-dialog modal-custom-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Refer this vehicle to your friend</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="divTable-referral">
                                <div class="divTableBody-refferal">
                                    <div class="divTableRow-referral">
                                        <div class="divTableCell-referral">Your name <span style="color: red;">*</span></div>
                                        <div class="divTableCell-referral"><input id="senderName" name="senderName" type="text" required title="sender name"></div>
                                    </div>
                                    <div class="divTableRow-referral">
                                        <div class="divTableCell-referral">Friend email (please use comma without space if more than one email)<span style="color: red;"> *</span></div>
                                        <div class="divTableCell-referral"><input title="Receiver email" id="receiverEmail" name="receiverEmail" type="text" required>&nbsp;<span id="emailadd1_err" style="color: red;"></span></div>
                                    </div>
                                    <div class="divTableRow-referral">
                                        <div class="divTableCell-referral">Message</div>
                                        <div class="divTableCell-referral"><span style="font-size: 9px;"> <span style="color: red;">150</span> characters allowed in the text area</span></div>
                                    </div>
                                    <div class="divTableRow-referral">
                                        <div class="divTableCell-referral">&nbsp;</div>
                                        <div class="divTableCell-referral"><textarea title="Message" id="message" cols="40" maxlength="150" name="message" rows="4"></textarea></div>
                                    </div>
                                    <div class="divTableRow-referral">
                                        <div class="divTableCell-referral">Required fields <span style="color: red;">*</span></div>
                                        <div class="divTableCell-referral">
                                            <input class="btn btn-success btn-sm" name="submit_referral" type="submit" value="Submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>