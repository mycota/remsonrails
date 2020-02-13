
<!-- Adding a new user -->

<div class="modal fade" id="addQuotationsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #F0F8FF">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Site Measurement</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="color: red;">Cancel</span>
                            </button>
                          </div>


                <form method="POST" id="addQuots">
                        @csrf

                <fieldset><center><legend>Start new site measurement </legend></center><hr>
                
                <div class="card-body" >

                    
                        <span id="terrors"></span>

                        
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    

                        <div class="form-group row">
                            <label for="client" class="col-md-4 col-form-label text-md-right">{{ __('Customer') }}</label>

                            <div class="col-md-6">
                                <select id="client" type="text" class="form-control @error('client') is-invalid @enderror" name="client" value="{{ old('client') }}" required>
                                    <option value="">Select existing customer</option>
                                    
                                </select>

                                @error('client')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <center><a href="yeyey"><input name="" type="button" style="background-color: orange;" value="New customer, click here"></a></center>

                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Continue</button>
                          </div>
                      </div>
                      </fieldset>
                  </form>
              </div>
       </div>                  
</div>



