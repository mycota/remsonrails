
<!-- Adding a new user -->

<div class="modal fade" id="ClearAllGlassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <center><div class="modal-header" style="background-color: red; color: white;">
                            <h4 class="modal-title" id="exampleModalCenterTitle">Clear All Extra Glass Type</h4>
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="color: red;">Cancel</span>
                            </button> -->
                          </div></center>


                
                <fieldset><center><legend></legend></center><hr>
                
                <div class="card-body">
                  <center><h4 style="color: red;">Are you sure you want to delete all?</h4></center>
                  <!-- <input type="hidde" id="delquotid" value="{{ route('glasstype.destroy', $quotOrdID) }}" data-uri="{{ route('glasstype.destroy', $quotOrdID) }}" name="">  -->

                  
                 <!--  <center><small style="color: red;">Please note, all extra glass type would be deleted once the quotation is done or on page reload</small></center>
                        Clear All -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="btn_del" data-uri="{{ route('glasstype.destroy', $quotOrdID) }}" class="btn btn-danger">Delete</button>
                    </div>
                  </div>
                      </fieldset>
                 
                </div>
       </div>                  
</div>



