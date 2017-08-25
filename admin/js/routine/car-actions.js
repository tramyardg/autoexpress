/**
 * Created by RAYMARTHINKPAD on 2017-08-23.
 */

var util = new CommonUtil();
var CarActions = (function () {

    var deleteCarSel = {},
        confirmDeleteRecordSel = {},
        deleteConfirmBtnSel = {},
        rowAffectedSuccessSel = {},
        requestErrorModal = {},
        uploadCarPhotoLink = {},
        uploadCarPhotoModal = {},
        uploadCarPhotoBtn = {},
        addCarPhotosForm = {};


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
            requestErrorModal = $('#request-error');
            uploadCarPhotoLink = $('.dropdown a.upload-car-photos');
            uploadCarPhotoModal = $('#upload-car-photos-modal');
            uploadCarPhotoBtn = $('#upload-car-photos-btn');
            addCarPhotosForm = $('#add-car-photos-form');


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
                    }).fail(function(data){
                        requestErrorModal.modal('show');
                    });
                });
                return false; //for good measure
            });

            uploadCarPhotoLink.click(function (event){
                var dataId = $(this).attr('upload-photos');
                uploadCarPhotoModal.modal('show');
                event.preventDefault();


                uploadCarPhotoBtn.click(function (e) {
                    uploadCarPhotoModal.modal('hide');
                    rowAffectedSuccessSel.modal('show');


                    var thumbImageSel = $('.thumb');
                    var thumbLength = thumbImageSel.length;
                    var filesDataArray = [];
                    for(var i = 0; i < thumbLength; i++) {
                        filesDataArray.push(thumbImageSel.eq(i).attr('src'));
                    }

                    $.ajax({
                        url: "?action=uploadPhotos&id="+dataId,
                        type: "post",
                        data: {filesData : filesDataArray},
                        success: function(data) {
                            if(data === 1) {
                                rowAffectedSuccessSel.modal('show');
                            }
                        }
                    }).fail(function(data){
                        requestErrorModal.modal('show');
                    });

                    e.preventDefault();
                    return false;
                });

                return false;
            });









        }




    }; // end return
})();