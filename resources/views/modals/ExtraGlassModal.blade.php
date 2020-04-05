
<!-- Adding a new user -->

<div class="modal fade" id="ExtraGlassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #5F9EA0">
                            <h4 class="modal-title" id="exampleModalCenterTitle">Extra Glass Type</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="color: red;">Cancel</span>
                            </button>
                          </div>


                <form id="egt">
                  @csrf
                        {{ method_field('POST')}}

                <script>
                          
                </script>


                <fieldset><center><legend></legend></center><hr>
                
                <div class="card-body">
                  <center><span style="color: blue; display: none;" class="sucs">Data saved</span></center>
                  <input type="hidden" id="quotOrdIDM" name="quotOrdIDM" value="">

                          <div class="form-group row">
                            <label for="glasstypem" class="col-md-4 col-form-label text-md-right">{{ __('Glass Type:') }}</label>

                            <div class="col-md-6">
                              <select required id="glasstypem" onchange="populate(this.id,'glassize1m'); populate2('glassize1m', 'glassize2m')" class="form-control" name="glasstypem" >
                              <option value="">Select glass type</option>
                              <option value='Toughened'>Toughened</option>
                              <option value="Laminated">Laminated</option>
                              <option value="Your Scope">Your Scope</option>
                              </select> 
                              </div>
                              </div> 
                        <center><span id="select_error" style="color: red"></span></center>

                          <div class="form-group row hideme">
                            <label for="glassize1m" class="col-md-4 col-form-label text-md-right">{{ __('Glass size 1:') }}</label>

                            <div class="col-md-6 " >
                              <select type="text" class="form-control" name="glassize1m" id="glassize1m" onchange="populate2(this.id,'glassize2m')"> 
                              <option disabled="" value="">Select glass size</option> 
                            </select>
                        </div>
                      </div>

                    <div class="form-group row hideme">
                            <label for="glassize2m" class="col-md-4 col-form-label text-md-right">{{ __('Glass size 2:') }}</label>

                            <div class="col-md-6">
                                <select type="text" class="form-control"  name="glassize2m" id="glassize2m">
                                </select>

                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                               
                            </div>
                        </div>

                        <center><small style="color: green;">Please note, all extra glass type would be deleted once the quotation is done or on page reload</small></center>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" id="btn_egt" data-uri="{{ route('glasstype.store') }}" class="btn btn-primary">Add</button>
                          </div>
                      </div>
                      </fieldset>
                  </form>
                </div>
       </div>                  
</div>



