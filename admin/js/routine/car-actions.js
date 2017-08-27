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
        addCarPhotosForm = {},
        updateUploadedPhotosSel = {};


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
            updateUploadedPhotosSel = $('#update-uploaded-photos');


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

            /**
             * Uploading photo is done as follow:
             * 1. click link upload photo
             * 2. modal show up - form with input file multiple
             * 3. click upload button
             * 4. gets src of images being uploaded
             * 5. src is passed to data properties of request as array or single variable
             * 6. php process the request and done
             */
            uploadCarPhotoLink.click(function (event){
                var dataId = $(this).attr('upload-photos');
                uploadCarPhotoModal.modal('show');
                event.preventDefault();

                updateUploadedPhotosSel.DataTable({
                    "pageLength": 1,
                    "lengthChange": false,
                    searching: false,
                    // "bInfo": false,
                    "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [0] }]
                });


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

            /**
             * Updating a vehicle INFO is done as follow
             * ONLY information is to be updated here
             * no image
             * 1. admin clicks on a the vehicle they wish to update
             * 2. update modal form show up similar to adding new vehicle shows up
             */


            /**
             * OPTION 1. Updating a vehicle PHOTO is done as follow
             * 1. there will be a link when click it shows a list of image of that car
             * 2. these images can be deleted
             */

            /**
             * OPTION 2. Updating a vehicle PHOTO is done as follow
             * 1. using the same template for uploading car photos
             * 2. display current photos if any of that car
             * 2. these images can be deleted
             * 3. at the bottom shows a normal upload photos
             */


            // switch(util.getFilename()) {
            //     case util.pageName[1].name:
            //         updateUploadedPhotosSel.DataTable({
            //             "pageLength": 1,
            //             "lengthChange": false,
            //             searching: false
            //         });
            //         break;
            //     default:
            // }








        }




    }; // end return
})();