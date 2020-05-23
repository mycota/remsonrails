
<!-- Adding a new user -->

<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #00BFFF">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Generate Report</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="color: red;">Cancel</span>
                            </button>
                          </div>

                <form method="POST" action="{{ route('reports.store') }}" id="report">
                        @csrf
                <fieldset><center><legend>Generate Report </legend></center>

                <div class="card-body" >
                    <span id="rerrors" style="color: red; text-align: center; padding: 0px;"></span>
{{--                    <input type="text" value="">--}}
                    <div class="form-group row">
                        <label for="" class="col-md-4 col-form-label text-md-right">{{ __('From') }}</label>
                        <div class="col-md-6">
                            <input id="from" type="date" class="form-control" name="from_date" value="" required >
                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-md-4 col-form-label text-md-right">To</label>

                        <div class="col-md-6">
                            <input id="to" type="date" class="form-control" name="to_date" value="" required >

                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select id="caty" type="text" class="form-control" name="caty" value="" required>
                                   <option value="All">All</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Prepared">Prepared</option>
                                    <option value="Confirmed">Confirmed</option>
                                    <option value="Transported">Transported</option>
                                </select>

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{</strong>
                                    </span>
                            </div>
                        </div>

                    <div class="form-group row">
                        <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Users') }}</label>

                        <div class="col-md-6">
                            <select id="users" type="text" class="form-control" name="users" value="" required>
                            </select>

                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>

                        </div>
                    </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Generate</button>
                          </div>
                      </div>
                      </fieldset>
                  </form>
              </div>
       </div>
</div>



