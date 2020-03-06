
<!-- Adding a new user -->

<div class="modal fade" id="StraightLineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #5F9EA0">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Straight Line</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="color: red;">Cancel</span>
                            </button>
                          </div>


                <form method="POST" id="sl">
                        @csrf

                <script>
                          
                </script>


                <fieldset><center><legend>Converter </legend></center><hr>
                
                <div class="card-body">

                  <div class="form-group row">
                            <label for="s_contfrom" class="col-md-4 col-form-label text-md-right">{{ __('From:') }}</label>

                            <div class="col-md-6">
                              <select id="s_contfrom" oninput="convert_straight();" class="form-control" name="s_contfrom" >
                              <option value="0">Select unit</option>
                                <option value="MM">Millimeter</option>
                                <option value="CM">Centimeter</option>
                                <option value="FT">Feet</option>
                                <option value="M">Meter</option>
                              </select> 
                              </div>
                              </div> 

                          <div class="form-group row">
                            <label for="s_contto" class="col-md-4 col-form-label text-md-right">{{ __('To RFT:') }}</label>

                            <div class="col-md-6">
                              <select id="s_contto" oninput="convert_straight();" class="form-control" type="text" style=" width: %; color: ;" name="s_contto" required class="@error('r1glassheight') is-invalid @enderror">
                              <option value="0">Select unit</option>
                            <option value="MM">Millimeter</option>
                                <option value="CM">Centimeter</option>
                                <option value="FT">Feet</option>
                                <option value="M">Meter</option>
                            </select>
                        </div>
                      </div>
                      <hr color="gray">

                  <div class="form-group row">
                            <label for="brck" class="col-md-4 col-form-label text-md-right">{{ __('Bracket') }}</label>

                            <div class="col-md-6">
                                <select id="brck" type="text" class="form-control " name="brck" required>
                                    <option value="">Select bracket</option>
                                    <option value="50">50</option>
                                    <option value="75">75</option>
                                    <option value="100">100</option>
                                    <option value="150">Other</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group row brckshow"></div>

                        <div class="form-group row">
                            <label for="s_apprft" class="col-md-4 col-form-label text-md-right">{{ __('Enter Value:') }}</label>

                            <div class="col-md-6">
                                <input id="s_apprft" oninput="convert_straight();" type="text" class="form-control" name="s_apprft" value="" required placeholder="Enter value here">

                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                               
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="s_result" class="col-md-4 col-form-label text-md-right">{{ __('Results:') }}</label>

                            <div class="col-md-6">
                                <input id="s_result" type="text" class="form-control" name="s_result" value="" readonly="">
                                <input id="s_results" type="hidden" class="form-control" name="s_results" value="" readonly="">

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



