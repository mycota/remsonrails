<div class="modal fade" id="C-TypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #008a9f">
                            <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="color: red;">Cancel</span>
                            </button>
                          </div>


                <form method="POST" id="c_Type">
                        @csrf
                <!-- <fieldset><center><legend>Converter </legend></center><hr> -->
                
                <div class="card-body">

                  <div class="form-group row">
                            <label for="c_contfrom" class="col-md-4 col-form-label text-md-right">{{ __('From:') }}</label>

                          <div class="col-md-6">
                              <select required id="c_contfrom" oninput="leftSide(); centerSide(); rightSide()" class="form-control" name="c_contfrom" >
                              <option value="">Select unit</option>
                                <option value="MM">Millimeter</option>
                                <option value="CM">Centimeter</option>
                                <option value="FT">Feet</option>
                                <option value="M">Meter</option>
                              </select> 
                              </div>
                              </div> 

                          <div class="form-group row">
                            <label for="c_contto" class="col-md-4 col-form-label text-md-right">{{ __('To RFT:') }}</label>

                            <div class="col-md-6">
                              <select id="c_contto" oninput="leftSide(); centerSide(); rightSide()" class="form-control" type="text" style=" width: %; color: ;" name="c_contto" required >
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
                            <label for="c_brck" class="col-md-4 col-form-label text-md-right">{{ __('Bracket') }}</label>

                            <div class="col-md-6">
                                <select id="c_brck" type="text" class="form-control " name="c_brck" required>
                                    <option value="">Select bracket</option>
                                    <option value="50">50</option>
                                    <option value="75">75</option>
                                    <option value="100">100</option>
                                    <option value="150">150</option>
                                    <option value="Full Profile">Full Profile</option>
                                </select>

                                <input type="hidden" name="" value="" id="c_railingNo">

                            </div>
                        </div>

                        <center><span id="c_brckother" style="color: red"></span></center>

                        <div class="form-group row"  id="c_showother" >
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
                                  <th>Left</th>
                                  <td>
                                    <input id="c_l_apprft" oninput="leftSide();" type="number" class="form-control" name="c_l_apprft" value="" required placeholder="Enter left value">
                                  </td>
                                  <td>
                                    <input id="c_l_result" type="text" class="form-control" name="c_l_result" value="" readonly="">
                                    <input id="c_l_results" type="hidden" class="form-control" name="c_l_results" value="" readonly="">
                                  </td>
                                  <td>
                                    <input id="c_l_nOG" oninput="dividCTypeLeft();" type="number" class="form-control" name="c_l_nOG" value="" required placeholder="Enter number of glass">
                                  </td>
                                  <td>
                                    <input id="c_l_length" type="text" class="form-control" name="c_l_length" value="" readonly="">
                                <input id="c_l_lengths" type="hidden" class="form-control" name="c_l_lengths" value="" readonly="">
                                  </td>
                              </tr>

                              <tr>
                                  <th>Center</th>
                                  <td>
                                    <input id="c_c_apprft" oninput="centerSide();" type="number" class="form-control" name="c_c_apprft" value="" required placeholder="Enter left value">
                                  </td>
                                  <td>
                                    <input id="c_c_result" type="text" class="form-control" name="c_c_result" value="" readonly="">
                                    <input id="c_c_results" type="hidden" class="form-control" name="c_c_results" value="" readonly="">
                                  </td>
                                  <td>
                                    <input id="c_c_nOG" oninput="dividCTypeCenter();" type="number" class="form-control" name="c_c_nOG" value="" required placeholder="Enter number of glass">
                                  </td>
                                  <td>
                                    <input id="c_c_length" type="text" class="form-control" name="c_c_length" value="" readonly="">
                                <input id="c_c_lengths" type="hidden" class="form-control" name="c_c_lengths" value="" readonly="">
                                  </td>
                              </tr>

                              <tr>
                                  <th>Right</th>
                                  <td>
                                    <input id="c_r_apprft" oninput="rightSide();" type="number" class="form-control" name="c_r_apprft" value="" required placeholder="Enter left value">
                                  </td>
                                  <td>
                                    <input id="c_r_result" type="text" class="form-control" name="c_r_result" value="" readonly="">
                                    <input id="c_r_results" type="hidden" class="form-control" name="c_r_results" value="" readonly="">
                                  </td>
                                  <td>
                                    <input id="c_r_nOG" oninput="dividCTypeRight();" type="number" class="form-control" name="c_r_nOG" value="" required placeholder="Enter number of glass">
                                  </td>
                                  <td>
                                    <input id="c_r_length" type="text" class="form-control" name="c_r_length" value="" readonly="">
                                <input id="c_r_lengths" type="hidden" class="form-control" name="c_r_lengths" value="" readonly="">
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



