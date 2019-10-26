let template = new CommonTemplate();
let CarActions = (function () {

  let deleteCarSel = {},
    confirmDeleteRecordSel = {},
    deleteConfirmBtnSel = {};

  let uploadCarPhotoLink = {},
    uploadDeleteCarPhotoModal = {},
    uploadCarPhotoSubmitBtn = {},
    uploadCarPhotoForm = {};

  let getPhotosByCarIdFn = {},
    displayImagesOfThisCarSel = {},
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
      uploadCarPhotoForm = $('#add-car-photos-form');
      uploadCarPhotoSubmitBtn = $('input[name=upload-car-photos-btn]');

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
      updateCarLink.click(function (event) {
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
            modalContent.append(adminUpdateCar.addOrUpdateCar_Container());

            checkedField.field(modalContent, options.year, 'select#year option');

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
        uploadCarPhotoSubmitBtn.attr('carid', carId);

        return false;
      });

      uploadCarPhotoForm.submit(function (e) {
        uploadDeleteCarPhotoModal.modal('hide');
        e.preventDefault();

        let fd = new FormData(this);
        fd.append('id', uploadCarPhotoSubmitBtn.attr('carid'));

        let thumbImageSel = $('img[model=thumb]');
        for (let i = 0; i < thumbImageSel.length; i++) {
          let srcImg = thumbImageSel.eq(i)[0].currentSrc;
          fd.append('fd[]', srcImg.substring(srcImg.indexOf(',') + 1));
          fd.append('imgType[]', srcImg.substring(0, srcImg.indexOf(',')));
        }

        loader.css('display', 'block');

        $.ajax({
          type: 'POST',
          url: "api/uploadCarImages.php",
          data: fd,
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,
          success: function (r) {
            if (r) {
              loader.css('display', 'none');
            } else {
              alert('fail');
            }
          }
        });

        e.preventDefault();
        return false;
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
              displayImagesOfThisCarSel.empty();
              displayImagesOfThisCarSel.append(template.getPhotosByCarIdModalContent(diagramArray));
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
    }
  };
})();