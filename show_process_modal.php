<!-- Add coupons Modal -->
<div class="modal fade" id="processModal">
    <div class="modal-dialog modal-lg">

      <form action="addchilds.php" id="addchild" method="get" accept-charset="utf-8">
            
      
            <div class="modal-content">
              <div class="modal-header"><!-- 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
                <h3 class="modal-title">Process Item</h3>
              </div>
              <div class="modal-body" style="overflow-y: auto;height:450px;">
                             

                <h5 class="text-left">All the weight revisions of a specific item will be presented here according to the date and time they were updated.</h5>


                <input type="text" name="itemId" id="processItemId" class="form-control" required style="display:none">
                <input type="text" name="type" id="processtype" class="form-control" required style="display:none">
                <input type="text" name="revisedWeight" id="processrevisedWeight" class="form-control" required style="display:none">



                <span class="center-block text-center"><label>Total Weight&nbsp;=&nbsp;</label><label id="showWeight" >&nbsp; 0</label><label>&nbsp;Kg</label></span>

                <span class="center-block text-center"><label>Total Price&nbsp;=&nbsp;</label><label id="showPrice">&nbsp; 0</label><label>&nbsp;Rs/Kg</label></span>

                <br>


                <table class="table table-striped table-bordered" id="processTable" >
                  <thead id="tblHead">
                    <tr>
                      <th>Item Name</th>
                      <th>Quantity</th>
                      <th>Weight (Kg)</th>
                      <th>Content (Kg)</th>
                      <th>Fats (Kg)</th>
                      <th>Unit Cost(Rs)</th>
                      <th>Margin (%)</th>
                      <th>Unit Price Sales(Rs)</th>
                    </tr>
                  </thead>
                  <tbody id="processed_inventory">
                  </tbody>
                </table>


                <div class="row">
                  <div class="col-md-6">
                    <label>Wastage (Kg)</label>
                    <input type="text" name="wastage" id="processwastage" class="form-control" value="0" required>
                  </div>  
                  <div class="col-md-6">
                    <label>Leftover (Kg)</label>
                    <input type="text" name="leftover" id="processleftover" class="form-control" required>
                  </div>  
                </div>




              </div>
              <div class="modal-footer">
                <input type="submit" name="submit" value="Create New Items" class="btn btn-primary">
                <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
              </div>
                      
            </div><!-- /.modal-content -->

      </form>

    </div><!-- /.modal-dialog -->
</div>