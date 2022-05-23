<div class="modal fade" id="addRouteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog small" role="document">
        <div class="modal-content card shadow">
            <div class="modal-header card-header card-header-primary d-flex justify-content-between align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Add Route') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('documents.store') }}" autocomplete="off" class="form-horizontal"
                    name="docform" id="docform">
                    @csrf
                    @method('post')


                    <div class="card form-wrap">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Add Document') }}
                            </h4>
                        </div>
                        <div class="card-body ">

                            <div class="row justify-content-between">

                                <div class="col-xl-4">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>{{ __('Date Received') }}</label>
                                            <div class="form-group">
                                                <input type="text" id="date_received" name="date_received"
                                                    class="form-control datepicker" placeholder=" " required="true"
                                                    aria-required="true"
                                                    value="{{ Session::get('last_input') ? $last_input['date_received'] : '' }}">
                                                {{-- <input type="hidden" name="date_received"  > --}}
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>{{ __('Deadline / Schedule') }}</label>
                                            <div class="form-group">
                                                <input type="text" id="deadline" name="deadline"
                                                    class="form-control datepicker" placeholder=" " required="true"
                                                    aria-required="true"
                                                    value="{{ Session::get('last_input') ? $last_input['deadline'] : '' }}">
                                                {{-- <input type="hidden" name="deadline"  > --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>{{ __('Focal') }}</label>
                                            <div class="form-group">

                                                <input data-db="employee" type="text" id="employee_id" name="focal"
                                                    class="form-control autocomp" required="true" aria-required="true"
                                                    value="{{ Session::get('last_input') ? $last_input['focal'] : '' }}">
                                                <input type="hidden" name="employee_id">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>{{ __('Origin Office') }}</label>
                                            <div class="form-group">
                                                <input data-db="OriginOffice" type="text" id="origin_id" name="origin"
                                                    class="form-control autocomp" required="true" aria-required="true"
                                                    value="{{ Session::get('last_input') ? $last_input['origin'] : '' }}">
                                                <input type="hidden" name="origin_id">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>{{ __('Means of Receiving') }}</label>
                                            <div class="form-group">
                                                <input data-db="mor" type="text" id="mor_id" name="mor"
                                                    class="form-control autocomp" required="true" aria-required="true"
                                                    value="{{ Session::get('last_input') ? $last_input['mor'] : '' }}">
                                                <input type="hidden" name="mor_id">
                                            </div>

                                        </div>
                                        <div class="col-sm-6">
                                            <label>{{ __('Document Type') }}</label>
                                            <div class="form-group">
                                                <input data-db="doctype" type="text" id="doctype_id" name="doctype"
                                                    class="form-control autocomp" placeholder="" required="true"
                                                    aria-required="true"
                                                    value="{{ Session::get('last_input') ? $last_input['doctype'] : '' }}">
                                                <input type="hidden" name="doctype_id">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label>{{ __('Control #') }}</label>
                                            <div
                                                class="form-group{{ $errors->has('control_number') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('control_number') ? ' is-invalid' : '' }}"
                                                    name="control_number" id="input-control_number" type="text"
                                                    placeholder="{{ __('Control number') }}" required="true"
                                                    aria-required="true"
                                                    value="{{ Session::get('last_input') ? $last_input['control_number'] : '' }}" />
                                                @if ($errors->has('control_number'))
                                                    <span id="name-error" class="error text-danger"
                                                        for="input-name">{{ $errors->first('control_number') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <label>{{ __('Subject') }}</label>
                                            <div
                                                class="form-group{{ $errors->has('subject') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}"
                                                    name="subject" id="input-subject" type="text"
                                                    placeholder="{{ __('Subject') }}" required="true"
                                                    aria-required="true"
                                                    value="{{ Session::get('last_input') ? $last_input['subject'] : '' }}" />
                                                @if ($errors->has('subject'))
                                                    <span id="name-error" class="error text-danger"
                                                        for="input-name">{{ $errors->first('subject') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 mt-4">
                                            <div class="form-group">
                                                <label for="required_action"> {{ __('Action Required') }}</label>
                                                <textarea class="form-control" id="required_action" name="required_action" rows="9"
                                                    placeholder=" ">{{ Session::get('last_input') ? $last_input['required_action'] : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div id="dropzoneDragArea"
                                            class="dz-default dz-message dropzoneDragArea dropzone-previews dropzone">
                                            <span>Upload file</span>
                                        </div>
                                        <div class=""></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-md btn-primary">create</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
