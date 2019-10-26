/**
 * Created by RAYMARTHINKPAD on 2017-02-03.
 */
function CommonTemplate() {

  this.confirmDeleteRecord = function () {
    return '<div class="modal fade" id="confirm-delete-record" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  ' +
        '                aria-hidden="true">  ' +
        '               <div class="modal-dialog">  ' +
        '                   <div class="modal-content">  ' +
        '                       <div class="modal-header text-center-important no-border">  ' +
        '                           <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span  ' +
        '                                   class="sr-only">Close</span></button>  ' +
        '                           <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete this record?</h4>  ' +
        '                       </div>  ' +
        '                       <div class="modal-footer text-center-important no-border" id="delete-confirm-btn">  ' +
        '                           <button type="button" class="btn btn-danger btn-sm" id="delete-yes" >Yes</button>  ' +
        '                           <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>  ' +
        '                       </div>  ' +
        '                   </div>  ' +
        '               </div>  ' +
        '          </div>  ';
  };

  this.rowAffectedSuccessfully = function () {
    return '<div class="modal fade" id="row-affected-successfully" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  ' +
        '                aria-hidden="true">  ' +
        '               <div class="modal-dialog">  ' +
        '                   <div class="modal-content">  ' +
        '                       <div class="modal-header text-center-important no-border">  ' +
        '                           <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span  ' +
        '                                   class="sr-only">Close</span></button>  ' +
        '                           <h4 class="modal-title" id="myModalLabel">1 row affected.</h4>  ' +
        '                       </div>  ' +
        '                       <div class="modal-footer text-center-important no-border">  ' +
        '                           <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Ok</button>  ' +
        '                       </div>  ' +
        '                   </div>  ' +
        '               </div>  ' +
        '          </div>  ';
  };

  this.getPhotosByCarIdModalContent = function (d) {
    return d.map((i) => {
      let img = i._imageType + ',' + i._diagram;
      let id = i._diagramId;
      return `<div class="col-xs-6 col-md-3">
           <div class="thumbnail">
              <img src="${img}" alt="">
              <div class="caption">
                 <p></p>
                 <p><a class="delete-car"  href="?action=deleteCarPhoto&id=${id}" delete-photos="${id}" role="button">Delete</a></p>
              </div>
           </div>
        </div>`;
    });
  };

}