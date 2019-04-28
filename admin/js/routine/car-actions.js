let template = new CommonTemplate();
let CarActions = (function () {

  let deleteCarSel = {},
      confirmDeleteRecordSel = {},
      deleteConfirmBtnSel = {};

  let uploadCarPhotoLink = {},
      uploadDeleteCarPhotoModal = {},
      uploadCarPhotoBtn = {};

  let getPhotosByCarIdFn = {},
      displayImagesOfThisCarSel = {},
      // updateCarInfoSel = {},
      updateCarLink = {},
      updateCarModal = {},
      updateCarInfoModalContent = {},
      checkedField = {};

  let loader = {};

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

      // updateCarInfoSel = $('.dropdown a.update-vehicle');
      updateCarLink = $('a#updateCar_link');
      updateCarModal = $('.update-car-modal');
      updateCarInfoModalContent = $('#update-car-info-modal-content');

      getPhotosByCarIdFn = null;
      checkedField = null;

      loader = $('.loader');

      // call the event driven functions here
      this.bindCarActions();
    },

    bindCarActions: function () {

      // deleting a car
      deleteCarSel.click(function (event) {
        let dataId = $(this).attr("delete");
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
      updateCarLink.click(function(event) {
        let carId = $(this).attr('data-id');
        // console.log($(this).attr('data-id'));
        updateCarModal.modal('show');
        let modalContent = $(updateCarModal).find('.modal-content');
        modalContent.empty();
        updateCarModal.on('shown.bs.modal', function () {
          $.get("api/updateCar.php?action=updateCar&id=" + carId, function (data) {
            let carObj = JSON.parse(data)[0];
            carObj._price = carObj._price.replace(/,/g, '');
            carObj._mileage = carObj._mileage.replace(/,/g, '');
            console.log(carObj);

            let options = {
              id: carObj._vehicleId,
              make: carObj._make,
              model: carObj._model,
              year: carObj._yearMade,
              price: carObj._price,
              cylinder: carObj._cylinder,
              category: carObj._category,
              drivetrain: carObj._drivetrain,
              status: carObj._status,
              transmission: carObj._transmission
            };
            let adminUpdateCar = new AdminPageTemplate(options);
            modalContent.empty();
            modalContent.append(adminUpdateCar.updateCarModalContainer());

            checkedField.field(modalContent, options.year, 'select#year option');
            // checkedField.field(modalContent, options.cylinder, 'input[type=radio]#cylinder');
            // checkedField.field(modalContent, options.category, 'input[type=radio]#category');
            // checkedField.field(modalContent, options.drivetrain, 'input[type=radio]#drivetrain');
            // checkedField.field(modalContent, options.status, 'input[type=radio]#status');
            // checkedField.field(modalContent, options.transmission, 'input[type=radio]#transmission');

          });
        });
        event.preventDefault();
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
        let carId = $(this).attr('upload-delete-photos');
        // show modal for uploading and deleting modal
        uploadDeleteCarPhotoModal.modal('show');
        event.preventDefault();

        // ajax request to display list of photos of this car
        // not using DataTables
        getPhotosByCarIdFn(carId);

        uploadCarPhotoBtn.click(function (e) {
          uploadDeleteCarPhotoModal.modal('hide');
          e.preventDefault();

          let thumbImageSel = $('.thumb');
          let filesDataArray = [];
          for (let i = 0; i < thumbImageSel.length; i++) {
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

          e.preventDefault();
          return false;

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
            let diagramData = {diagrams: diagramArray};
            console.log(diagramData);
            if (diagramArray.length > 0) {
              let html = Mustache.to_html(template.getPhotosByCarIdModalContent(), diagramData);
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
      checkedField = {
        field: function (modalContent, val, fieldElem) {
          console.log('debug');
          let formField = modalContent.find(fieldElem);
          for (let i = 0; i < formField.length; i++) {
            if (fieldElem.indexOf("radio") === -1) {
              if (formField.eq(i).val() === val) {
                formField.eq(i).attr('selected', 'selected');
                break;
              } else {
                formField.eq(i).removeAttr('selected');
              }
            } else {
              if (formField.eq(i).val() === val) {
                formField.eq(i).attr('checked', 'true');
                break;
              }
            }
          }
        }
      };
    }
  }; // end return
})();