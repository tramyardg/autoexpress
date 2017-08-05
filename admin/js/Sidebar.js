/**
 * Created by RAYMARTHINKPAD on 2017-08-04.
 */
var cHTML = new CommonHTML();
var Sidebar = (function () {
    // regular variables and jquery variables here
    var sidebarMenuItemSel = {};
    var pageWrapperSel = {};

    return {

        /**
         * All the elements required before an
         * event occured must be in the init function.
         */
        init: function () {

            // initialize regular variables and jquery variables from the top
            sidebarMenuItemSel = $(".templatemo-sidebar-menu li");
            pageWrapperSel = $(".template-page-wrapper");

            // call the event driven functions here
            this.bindSidebar();
        },
        bindSidebar: function () {
            pageWrapperSel.prepend(cHTML.sideBarFn());
        }

    }; // end return
})();