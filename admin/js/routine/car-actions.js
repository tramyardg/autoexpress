/**
 * Created by RAYMARTHINKPAD on 2017-08-23.
 */

var util = new CommonUtil();
var CarActions = (function () {

    var addCarSel = {};


    return {

        /**
         * All the elements required before an
         * event occurred must be in the init function.
         */
        init: function () {

            addCarSel = $("#add-car");



            // call the event driven functions here
            this.bindCarActions();
        },
        bindCarActions: function () {



            addCarSel.submit(function (event) {
                event.preventDefault();

                // console.log($(this).serialize());
                var formData = new FormData(this);
                console.log(formData);

                $.ajax({
                    type: "post",
                    url: window.location.pathname,
                    success: function (data) {
                        console.log(data);
                    }
                });

                return false;
            });

            console.log(util.getFilename());
            switch(util.getFilename()) {
                case util.pageName[0].name: // dashboard
                    break;
                case util.pageName[1].name:
                    break;
                case util.pageName[2].name:
                    break;
                case util.pageName[3].name:
                    break;
                case util.pageName[4].name: // sign-in
                    break;
                case util.pageName[5].name: // register
                    break;
                default:

            }





        }




    }; // end return
})();