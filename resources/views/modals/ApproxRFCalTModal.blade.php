
<!-- Adding a new user -->

<div class="modal fade" id="ApproxRFCalTModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #5F9EA0">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Approximate RFT Conversion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="color: red;">Cancel</span>
                            </button>
                          </div>


                <form method="POST" id="app">
                        @csrf

                <script>

                </script>


                <fieldset><center><legend>Convertor </legend></center><hr>

                <div class="card-body">

                          <div class="form-group row">
                            <label for="result" class="col-md-4 col-form-label text-md-right">{{ __('From:') }}</label>

                            <div class="col-md-6">
                              <select id="contfrom" oninput="convert_RFT();" class="form-control" name="contfrom" >
                              <option value="0">Select unit</option>
                                <option value="MM">Millimeter</option>
                                <option value="CM">Centimeter</option>
                                <option value="FT">Feet</option>
                                <option value="M">Meter</option>
                              </select>
                              </div>
                              </div>

                          <div class="form-group row">
                            <label for="result" class="col-md-4 col-form-label text-md-right">{{ __('To:') }}</label>

                            <div class="col-md-6">
                              <select id="contto" oninput="convert_RFT();" class="form-control" type="text" style=" width: %; color: ;" name="contto" required class="@error('r1glassheight') is-invalid @enderror">
                              <option value="0">Select unit</option>
                            <option value="MM">Millimeter</option>
                                <option value="CM">Centimeter</option>
                                <option value="FT">Feet</option>
                                <option value="M">Meter</option>
                            </select>
                        </div>
                      </div>

                    <div class="form-group row">
                            <label for="apprft" class="col-md-4 col-form-label text-md-right">{{ __('Enter Value:') }}</label>

                            <div class="col-md-6">
                                <input id="apprft" oninput="convert_RFT();" type="text" class="form-control" name="apprft" value="" required placeholder="Enter value here">

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
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add RFT</button>
                          </div>
                      </div>
                      </fieldset>
                  </form>
                </div>
       </div>
</div>



