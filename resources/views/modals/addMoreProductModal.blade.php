
<!-- Adding a new user -->

<div class="modal fade" id="addMoreProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #5F9EA0">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="color: red;">Cancel</span>
                            </button>
                          </div>


                <form method="POST" id="amp">
                        @csrf

                <fieldset><center><legend>Add More Product </legend></center><hr>
                
                <div class="card-body">

                  <div class="form-group row">
                            <label for="prodname" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>

                            <div class="col-md-6">
                                <select required name="prodname" type="text" class="form-control" id="prodname" onchange="products(this.id,'prodtype'); productscover('prodtype','prodcover')">
                                    <option value="">Select product name</option>
                                    <option value="SMART LINE CONTINUE PROFILE">SMART LINE</option>
                                    <option value="SEA LINE BRACKET PROFILE">SEA LINE</option>
                                    <option value="SQUARE LINE BRACKET PROFILE">SQUARE LINE</option>
                                    <option value="SLIM LINE CONTINUE PROFILE">SLIM LINE</option>
                                    <option value="SMALL LINE CONTINUE PROFILE">SMALL LINE</option>
                                    <option value="STAR LINE BRACKET PROFILE">STAR LINE</option>
                                    <option value="SKY LINE BRACKET PROFILE">SKY LINE</option>
                                    <option value="SPARK LINE BRACKET PROFILE">SPARK LINE</option>
                                    <option value="SLEEK LINE CONTINUE PROFILE">SLEEK LINE</option>
                                    <option value="SUPER LINE CONTINUE PROFILE">SUPER LINE</option>
                                    <option value="SIGNATURE LINE CONTINUE PROFILE">SIGNATURE LINE</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group row brckshow"></div>

                        <div class="form-group row">
                            <label for="prodtype" class="col-md-4 col-form-label text-md-right">{{ __('Product Type:') }}</label>

                            <div class="col-md-6">
                            <select required type="text" class="form-control" name="prodtype" id="prodtype" onchange="productscover(this.id,'prodcover')">
                              <option value="">Product type</option>   
                            </select>
                        </div>
                      </div>

                        <div class="form-group row">

                            <label for="prodcover" class="col-md-4 col-form-label text-md-right">{{ __('Product Cover:') }}</label>

                            <div class="col-md-6">
                                <select name="prodcover" id="prodcover" type="text" class="form-control" >
                                  <option value="">Product cover</option>

                                </select>

                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="hand" class="col-md-4 col-form-label text-md-right">{{ __('Hand Rail:') }}</label>

                            <div class="col-md-6">
                                <select required="" name="hand" id="hand" type="text" class="form-control " >
                                  <option value="">Select hand rail</option>
                                  <option value="ROUND HAND RAIL">ROUND</option>
                                  <option value="SQUARE HAND RAIL">SQUARE</option>
                                  <option value="SMALL HAND RAIL">SMALL</option>
                                  <option value="SLIM HAND RAIL">SLIM</option>
                                  <option value="EDGE GUARD HAND RAIL">EDGE GUARD</option>
                                  <option value="HALF ROUND HAND RAIL">HALF ROUND</option>
                                  <option value="RECTANGLE HAND RAIL">RECTANGLE</option>
                                  <option value="INCLINE HAND RAIL">INCLINE</option>

                                </select>

                            </div>
                        </div>
                      </div>


                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger " data-dismiss="modal">Cancel</button>
                            

                            <button type="submit" class="btn btn-info">Add</button>
                          </div>
                      </div>
                      </fieldset>
                  </form>
                </div>
       </div>                  
</div>



