
<!-- Adding a new user -->

<div class="modal fade" id="addTransporterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #B0E0E6">
                            <h5 class="modal-title" id="exampleModalCenterTitle">New transporter</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="color: red;">Cancel</span>
                            </button>
                          </div>


                <form method="POST" id="addTrans">
                        @csrf

                <fieldset><center><legend>Add a new Transporter </legend></center><hr>
                
                <div class="card-body" >

                    
                        <span id="terrors"></span>

                        
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="form-group row">
                            <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('Transporter') }}</label>

                            <div class="col-md-6">
                                <input id="transport" type="text" class="form-control @error('transport') is-invalid @enderror" name="transport" value="{{ old('transport') }}" required autofocus="true" placeholder="Letters only [A-Z a-z]">

                                @error('transport')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description:') }}</label>

                            <div class="col-md-6">
                                <input id="apdescription" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required placeholder="Letters only [a-zA-Z">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>
                        </div>


                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Transporter</button>
                          </div>
                      </div>
                      </fieldset>
                  </form>
              </div>
       </div>                  
</div>



