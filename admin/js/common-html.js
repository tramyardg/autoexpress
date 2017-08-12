/**
 * Created by RAYMARTHINKPAD on 2017-08-04.
 */
var cHTML = new CommonTemplate();
var util = new CommonUtil();
var CommonHTML = (function () {
    // regular variables and jquery variables here
    var headSel = {};
    var sidebarMenuItemSel = {};
    var pageWrapperSel = {};
    var bodyElem = {};
    var mainWrapperSel = {};
    var confirmModalLogoutSel = {};
    var fnCommonElement = {},
        fnHeaderAndFooterElem = {},
        fnPageTitle = {};
    var adminUsernameSel = {};


    return {

        /**
         * All the elements required before an
         * event occured must be in the init function.
         */
        init: function () {

            // initialize regular variables and jquery variables from the top
            headSel = $('head');
            sidebarMenuItemSel = $(".templatemo-sidebar-menu li");
            pageWrapperSel = $(".template-page-wrapper");
            mainWrapperSel = $("#main-wrapper");
            adminUsernameSel = $('#admin-username');

            bodyElem = $('body');
            confirmModalLogoutSel = {};
            fnCommonElement = null;
            fnHeaderAndFooterElem = null;
            fnPageTitle = null;


            // call the event driven functions here
            this.bindHTMLfn();
        },
        bindHTMLfn: function () {

            // sets page title dynamically
            fnPageTitle = function () {
                for(var i = 0; i < util.pageName.length; i++) {
                    if(util.getFilename() === util.pageName[i].name) {
                        headSel.append(cHTML.pageTitle(util.pageName[i].title));
                    }
                }
            };

            fnPageTitle();

            fnCommonElement = function () {
                mainWrapperSel.prepend(cHTML.navBarHeaderElem());                         // header
                pageWrapperSel.prepend(cHTML.sideBarElement(adminUsernameSel.val()));         // sidebar
                pageWrapperSel.last().append(cHTML.footerElement());                      // footer
                pageWrapperSel.append(cHTML.confirmModalLogout());                        // confirm logout
            };

            // for sign-in and register
            fnHeaderAndFooterElem = function () {
                mainWrapperSel.prepend(cHTML.navBarHeaderElem());       // header
                mainWrapperSel.last().append(cHTML.footerElement());    // footer
            };
            console.log(util.getFilename());
            switch(util.getFilename()) {
                case util.pageName[0].name: // dashboard
                    fnCommonElement();
                    break;
                case util.pageName[1].name:
                    fnCommonElement();
                    break;
                case util.pageName[2].name:
                    fnCommonElement();
                    break;
                case util.pageName[3].name:
                    fnCommonElement();
                    break;
                case util.pageName[4].name: // sign-in
                    fnHeaderAndFooterElem();
                    break;
                case util.pageName[5].name: // register
                    fnHeaderAndFooterElem();
                    break;
                default:

            }


        }




    }; // end return
})();