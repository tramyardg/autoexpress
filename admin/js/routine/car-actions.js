/**
 * @author: Raymart De Guzman
 * @tramyardg
 */

var util = new CommonUtil();
var template = new CommonTemplate();
var CarActions = (function () {

    var deleteCarSel = {},
        confirmDeleteRecordSel = {},
        deleteConfirmBtnSel = {};

    var uploadCarPhotoLink = {},
        uploadDeleteCarPhotoModal = {},
        uploadCarPhotoBtn = {};

    var getPhotosByCarIdFn = {},
        displayImagesOfThisCarSel = {},
        updateCarInfoSel = {},
        updateCarInfoModal = {},
        updateCarInfoModalContent = {},
        checkedField = null;

    var updateCarInfo_RadioSelect = {};

    var loader = {};

    return {

        /**
         * All the elements required before an
         * event occurred must be in the init function.
         */
        init: function () {

            deleteCarSel = $(".dropdown a.delete-vehicle");
            confirmDeleteRecordSel = $('#confirm-delete-record');
            deleteConfirmBtnSel = $('#delete-yes');
            displayImagesOfThisCarSel = $('#display-images-by-this-car');

            uploadCarPhotoLink = $('.dropdown a.upload-car-photos');
            uploadDeleteCarPhotoModal = $('#upload-delete-car-photos-modal');
            uploadCarPhotoBtn = $('#upload-car-photos-btn');

            updateCarInfoSel = $('.dropdown a.update-vehicle');
            updateCarInfoModal = $('#updateCarInfoModal');
            updateCarInfoModalContent = $('#update-car-info-modal-content');

            getPhotosByCarIdFn = null;
            updateCarInfo_RadioSelect = null;

            loader = $('.loader');

            // call the event driven functions here
            this.bindCarActions();
        },

        bindCarActions: function () {

            // deleting a car
            deleteCarSel.click(function (event) {
                var dataId = $(this).attr("delete");
                confirmDeleteRecordSel.modal('show');
                event.preventDefault();

                deleteConfirmBtnSel.click(function () {
                    confirmDeleteRecordSel.modal('hide');
                    loader.css('display', 'block');
                    $.get("api/deleteVehicle.php?action=delete&id=" + dataId, function (data) {
                        if (data === "1") {
                            loader.css('display', 'none');
                            location.reload();
                        } else {
                            alert('Something is wrong. Please try again later.');
                        }
                    });
                });
            });

            // load data of this car to be updated
            updateCarInfoModal.on('show.bs.modal', function (event) {
                var updateLink = $(event.relatedTarget); // Button that triggered the modal
                var carId = updateLink.data("id"); // Button that triggered the modal
                $.ajax({
                    url: "?action=updateCarInfo&id=" + carId,
                    type: "post",
                    dataType: "json",
                    success: function (data) {
                        // removing commas for input type number
                        data[0]._price = data[0]._price.replace(/,/g, '');
                        data[0]._mileage = data[0]._mileage.replace(/,/g, '');

                        // using Mustache to render data object
                        var html = Mustache.render(template.updateCarInfoModalContent(), data[0]);
                        updateCarInfoModalContent.empty();
                        updateCarInfoModalContent.append(html);

                        updateCarInfo_RadioSelect.YEAR(data[0]._yearMade);
                        // updateCarInfo_RadioSelect.CYLINDER(data[0]._cylinder);
                        checkedField(data[0]._cylinder, 'input[type=radio]#cylinder');
                        updateCarInfo_RadioSelect.CATEGORY(data[0]._category);
                        updateCarInfo_RadioSelect.DRIVETRAIN(data[0]._drivetrain);
                        updateCarInfo_RadioSelect.STATUS(data[0]._status);
                        updateCarInfo_RadioSelect.TRANSMISSION(data[0]._transmission);

                    }
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
            uploadCarPhotoLink.click(function (event) {
                var carId = $(this).attr('upload-delete-photos');
                // show modal for uploading and deleting modal
                uploadDeleteCarPhotoModal.modal('show');
                event.preventDefault();

                // ajax request to display list of photos of this car
                // not using DataTables
                getPhotosByCarIdFn(carId);

                uploadCarPhotoBtn.click(function (e) {
                    uploadDeleteCarPhotoModal.modal('hide');
                    e.preventDefault();

                    var thumbImageSel = $('.thumb');
                    var thumbLength = thumbImageSel.length;
                    var filesDataArray = [];
                    for (var i = 0; i < thumbLength; i++) {
                        filesDataArray.push(thumbImageSel.eq(i).attr('src'));
                    }

                    loader.css('display', 'block');

                    $.post("api/uploadCarImages.php?action=uploadPhotos&id=" + carId, {filesData: filesDataArray}, function (data) {
                        if (data === "1") {
                            loader.css('display', 'none');
                            location.reload();
                        } else {
                            alert('Something is wrong. Please try again later.');
                        }
                    });
                });
            });

            /**
             * Updating a vehicle PHOTO is done as follow
             * 1. using the same template for uploading car photos
             * 2. display current photos if any of that car
             * 2. these images can be deleted and
             * 3. at the bottom shows a normal upload photos
             *
             * Making a request to the same page (inventory.php)
             * usually returns everything including this page
             * itself so use data type json so that
             * it returns only the echoed encoded json array
             * @param carId
             */
            getPhotosByCarIdFn = function (carId) {
                $.ajax({
                    url: "?action=getPhotosByCarId&id=" + carId,
                    type: "post",
                    dataType: "json", // so it returns only the text not the
                    success: function (diagramArray) {
                        // console.log(diagramArray);
                        var diagramData = {diagrams: diagramArray};
                        console.log(diagramData);
                        if (diagramArray.length > 0) {
                            var html = Mustache.to_html(template.getPhotosByCarIdModalContent(), diagramData);
                            displayImagesOfThisCarSel.empty();
                            displayImagesOfThisCarSel.append(html);
                        } else {
                            displayImagesOfThisCarSel.empty();
                            displayImagesOfThisCarSel.append("<p>No photos so far</p>");
                        }
                    }
                }).done(function () {
                    loader.has('loading-photos').css('display', 'none');
                }).fail(function () {
                    alert('Error. Please try again later.');
                });

            };

            /**
             * Populate modal for updating car info
             * Action > update > all radio and select will be checked and
             * selected based on the selected vehicle
             * radio: cylinder, category, drivetrain, transmission, status
             * select: year
             */
            checkedField = function(val, fieldElem)
            {
                var formField = updateCarInfoModalContent.find(fieldElem);
                formField.find(fieldElem).map(function (value, index) {
                    if (value === val) {
                        formField.eq(index).attr('checked', 'true');
                    }
                })
            };

            updateCarInfo_RadioSelect = {
                CYLINDER: function (cylinder) {
                    var cylinders = updateCarInfoModalContent.find('input[type=radio]#cylinder');
                    for (var i = 0; i < cylinders.length; i++) {
                        if (cylinders.eq(i).val() === cylinder) {
                            cylinders.eq(i).attr('checked', 'true');
                            break;
                        }
                    }
                },
                CATEGORY: function (category) {
                    var categories = updateCarInfoModalContent.find('input[type=radio]#category');
                    for (var i = 0; i < categories.length; i++) {
                        if (categories.eq(i).val() === category) {
                            categories.eq(i).attr('checked', 'true');
                            break;
                        }
                    }
                },
                DRIVETRAIN: function (drivetrain) {
                    var drivetrains = updateCarInfoModalContent.find('input[type=radio]#drivetrain');
                    for (var i = 0; i < drivetrains.length; i++) {
                        if (drivetrains.eq(i).val() === drivetrain) {
                            drivetrains.eq(i).attr('checked', 'true');
                            break;
                        }
                    }
                },
                TRANSMISSION: function (transmission) {
                    var transmissions = updateCarInfoModalContent.find('input[type=radio]#transmission');
                    for (var i = 0; i < transmissions.length; i++) {
                        if (transmissions.eq(i).val() === transmission) {
                            transmissions.eq(i).attr('checked', 'true');
                            break;
                        }
                    }
                },
                STATUS: function (status) {
                    var statuses = updateCarInfoModalContent.find('input[type=radio]#status');
                    for (var i = 0; i < statuses.length; i++) {
                        if (statuses.eq(i).val() === status) {
                            statuses.eq(i).attr('checked', 'true');
                            break;
                        }
                    }
                },
                YEAR: function (year) {
                    var years = updateCarInfoModalContent.find('select#year option');
                    for (var i = 0; i < years.length; i++) {
                        if (years.eq(i).val() === year) {
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