<div class="modal fade" id="Cust-TypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content" style="width: 10000px;">
                          <div class="modal-header" style="background-color: #008a9f">
                            <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="color: red;">Cancel</span>
                            </button>
                          </div>


                <form id="cust_Type" action="{{ route('glasstype.update', $quotOrdID) }}" enctype="multipart/form-data" method="POST">
                  <!-- enctype="multipart/form-data"> -->
                        @csrf
                        {{ method_field('PUT') }}

                <!-- <fieldset><center><legend>Converter </legend></center><hr> -->
                
                <div class="card-body">

                  <div class="form-group row">
                            <label for="cust_contfrom" class="col-md-4 col-form-label text-md-right">{{ __('From:') }}</label>

                            <div class="col-md-6">
                              <select required id="cust_contfrom" oninput="" class="form-control" name="cust_contfrom" >
                              <option value="">Select unit</option>
                                <option value="MM">Millimeter</option>
                                <option value="CM">Centimeter</option>
                                <option value="FT">Feet</option>
                                <option value="M">Meter</option>
                              </select> 
                              </div>
                              </div> 

                          <div class="form-group row">
                            <label for="cust_contto" class="col-md-4 col-form-label text-md-right">{{ __('To RFT:') }}</label>

                            <div class="col-md-6">
                              <select id="cust_contto" oninput="" class="form-control" type="text" style=" width: %; color: ;" name="cust_contto" required >
                            <option value="">Select unit</option>
                            <option value="MM">Millimeter</option>
                                <option value="CM">Centimeter</option>
                                <option value="FT">Feet</option>
                                <option value="M">Meter</option>
                            </select>
                        </div>
                      </div>
                      <hr color="gray">

                  <div class="form-group row">
                            <label for="cust_brck" class="col-md-4 col-form-label text-md-right">{{ __('Bracket') }}</label>

                            <div class="col-md-6">
                                <select id="cust_brck" type="text" class="form-control " name="cust_brck" required>
                                    <option value="">Select bracket</option>
                                    <option value="50">50</option>
                                    <option value="75">75</option>
                                    <option value="100">100</option>
                                    <option value="150">150</option>
                                    <option value="Full Profile">Full Profile</option>
                                </select>

                                <input type="hidden" name="cust_railingNo" value="" id="cust_railingNo">
                                <input type="hidden" name="quotID"  id="quotID" value="{{ $quotOrdID }}">

                            </div>
                        </div>

                        <center><span id="cust_brckother" style="color: red"></span></center>


                        <div class="form-group row"  id="cust_showother" >
                            <!-- if other is selected then show an input box to enter -->
                        </div>

                        <div class="form-group row">
                          <label for="cust_brck" class="col-md-4 col-form-label text-md-right">{{ __('Picture') }}</label>
                           <div class="col-md-6">
                            <div class="">
                              <input type="file" required name="image" class="" id="selectedfile">
                              <!-- <label class="custom-file-label" for="inputGroupFile02">Choose an image to upload</label> -->
                            </div>
                            <!-- <div class="input-group-append">
                              <span class="input-group-text" id="">Upload</span>
                            </div> -->
                          </div>
                        </div>
                        <center><span style="color: green;" id="save"></span></center>
                        <div class="form-group row">
                            <label for="cor" class="col-md-4 col-form-label text-md-right">{{ __('No. of conners:') }}</label>

                            <div class="col-md-6">
                                <input id="cor" type="text" class="form-control" name="cor" value="" required placeholder="number of conners">

                            </div>
                        </div>

                    
                        <!-- <div class="form-group row brckshow"></div> -->
                        <!-- <span id="maxreach"></span> -->
                        <table class="table table-bordered table-hover" id="add_item" style="padding-right:  0px; padding-left: 0px;">
                          <thead style="background-color: #8FBC8F; margin: 0px;">
                            <tr>
                              <th scope="col">Side</th>
                              <th scope="col">Value</th>
                              <th scope="col">Result</th>
                              <th scope="col">GlassLength</th>
                              <th scope="col">No.Glass</th>
                              <th scope="col"><button type="button" name="add_length" class="btn btn-info btn-sm add_length"><span class="glyphicon glyphicon-plus">Add</span></button></th>

                            </tr>
                        </thead>
                      <tbody>
                    </tbody>
                    </table>

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



