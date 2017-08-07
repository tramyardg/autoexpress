/**
 * Created by RAYMARTHINKPAD on 2017-08-04.
 */
var cHTML = new CommonTemplate();
// not use in login and register page
var CommonHTML = (function () {
    // regular variables and jquery variables here
    var sidebarMenuItemSel = {};
    var pageWrapperSel = {};
    var bodyElem = {};
    var mainWrapperSel = {};

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

            // call the event driven functions here
            this.bindHTMLfn();
        },
        bindHTMLfn: function () {
            mainWrapperSel.prepend(cHTML.navBarHeaderElem());
            pageWrapperSel.prepend(cHTML.sideBarElement());
            pageWrapperSel.last().append(cHTML.footerElement());
        }

    }; // end return
})();