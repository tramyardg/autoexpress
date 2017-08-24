/**
 * Created by RAYMARTHINKPAD on 2017-08-23.
 */

var util = new CommonUtil();
var CarActions = (function () {

    var deleteCarSel = {},
        confirmDeleteRecordSel = {},
        deleteConfirmBtnSel = {},
        rowAffectedSuccessSel = {};


    return {

        /**
         * All the elements required before an
         * event occurred must be in the init function.
         */
        init: function () {

            deleteCarSel = $(".dropdown a.delete-vehicle");
            confirmDeleteRecordSel = $('#confirm-delete-record');
            deleteConfirmBtnSel = $('#delete-yes');
            rowAffectedSuccessSel = $('#row-affected-successfully');



            // call the event driven functions here
            this.bindCarActions();
        },
        bindCarActions: function () {

            deleteCarSel.click(function (event){
                var dataId = $(this).attr("delete");
                confirmDeleteRecordSel.modal('show');
                event.preventDefault();

                deleteConfirmBtnSel.click(function () {
                    confirmDeleteRecordSel.modal('hide');
                    rowAffectedSuccessSel.modal('show');
                    $.ajax({
                        url: "?action=delete",
                        type: "get",
                        data: "id=" + dataId,
                        success: function(data) {
                            if(data === 1) {
                                rowAffectedSuccessSel.modal('show');
                            }
                        }
                    });
                });
                return false; //for good measure
            });









        }




    }; // end return
})();