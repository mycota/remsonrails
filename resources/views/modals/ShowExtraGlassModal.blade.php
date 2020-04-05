
<!-- Adding a new user -->

<div class="modal fade" id="ShowExtraGlassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #5F9EA0">
                            <h4 class="modal-title" id="exampleModalCenterTitle">View Extra Glass Type</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="color: red;">Cancel</span>
                            </button>
                          </div>


                
                <fieldset><center><legend></legend></center><hr>
                
                <div class="card-body">
                  <center><h4 style="color: green;">Temporal Glass type storage</h4></center>
                  <input type="hidden" id="quotid" data-uri="{{ route('glasstype.show', $quotOrdID) }}" name="">  

                  <ul class="list-group" id="stored">
                        
                  </ul>
                        <center><small style="color: red;">Please note, all extra glass type would be deleted once the quotation is done or on page reload</small></center>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="btn_egt" class="btn btn-primary">Add</button>
                          </div> -->
                      </div>
                      </fieldset>
                 
                </div>
       </div>                  
</div>



