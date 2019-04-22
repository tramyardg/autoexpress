/**
 * Created by RAYMARTHINKPAD on 2017-08-04.
 */
var cHTML = new CommonTemplate();
var cHTML2 = new AdminPageTemplate2();
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
      fnPageTitle = {},
      fnManipulateRecordElem = {};

  var adminUsernameSel = {},
      adminTableSel = {},
      carTableSel = {},
      priceColumnSel = {},
      mileageColumnSel = {};


  return {

    /**
     * All the elements required before an
     * event occurred must be in the init function.
     */
    init: function () {

      // initialize regular variables and jquery variables from the top
      headSel = $('head');
      sidebarMenuItemSel = $(".templatemo-sidebar-menu li");
      pageWrapperSel = $(".template-page-wrapper");
      mainWrapperSel = $("#main-wrapper");
      adminUsernameSel = $('#admin-username');
      adminTableSel = $('#admin-table');
      carTableSel = $('#vehicle-table');
      priceColumnSel = $("#vehicle-table > tbody > tr > td:nth-child(6)");
      mileageColumnSel = $("#vehicle-table > tbody > tr > td:nth-child(8)");

      bodyElem = $('body');
      confirmModalLogoutSel = {};
      fnCommonElement = null;
      fnHeaderAndFooterElem = null;
      fnPageTitle = null;
      fnManipulateRecordElem = null;


      // call the event driven functions here
      this.bindCarActionFn();
    },
    bindCarActionFn: function () {

      // sets page title dynamically
      fnPageTitle = function () {
        for (var i = 0; i < util.pageName.length; i++) {
          if (util.getFilename() === util.pageName[i].name) {
            headSel.append(cHTML.pageTitle(util.pageName[i].title));
          }
        }

      };

      fnPageTitle();

      fnCommonElement = function () {                                            // contents
        mainWrapperSel.prepend(cHTML.navBarHeaderElem());                         // header
        pageWrapperSel.prepend(cHTML2.sideBar(adminUsernameSel.val()));     // sidebar
        pageWrapperSel.last().append(cHTML.footerElement());                      // footer
        pageWrapperSel.append(cHTML.confirmModalLogout());                        // confirm logout
      };

      fnHeaderAndFooterElem = function () {                   // contents
        mainWrapperSel.prepend(cHTML.navBarHeaderElem());       // header
        mainWrapperSel.last().append(cHTML.footerElement());    // footer
      };

      fnManipulateRecordElem = function () {
        pageWrapperSel.append(cHTML.confirmDeleteRecord());
        pageWrapperSel.append(cHTML.rowAffectedSuccessfully());
      };


      // console.log(util.getFilename());

      switch (util.getFilename()) {
        case util.pageName[0].name: // dashboard
          fnCommonElement();
          break;
        case util.pageName[1].name:
          fnCommonElement();
          fnManipulateRecordElem();
          break;
        case util.pageName[2].name:
          fnCommonElement();
          adminTableSel.DataTable({
            "pageLength": 5,
            "lengthChange": false,
            searching: false
          });
          fnManipulateRecordElem();
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