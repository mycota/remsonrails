
<!-- Adding a new user -->

<div class="modal fade" id="addMoreProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #5F9EA0">
                            <h5 class="modal-title" id="exampleModalCenterTitle"> Add Product</h5>
                            <button type="button" id="reset0" class="close reset" data-dismiss="modal" aria-label="Close">
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
                                    @foreach($products as $product)
                                      @foreach($product->product_despt()->get()->pluck('description')->toArray() as $despt)
                                      <?php 
                                        if (strpos($despt, 'Line') !== false) {
                                          if (strpos($despt, 'Continue') !== false) {
                                            $cont = explode('Continue', $despt); 
                                            echo "<option value='$despt'>$cont[0]</option>";

                                          }elseif (strpos($despt, 'Bracket') !== false) {
                                            $brck = explode('Bracket', $despt); 
                                            echo "<option value='$despt'>$brck[0]</option>";
                                          }
                                        }
                                      ?>
                                      
                                      @endforeach
                                      @endforeach
                                    <!-- <option value="Smart Line Continue Profile">Smart Line</option>
                                    <option value="Sea Line Bracket Profile">Sea Line</option>
                                    <option value="Square Line Bracket Profile">Square Line</option>
                                    <option value="Slim Line Continue Profile">Slim Line</option>
                                    <option value="Small Line Continue Profile">Small Line</option>
                                    <option value="Star Line Bracket Profile">Star Line</option>
                                    <option value="Sky Line Bracket Profile">Sky Line</option>
                                    <option value="Spark Line Bracket Profile">Spark Line</option>
                                    <option value="Sleek Line Continue Profile">Sleek Line</option>
                                    <option value="Super Line Continue Profile">Super Line</option>
                                    <option value="Signature Line Continue Profile">Signature Line</option> -->
                                </select>

                            </div>
                        </div>

                        <div class="form-group row brckshow"></div>

                        <div class="form-group row">
                            <label for="prodtype" class="col-md-4 col-form-label text-md-right">{{ __('Product Type:') }}</label>

                            <div class="col-md-6">
                            <select required type="text" class="form-control" name="prodtype" id="prodtype" onchange="productscover(this.id,'prodcover')">
                            </select>
                        </div>
                      </div>

                        <div class="form-group row">

                            <label for="prodcover" class="col-md-4 col-form-label text-md-right">{{ __('Product Cover:') }}</label>

                            <div class="col-md-6">
                                <select name="prodcover" id="prodcover" type="text" class="form-control" >

                                </select>

                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="hand" class="col-md-4 col-form-label text-md-right">{{ __('Hand Rail:') }}</label>

                            <div class="col-md-6">
                                <select required="" name="hand" id="hand" type="text" class="form-control " >
                                  <option value="">Select hand rail</option>
                                  @foreach($products as $product)
                                    @foreach($product->product_despt()->get()->pluck('description')->toArray() as $despt)
                                    <?php      
                                      if (strpos($despt, 'Hand Rail') !== false) {
                                          echo "<option value='$despt'>$despt</option>";
                                        
                                      }
                                              
                                    ?>
                                  
                                    @endforeach
                                    @endforeach
                                  <!-- <option value="Round Hand Rail">Round</option>
                                  <option value="Square Hand Rail">Square</option>
                                  <option value="Small Hand Rail">Small</option>
                                  <option value="Slim Hand Rail">Slim</option>
                                  <option value="Edge Guard Hand Rail">Edge Guard</option>
                                  <option value="Half Round Hand Rail">Half Round</option>
                                  <option value="Rectangle Hand Rail">Rectangle</option>
                                  <option value="Incline Hand Rail">Incline</option> -->

                                </select>

                            </div>
                        </div>

                        <input type="hidden" name="" value="" id="railingNos">


                        <div class="form-group row">

                        <label for="hand" class="col-md-4 col-form-label text-md-right">{{ __('Color:') }}</label>
                        <div class="col-md-6">

                        <select type="text" class="form-control" required name="productColorN" id="productColorN" onchange="colorType(this.id,'colorN')">
                          <option value="">Select colour</option>
                          <option value="Anodised">Anodised</option>
                          <option value="PVDF">PVDF</option>
                          <option value="Wooden">Wooden</option>
                          <option value="Mill Finish">Mill Finish</option>
                          <option value="Powder Coating">Powder Coating</option>
                        </select>
                     
                        </div>
                        </div>

                        <div class="form-group row" id="selectColorN">

                          <label for="colorN" class="col-md-4 col-form-label text-md-right">{{ __(' Color Type') }}</label>

                                <div class="col-md-6">
                                    <select type="text" class="form-control" name="colorN" id="colorN">
                                    </select>
                                </div>
                        </div>

                        <div class="form-group row" id="ShowColorInputN" >
                            <!-- if powerder coating is selected then show an input box to enter -->
                        <!-- <label for="" class="col-md-4 col-form-label text-md-right">Select color</label>
                         <div class="col-md-6 in">
                          <input id="colorInputs" required placeholder="Enter color code" name="colorInput_R1[]" value="" type="text" class="form-control">
                          </div> -->

                        </div>


                        
                        <div class="modal-footer">
                            <button type="button" id="resetID" class="btn btn-danger reset" data-dismiss="modal">Cancel</button>
                            

                            <button type="submit" class="btn btn-info">Add</button>
                          </div>
                      </div>
                      </fieldset>
                  </form>
                </div>
       </div>                  
</div>



