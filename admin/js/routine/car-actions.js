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
      updateCarInfoSel = {},
      updateCarInfoModal = {},
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

      updateCarInfoSel = $('.dropdown a.update-vehicle');
      updateCarInfoModal = $('#updateCarInfoModal');
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

            checkedField.field(data[0]._yearMade, 'select#year option');
            checkedField.field(data[0]._cylinder, 'input[type=radio]#cylinder');
            checkedField.field(data[0]._category, 'input[type=radio]#category');
            checkedField.field(data[0]._drivetrain, 'input[type=radio]#drivetrain');
            checkedField.field(data[0]._status, 'input[type=radio]#status');
            checkedField.field(data[0]._transmission, 'input[type=radio]#transmission');
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
      checkedField = {
        field: function (val, fieldElem) {
          let formField = updateCarInfoModalContent.find(fieldElem);
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