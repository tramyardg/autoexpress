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

    var updateCarInfo_RadioSelect = {};


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
            updateCarInfo_RadioSelect = null;

            // checkedCylinderRadioBtnFn = null;
            // checkedCategoryRadioBtnFn = null;
            // checkedDrivetrainRadioBtnFn = null;
            // checkedTransmissionRadioBtnFn = null;
            // selectedMakeSelectOptionFn = null;
            // selectedYearSelectOptionFn = null;

            // call the event driven functions here
            this.bindCarActions();
        },

        bindCarActions: function () {

            // alert($('.add-new-car-modal-lg').hasClass('in'));


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
                $.ajax({
                    url: "?action=updateCarInfo&id="+carId,
                    type: "post",
                    dataType: "json",
                    success: function(data) {

                        // using Mustache to render data object
                        var html = Mustache.render(template.updateCarInfoModalContent(util), data[0]);
                        updateCarInfoModalContent.empty();
                        updateCarInfoModalContent.append(html);

                        updateCarInfo_RadioSelect.YEAR(data[0]._yearMade);
                        updateCarInfo_RadioSelect.CYLINDER(data[0]._cylinder);
                        updateCarInfo_RadioSelect.CATEGORY(data[0]._category);
                        updateCarInfo_RadioSelect.DRIVETRAIN(data[0]._drivetrain);
                        updateCarInfo_RadioSelect.STATUS(data[0]._status);
                        updateCarInfo_RadioSelect.TRANSMISSION(data[0]._transmission);

                        // mapping of appropriate models after selecting make
                        var selectMakeOption = updateCarInfoModalContent.find('select#make');
                        selectMakeOption.on('change', function () {
                            util.selectCarMake($(this));
                        });

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

            /**
             * Action > update > all radio and select will be checked and
             * selected based on the selected vehicle
             * radio: cylinder, category, drivetrain, transmission, status
             * select: year
             */
            updateCarInfo_RadioSelect = {
                CYLINDER: function (cylinder) {
                    var cylinders = updateCarInfoModalContent.find('input[type=radio]#cylinder');
                    for(var i = 0; i < cylinders.length; i++) {
                        if(cylinders.eq(i).val() === cylinder) {
                            cylinders.eq(i).attr('checked', 'true');
                            break;
                        }
                    }
                },
                CATEGORY: function (category) {
                    var categories = updateCarInfoModalContent.find('input[type=radio]#category');
                    for(var i = 0; i < categories.length; i++) {
                        if(categories.eq(i).val() === category) {
                            categories.eq(i).attr('checked', 'true');
                            break;
                        }
                    }
                },
                DRIVETRAIN: function (drivetrain) {
                    var drivetrains = updateCarInfoModalContent.find('input[type=radio]#drivetrain');
                    for(var i = 0; i < drivetrains.length; i++) {
                        if(drivetrains.eq(i).val() === drivetrain) {
                            drivetrains.eq(i).attr('checked', 'true');
                            break;
                        }
                    }
                },
                TRANSMISSION: function (transmission) {
                    var transmissions = updateCarInfoModalContent.find('input[type=radio]#transmission');
                    for(var i = 0; i < transmissions.length; i++) {
                        if(transmissions.eq(i).val() === transmission) {
                            transmissions.eq(i).attr('checked', 'true');
                            break;
                        }
                    }
                },
                STATUS: function (status) {
                    var statuses = updateCarInfoModalContent.find('input[type=radio]#status');
                    for(var i = 0; i < statuses.length; i++) {
                        if(statuses.eq(i).val() === status) {
                            statuses.eq(i).attr('checked', 'true');
                            break;
                        }
                    }
                },
                YEAR: function (year) {
                    var years = updateCarInfoModalContent.find('select#year option');
                    for(var i = 0; i < years.length; i++) {
                        if(years.eq(i).val() === year) {
                            years.eq(i).attr('selected', 'selected');
                            break;
                        } else {
                            years.eq(i).removeAttr('selected');
                        }
                    }
                }
            };

        }




    }; // end return
})();