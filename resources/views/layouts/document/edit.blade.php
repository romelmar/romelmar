{{-- update Document modal start --}}

<div class="modal fade" id="editDocumentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content card shadow">
            <div class="modal-header card-header card-header-primary d-flex justify-content-between align-items-center">
                <h5 class="modal-title">Update Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- <form id="edit_document_form"> --}}
                <form action="#" method="post" id="edit_document_form" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label for="date_received"> {{ __('Date Receieved') }}</label>
                                    <input type="text" id="date_received" name="date_received"  class="form-control datepicker">
                                  </div>
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                    <label for="deadline"> {{ __('Deadline') }}</label>
                                    <input type="text" id="deadline" name="deadline"class="form-control datepicker" placeholder="Deadline" required="true" aria-required="true">
                                  </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                      <label for="subject"> {{ __('Subject') }}</label>
                                      <input class="form-control" name="subject" id="subject" type="text"
                                      placeholder="{{ __('Subject') }}" required="true" aria-required="true" />
                                  <input type="hidden" name="id">
                                  @if ($errors->has('subject'))
                                      <span id="name-error" class="error text-danger"
                                          for="input-name">{{ $errors->first('subject') }}</span>
                                  @endif                                      
                                  </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label for="control_number"> {{ __('Control #') }}</label>
                                    <input
                                    class="form-control{{ $errors->has('control_number') ? ' is-invalid' : '' }}"
                                    name="control_number" id="control_number" type="text"
                                    placeholder="{{ __('Control number') }}" required="true"
                                    aria-required="true" />                                   
                                </div>

                                  </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label for="origin_id"> {{ __('Origin Office') }}</label>
                                    <input placeholder="Origin Office" data-db="OriginOffice" type="text" id="origin_id"
                                        name="origin" class="form-control autocomp" required="true"
                                        aria-required="true">
                                    <input type="hidden" name="origin_id">
                                  </div>                                  

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label for="focal"> {{ __('Focal') }}</label>
                                    <input placeholder="Focal" data-db="employee" type="text" id="employee_id"
                                        name="focal" class="form-control autocomp" required="true" aria-required="true">
                                    <input type="hidden" name="employee_id">
                                  </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label for="doctype"> {{ __('DocType') }}</label>
                                    <input placeholder="Document Type" data-db="doctype" type="text" id="doctype_id"
                                        name="doctype" class="form-control autocomp" placeholder="" required="true"
                                        aria-required="true">
                                    <input type="hidden" name="doctype_id">
                                  </div>                                  

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label for="mor"> {{ __('Means of Receiving') }}</label>
                                    <input placeholder="Means of Receiving" data-db="mor" type="text" id="mor_id"
                                        name="mor" class="form-control autocomp" required="true" aria-required="true">
                                    <input type="hidden" name="mor_id">                                    
                                  </div>                                  

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <button type="submit" id="updateDocument" class="btn btn-success float-left">Update</button>
                            <button type="button" class="btn btn-secondary float-right"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                {{-- <button class="btn btn-success btn-submit" id="updateDocument">Submit</button> --}}


            </div>
        </div>
    </div>
</div>
{{-- add new Ducoment modal end --}}
