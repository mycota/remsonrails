
<!-- Adding a new user -->
<!-- <style type="text/css">
  .modal-dialog {
  position: absolute;
  top: 50px;
  right: 100px;
  bottom: 0;
  left: 0;
  z-index: 10040;
  overflow: auto;
  overflow-y: auto;
}
</style> -->

<div class="modal fade" id="StraightLineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #008a9f">
                            <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="color: red;">Cancel</span>
                            </button>
                          </div>


                <form method="POST" id="straight_line">
                        @csrf

                <script>
                          
                </script>


                <!-- <fieldset><center><legend>Converter </legend></center><hr> -->
                
                <div class="card-body">

                  <div class="form-group row">
                            <label for="s_contfrom" class="col-md-4 col-form-label text-md-right">{{ __('From:') }}</label>

                            <div class="col-md-6">
                              <select required id="s_contfrom" oninput="convert_straight();" class="form-control" name="s_contfrom" >
                              <option value="">Select unit</option>
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
                            <option value="">Select unit</option>
                            <option value="MM">Millimeter</option>
                                <option value="CM">Centimeter</option>
                                <option value="FT">Feet</option>
                                <option value="M">Meter</option>
                            </select>
                        </div>
                      </div>
                      <center><hr color="gray"></center>

                  <div class="form-group row">
                            <label for="brck" class="col-md-4 col-form-label text-md-right">{{ __('Bracket') }}</label>

                            <div class="col-md-6">
                                <select required id="brck" type="text" class="form-control " name="brck">
                                    <option disabled value="">Select bracket</option>
                                    <option value="50">50</option>
                                    <option value="75">75</option>
                                    <option value="100">100</option>
                                    <option value="150">150</option>
                                    <option value="Full Profile">Full Profile</option>
                                </select>

                                <input type="hidden" name="" value="" id="railingNo">

                            </div>
                        </div>
                        <center><span id="brckother" style="color: red"></span></center>

                        <div class="form-group row"  id="showother" >
                            <!-- if other is selected then show an input box to enter -->
                        </div>

                        <!-- <div class="form-group row brckshow"></div> -->

                        <div class="form-group row">
                            <label for="s_apprft" class="col-md-4 col-form-label text-md-right">{{ __('Enter Value:') }}</label>

                            <div class="col-md-6">
                                <input id="s_apprft" oninput="convert_straight();" type="number" class="form-control" name="s_apprft" value="" required placeholder="Enter value here">

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

                        <div class="form-group row">
                            <label for="nOG" class="col-md-4 col-form-label text-md-right">{{ __('Number of glass:') }}</label>

                            <div class="col-md-6">
                                <input id="nOG" oninput="dividStraight();" type="number" class="form-control" name="nOG" value="" required placeholder="Enter number of glass">

                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                               
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="s_length" class="col-md-4 col-form-label text-md-right">{{ __('Glass length:') }}</label>

                            <div class="col-md-6">
                                <input id="s_length" type="text" class="form-control" name="s_length" value="" readonly="">
                                <input id="s_lengths" type="hidden" class="form-control" name="s_lengths" value="" readonly="">

                            </div>
                        </div>

                      </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Done</button>
                          </div>
                      </div>
                      <!-- </fieldset> -->
                  </form>
                </div>
       </div>                  
</div>



