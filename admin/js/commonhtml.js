/**
 * Created by RAYMARTHINKPAD on 2017-08-04.
 */
var cHTML = new CommonTemplate();
var util = new CommonUtil();
var CommonHTML = (function () {
    // regular variables and jquery variables here
    var sidebarMenuItemSel = {};
    var pageWrapperSel = {};
    var bodyElem = {};
    var mainWrapperSel = {};
    var confirmModalLogoutSel = {};
    var commonElement = {},
        headerAndFooterElem = {};


    return {

        /**
         * All the elements required before an
         * event occured must be in the init function.
         */
        init: function () {

            // initialize regular variables and jquery variables from the top
            sidebarMenuItemSel = $(".templatemo-sidebar-menu li");
            pageWrapperSel = $(".template-page-wrapper");
            mainWrapperSel = $("#main-wrapper");
            bodyElem = $('body');
            confirmModalLogoutSel = {};
            commonElement = null;
            headerAndFooterElem = null;

            // call the event driven functions here
            this.bindHTMLfn();
        },
        bindHTMLfn: function () {

            commonElement = function () {
                mainWrapperSel.prepend(cHTML.navBarHeaderElem());       // header
                pageWrapperSel.prepend(cHTML.sideBarElement());         // sidebar
                pageWrapperSel.last().append(cHTML.footerElement());    // footer
                pageWrapperSel.append(cHTML.confirmModalLogout());      // confirm logout
            };

            // for sign-in and register
            headerAndFooterElem = function () {
                mainWrapperSel.prepend(cHTML.navBarHeaderElem());       // header
                mainWrapperSel.last().append(cHTML.footerElement());    // footer
            };
            console.log('hello');
            console.log(util.getFilename());
            switch(util.getFilename()) {
                case "admin.php":
                    commonElement();
                    break;
                case "register.php":
                    headerAndFooterElem();
                    break;
                case "sign-in.php":
                    headerAndFooterElem();
                    break;
                default:

            }


        }




    }; // end return
})();