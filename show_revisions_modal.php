<!-- Add coupons Modal -->
<div class="modal fade" id="revisionsModal">
    <div class="modal-dialog modal-lg">

          <div class="modal-content">
            <div class="modal-header"><!-- 
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
              <h3 class="modal-title">Weight Revisions</h3>
            </div>
            <div class="modal-body" style="overflow-y: auto;height:450px;">
                           

              <h5 class="text-left">All the weight revisions of a specific item will be presented here according to the date and time they were updated.</h5>
              <table class="table table-striped" id="tblGrid" >
                <thead id="tblHead">
                  <tr>
                    <th>Name</th>
                    <th>Original Wgt. (Kg)</th>
                    <th>Revised Wgt. (Kg)</th>
                    <th>ChangedOn</th>
                  </tr>
                </thead>
                <tbody id="revised_information">

                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
            </div>
                    
          </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->
</div>