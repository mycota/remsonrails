<div class="modal fade" id="L-TypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #008a9f">
                            <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="color: red;">Cancel</span>
                            </button>
                          </div>


                <form method="POST" id="l_Type">
                        @csrf

                <script>
                          
                </script>


                <!-- <fieldset><center><legend>Converter </legend></center><hr> -->
                
                <div class="card-body">

                  <div class="form-group row">
                            <label for="l_contfrom" class="col-md-4 col-form-label text-md-right">{{ __('From:') }}</label>

                            <div class="col-md-6">
                              <select required id="l_contfrom" oninput="verticalSide(); horizontalSide()" class="form-control" name="l_contfrom" >
                              <option value="">Select unit</option>
                                <option value="MM">Millimeter</option>
                                <option value="CM">Centimeter</option>
                                <option value="FT">Feet</option>
                                <option value="M">Meter</option>
                              </select> 
                              </div>
                              </div> 

                          <div class="form-group row">
                            <label for="l_contto" class="col-md-4 col-form-label text-md-right">{{ __('To RFT:') }}</label>

                            <div class="col-md-6">
                              <select id="l_contto" oninput="verticalSide(); horizontalSide()" class="form-control" type="text" style=" width: %; color: ;" name="l_contto" required >
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
                            <label for="l_brck" class="col-md-4 col-form-label text-md-right">{{ __('Bracket') }}</label>

                            <div class="col-md-6">
                                <select id="l_brck" type="text" class="form-control " name="l_brck" required>
                                    <option value="">Select bracket</option>
                                    <option value="50">50</option>
                                    <option value="75">75</option>
                                    <option value="100">100</option>
                                    <option value="150">150</option>
                                    <option value="Full Profile">Full Profile</option>
                                </select>

                                <input type="hidden" name="l_railingNo" value="" id="l_railingNo">

                            </div>
                        </div>

                        <center><span id="l_brckother" style="color: red"></span></center>


                        <div class="form-group row"  id="l_showother" >
                            <!-- if other is selected then show an input box to enter -->
                        </div>

                        <!-- <div class="form-group row brckshow"></div> -->
                        <table class="table table-bordered table-hover">
                          <thead style="background-color: #5F9EA0">
                            <tr>
                              <th scope="col">Side</th>
                              <th scope="col">Value</th>
                              <th scope="col">Result</th>
                              <th scope="col">GlassLength</th>
                              <th scope="col">No. Glass</th>

                            </tr>
                        </thead>
                        <tbody>
                              <tr>
                                  <th>Vertical</th>
                                  <td>
                                    <input id="l_v_apprft" oninput="verticalSide();" type="number" class="form-control" name="l_v_apprft" value="" required placeholder="Enter vertical value">
                                  </td>
                                  <td>
                                    <input id="l_v_result" type="text" class="form-control" name="l_v_result" value="" readonly="">
                                    <input id="l_v_results" type="hidden" class="form-control" name="l_v_results" value="" readonly="">
                                  </td>
                                  <td>
                                    <input id="l_v_nOG" oninput="dividLTypeVertical();" type="number" class="form-control" name="l_v_nOG" value="" required placeholder="Enter number of glass">
                                  </td>
                                  <td>
                                    <input id="l_v_length" type="text" class="form-control" name="l_v_length" value="" readonly="">
                                <input id="l_v_lengths" type="hidden" class="form-control" name="l_v_lengths" value="" readonly="">
                                  </td>
                              </tr>

                              <tr>
                                  <th>Horizontal</th>
                                  <td>
                                    <input id="l_h_apprft" oninput="horizontalSide();" type="number" class="form-control" name="l_h_apprft" value="" required placeholder="Enter horizontal value">
                                  </td>
                                  <td>
                                    <input id="l_h_result" type="text" class="form-control" name="l_h_result" value="" readonly="">
                                    <input id="l_h_results" type="hidden" class="form-control" name="l_h_results" value="" readonly="">
                                  </td>
                                  <td>
                                    <input id="l_h_nOG" oninput="dividLTypeHorizontal();" type="number" class="form-control" name="l_h_nOG" value="" required placeholder="Enter number of glass">
                                  </td>
                                  <td>
                                    <input id="l_h_length" type="text" class="form-control" name="l_h_length" value="" readonly="">
                                <input id="l_h_lengths" type="hidden" class="form-control" name="l_h_lengths" value="" readonly="">
                                  </td>
                              </tr>

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



