
<!-- Adding a new user -->

<div class="modal fade" id="StraightLineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #5F9EA0">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Striaght Line</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="color: red;">Cancel</span>
                            </button>
                          </div>


                <form method="POST" id="sl">
                        @csrf

                <script>
                          
                </script>


                <fieldset><center><legend>Convertor </legend></center><hr>
                
                <div class="card-body">

                        
                    <div class="form-group row">
                            <label for="apprft" class="col-md-4 col-form-label text-md-right">{{ __('Enter Value:') }}</label>

                            <div class="col-md-6">
                                <input id="apprft" oninput="convert();" type="text" class="form-control" name="apprft" value="" required placeholder="Enter value here">

                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                               
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="result" class="col-md-4 col-form-label text-md-right">{{ __('Results:') }}</label>

                            <div class="col-md-6">
                                <input id="result" type="text" class="form-control" name="result" value="" readonly="">
                                <input id="results" type="hidden" class="form-control" name="result" value="" readonly="">

                            </div>
                        </div>
                      </div>


                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add RFT</button>
                          </div>
                      </div>
                      </fieldset>
                  </form>
                </div>
       </div>                  
</div>



