/**
 * Created by RAYMARTHINKPAD on 2017-08-23.
 */

var util = new CommonUtil();
var template = new CommonTemplate();
var CarActions = (function () {

    var deleteCarSel = {},
        confirmDeleteRecordSel = {},
        deleteConfirmBtnSel = {},
        rowAffectedSuccessSel = {},
        requestErrorModal = {},
        uploadCarPhotoLink = {},
        uploadDeleteCarPhotoModal = {},
        uploadCarPhotoBtn = {},
        addCarPhotosForm = {},
        updateUploadedPhotosSel = {};

    var getPhotosByCarIdFn = {},
        displayImagesByThisCarSel = {};
        // deleteCarPhotoSel = {};


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
            uploadDeleteCarPhotoModal = $('#upload-delete-car-photos-modal');
            uploadCarPhotoBtn = $('#upload-car-photos-btn');
            addCarPhotosForm = $('#add-car-photos-form');
            updateUploadedPhotosSel = $('#update-uploaded-photos');
            displayImagesByThisCarSel = $('#display-images-by-this-car');
            // deleteCarPhotoSel = $('#display-images-by-this-car a.delete-car');
            getPhotosByCarIdFn = null;


            // call the event driven functions here
            this.bindCarActions();
        },

        bindCarActions: function () {

            // deleting a car
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
                var carId = $(this).attr('upload-delete-photos');
                uploadDeleteCarPhotoModal.modal('show');
                event.preventDefault();

                // for displaying list of photos of this vehicle
                updateUploadedPhotosSel.DataTable({
                    "pageLength": 1,
                    "lengthChange": false,
                    searching: false,
                    // "bInfo": false,
                    "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [0] }]
                });

                // ajax request to display list of photos of this car
                getPhotosByCarIdFn(carId);

                uploadCarPhotoBtn.click(function (e) {
                    uploadDeleteCarPhotoModal.modal('hide');
                    rowAffectedSuccessSel.modal('show');


                    var thumbImageSel = $('.thumb');
                    var thumbLength = thumbImageSel.length;
                    var filesDataArray = [];
                    for(var i = 0; i < thumbLength; i++) {
                        filesDataArray.push(thumbImageSel.eq(i).attr('src'));
                    }

                    $.ajax({ // for uploading photos
                        url: "?action=uploadPhotos&id="+carId,
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
             *
             * Updating a vehicle PHOTO is done as follow
             * 1. using the same template for uploading car photos
             * 2. display current photos if any of that car
             * 2. these images can be deleted
             * 3. at the bottom shows a normal upload photos
             *
             * Making a request to the same page (inventory.php)
             * usually returns everything including this page
             * itself so use data type text so that
             * it returns only the echoed encoded json array
             * @param carId
             */
            getPhotosByCarIdFn = function(carId) {
                $.ajax({ // for deleting photos
                    url: "?action=getPhotosByCarId&id="+carId,
                    type: "post",
                    dataType: "json", // so it returns only the text not the
                    success: function(diagramArray) {
                        if(diagramArray.length > 0) {
                            var diagrams = template.getPhotosByCarIdModalContent(diagramArray);
                            displayImagesByThisCarSel.append(diagrams);
                        } else {
                            displayImagesByThisCarSel.append("<p>No photos so far</p>");
                        }
                    }
                }).fail(function(data){
                    requestErrorModal.modal('show');
                });

                // console.log(deleteCarPhotoSel);

                // deleting a car photos
                // deleteCarPhotoSel.click(function (event){
                //     var carId = $(this).attr("delete-photos");
                //     alert(carId);
                //     confirmDeleteRecordSel.modal('show');
                //     event.preventDefault();
                //
                //     // deleteConfirmBtnSel.click(function () {
                //     //     confirmDeleteRecordSel.modal('hide');
                //     //     rowAffectedSuccessSel.modal('show');
                //     //     $.ajax({
                //     //         url: "?action=deleteCarPhoto",
                //     //         type: "get",
                //     //         data: "id=" + carId,
                //     //         success: function(data) {
                //     //             if(data === 1) {
                //     //                 rowAffectedSuccessSel.modal('show');
                //     //             }
                //     //         }
                //     //     }).fail(function(data){
                //     //         requestErrorModal.modal('show');
                //     //     });
                //     // });
                //     return false; //for good measure
                // });
            };











        }




    }; // end return
})();