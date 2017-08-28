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
        displayImagesByThisCarSel = {},
        updateCarInfoSel = {},
        updateCarInfoModal = {},
        updateCarInfoModalContent = {};

    var checkedCylinderRadioBtnFn = {},
        checkedCategoryRadioBtnFn = {},
        checkedDrivetrainRadioBtnFn = {},
        checkedTransmissionRadioBtnFn = {};

    var selectedMakeSelectOptionFn = {},
        selectedYearSelectOptionFn = {};


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
            updateCarInfoSel = $('.dropdown a.update-vehicle');
            updateCarInfoModal = $('#updateCarInfoModal');
            updateCarInfoModalContent = $('#update-car-info-modal-content');

            getPhotosByCarIdFn = null;
            checkedCylinderRadioBtnFn = null;
            checkedCategoryRadioBtnFn = null;
            checkedDrivetrainRadioBtnFn = null;
            checkedTransmissionRadioBtnFn = null;

            selectedMakeSelectOptionFn = null;
            selectedYearSelectOptionFn = null;

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

            // updating a car info
            updateCarInfoModal.on('show.bs.modal', function (event) {
                var updateLink = $(event.relatedTarget); // Button that triggered the modal
                var carId = updateLink.data("id"); // Button that triggered the modal
                // var carId = updateLink.data('carid');
                // event.preventDefault();
                // alert(carId);
                $.ajax({
                    url: "?action=updateCarInfo&id="+carId,
                    type: "post",
                    dataType: "json",
                    success: function(data) {

                        // console.log(data[0]._make);
                        var html = Mustache.render(template.updateCarInfoModalContent(util), data[0]);
                        updateCarInfoModalContent.empty();
                        updateCarInfoModalContent.append(html);
                        // $('#update-car-info-modal-content input[type=radio]#cylinder').eq(0)

                        selectedMakeSelectOptionFn(data[0]._make);
                        selectedYearSelectOptionFn(data[0]._yearMade);
                        checkedCylinderRadioBtnFn(data[0]._cylinder);
                        checkedCategoryRadioBtnFn(data[0]._category);
                        checkedDrivetrainRadioBtnFn(data[0]._drivetrain);
                        checkedTransmissionRadioBtnFn(data[0]._transmission);

                        // updateCarInfoModalContent.find('input[type=radio]#make')
                        //var makes = updateCarInfoModalContent.find('select#make');
                        //makes.attr('onchange', "new CommonUtil().selectCarMake(this)");


                    }
                }).fail(function(data){
                    requestErrorModal.modal('show');
                });

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
                            displayImagesByThisCarSel.empty();
                            displayImagesByThisCarSel.append(diagrams);
                        } else {
                            displayImagesByThisCarSel.append("<p>No photos so far</p>");
                        }
                    }
                }).fail(function(data){
                    requestErrorModal.modal('show');
                });

            };

            checkedCylinderRadioBtnFn = function (cylinder) {
                var cylinders = updateCarInfoModalContent.find('input[type=radio]#cylinder');
                for(var i = 0; i < cylinders.length; i++) {
                    if(cylinders.eq(i).val() === cylinder) {
                        cylinders.eq(i).attr('checked', 'true');
                        break;
                    }
                }
            };

            checkedCategoryRadioBtnFn = function (category) {
                var categories = updateCarInfoModalContent.find('input[type=radio]#category');
                for(var i = 0; i < categories.length; i++) {
                    if(categories.eq(i).val() === category) {
                        categories.eq(i).attr('checked', 'true');
                        break;
                    }
                }
            };

            checkedDrivetrainRadioBtnFn = function (drivetrain) {
                var drivetrains = updateCarInfoModalContent.find('input[type=radio]#drivetrain');
                for(var i = 0; i < drivetrains.length; i++) {
                    if(drivetrains.eq(i).val() === drivetrain) {
                        drivetrains.eq(i).attr('checked', 'true');
                        break;
                    }
                }
            };

            checkedTransmissionRadioBtnFn = function (transmission) {
                var transmissions = updateCarInfoModalContent.find('input[type=radio]#transmission');
                for(var i = 0; i < transmissions.length; i++) {
                    if(transmissions.eq(i).val() === transmission) {
                        transmissions.eq(i).attr('checked', 'true');
                        break;
                    }
                }
            };

            selectedMakeSelectOptionFn = function (make) {
                var makes = updateCarInfoModalContent.find('select#make option');
                for(var i = 0; i < makes.length; i++) {
                    if(makes.eq(i).val() === make) {
                        makes.eq(i).attr('selected', 'selected');
                        break;
                    }
                }
            };

            selectedYearSelectOptionFn = function (year) {
                var years = updateCarInfoModalContent.find('select#year option');
                for(var i = 0; i < years.length; i++) {
                    if(years.eq(i).val() === year) {
                        years.eq(i).attr('selected', 'selected');
                        break;
                    }
                }
            };









        }




    }; // end return
})();