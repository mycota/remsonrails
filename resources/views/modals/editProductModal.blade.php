
<!-- Adding a new user -->

<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #4682B4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="color: red;">Cancel</span>
                            </button>
                          </div>


                <form method="POST" id="editProd" action=" ">
                        @csrf
                        {{ method_field('POST')}}

                <fieldset><center><legend>Edit Product </legend></center><hr>
                
                <div class="card-body" >

                    
                        <span id="eperrors"></span>

                        
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" id="epid" name="id">
                        <input type="hidden" id="url" name="url" value="{{ route('products.update', '')}}">
                        <div class="form-group row">
                            <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('Product name') }}</label>

                            <div class="col-md-6">
                                <input id="epproduct_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}" required autofocus="true" placeholder="Letters only [A-Z a-z]">

                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

                            <div class="col-md-6">
                                <input id="epqty" type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" value="{{ old('qty') }}" required placeholder="Numbers only [0-9]">

                                @error('qty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="rft" class="col-md-4 col-form-label text-md-right">{{ __('PCS / RFT:') }}</label>

                            <div class="col-md-6">
                                <select id="eppcs_rft" type="text" class="form-control @error('pcs_rft') is-invalid @enderror" name="pcs_rft" value="{{ old('pcs_rft') }}" required>
                                    <option value="">Select pcs / rft</option>
                                    <option value="RFT">RFT</option>
                                    <option value="PCS">PCS</option>
                                </select>

                                @error('pcs_rft')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Customer</button>
                          </div>
                      </div>
                      </fieldset>
                  </form>
              </div>
       </div>                  
</div>



