@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Document')])
@section('content')
    <style>
        .dropzoneDragArea {
            background-color: #fbfdff;
            border: 1px dashed #c0ccda;
            border-radius: 6px;
            padding: 60px;
            text-align: center;
            margin-bottom: 15px;
            cursor: pointer;
        }

        .dropzone {
            box-shadow: 0px 2px 20px 0px #f2f2f2;
            border-radius: 10px;
            max-width: 100%;
        }

    </style>



    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @if ($last_input = Session::get('last_input'))
                @endif

                @if ($message = Session::get('success'))
                    <div data-notify="container" class="col-11 col-md-4 alert alert-info alert-with-icon animated fadeInDown"
                        role="alert" data-notify-position="top-center"
                        style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; left: 0px; right: 0px;">
                        <button type="button" aria-hidden="true" class="close" data-notify="dismiss"
                            style="position: absolute; right: 10px; top: 50%; margin-top: -9px; z-index: 1033;"><i
                                class="material-icons">close</i></button><i data-notify="icon"
                            class="material-icons">add_alert</i><span data-notify="title"></span>
                        <span data-notify="message">
                            {{ $message }}
                        </span>
                        <a href="#" target="_blank" data-notify="url"></a>
                    </div>
                @endif


                <div class="col-md-12">
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
            </div>

        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $("#attachmentModal").modal({
                backdrop: 'static',
                keyboard: false
            });

            $("#saveAttachment").click(function() {
                window.location.href = "{{ route('documents.index') }}";
            });

        });
    </script>

    <script>
        Dropzone.autoDiscover = false;
        // Dropzone.options.demoform = false;
        let token = $('meta[name="csrf-token"]').attr('content');
        $(function() {
            var myDropzone = new Dropzone("div#dropzoneDragArea", {
                paramName: "file",
                url: "{{ route('document.store_file') }}",
                previewsContainer: 'div.dropzone-previews',
                addRemoveLinks: true,
                autoProcessQueue: false,

                // uploadMultiple: false,
                // parallelUploads: 1,
                // maxFiles: 1,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 100,

                params: {
                    _token: token
                },
                // The setting up of the dropzone
                init: function() {
                    var myDropzone = this;
                    //form submission code goes here
                    $("form[name='demoform']").submit(function(event) {
                        //Make sure that the form isn't actully being sent.
                        event.preventDefault();
                        URL = $("#demoform").attr('action');
                        formData = $('#demoform').serialize();
                        $.ajax({
                            type: 'POST',
                            url: URL,
                            data: formData,
                            success: function(result) {
                                if (result.status == "success") {
                                    // fetch the useid
                                    var student_id = result.student_id;
                                    $("#student_id").val(
                                        student_id
                                    ); // inseting student_id into hidden input field
                                    //process the queue
                                    myDropzone.processQueue();
                                } else {
                                    console.log("error");
                                }
                            }
                        });
                    });
                    //Gets triggered when we submit the image.
                    this.on('sending', function(file, xhr, formData) {
                        //fetch the student id from hidden input field and send that studentid with our image
                        let student_id = document.getElementById('student_id').value;
                        formData.append('student_id', student_id);
                    });
                    this.on("success", function(file, response) {
                        alert("Student added successfully!!");
                        location.reload();
                    });
                    this.on("queuecomplete", function() {});
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
    <script src="{{ asset('auto.js') }}"></script>
@endpush
