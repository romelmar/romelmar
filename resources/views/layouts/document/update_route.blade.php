{{-- add new Document modal start --}}

<div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content card shadow">
            <div class="modal-header card-header card-header-primary d-flex justify-content-between align-items-center">
                <h5 class="modal-title">{{ __('ADD Document') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form method="post" name="docform" id="docform" action="{{ route('storeAjax') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="document_id" name="document_id" id="document_id" value="">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col">
                                    <input type="text" id="date_received" name="date_received"
                                        class="form-control datepicker form-control-sm" placeholder="Date received"
                                        required="true" aria-required="true">
                                </div>
                                <div class="col">
                                    <input type="text" id="deadline" name="deadline"
                                        class="form-control datepicker form-control-sm" placeholder="Deadline"
                                        required="true" aria-required="true">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input
                                        class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }} form-control-sm"
                                        name="subject" id="input-subject" type="text"
                                        placeholder="{{ __('Subject') }}" required="true" aria-required="true" />
                                    @if ($errors->has('subject'))
                                        <span id="name-error" class="error text-danger"
                                            for="input-name">{{ $errors->first('subject') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input
                                        class="form-control{{ $errors->has('control_number') ? ' is-invalid' : '' }} form-control-sm"
                                        name="control_number" id="input-control_number" type="text"
                                        placeholder="{{ __('Control number') }}" required="true"
                                        aria-required="true" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input placeholder="Origin Office" data-db="OriginOffice" type="text" id="origin_id"
                                        name="origin" class="form-control autocomp" required="true"
                                        aria-required="true">
                                    <input type="hidden" name="origin_id">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input placeholder="Focal" data-db="employee" type="text" id="employee_id"
                                        name="focal" class="form-control autocomp" required="true" aria-required="true">
                                    <input type="hidden" name="employee_id">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input placeholder="Document Type" data-db="doctype" type="text" id="doctype_id"
                                        name="doctype" class="form-control autocomp" placeholder="" required="true"
                                        aria-required="true">
                                    <input type="hidden" name="doctype_id">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input placeholder="Means of Receiving" data-db="mor" type="text" id="mor_id"
                                        name="mor" class="form-control autocomp" required="true" aria-required="true">
                                    <input type="hidden" name="mor_id">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="dropzoneDragArea"
                                class="dz-default dz-message dropzoneDragArea dropzone-previews dropzone">
                            </div>
                            <button type="submit" class="btn btn-md btn-primary float-left">create</button>
                            <button type="button" class="btn btn-secondary float-right"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
{{-- add new Ducoment modal end --}}

@push('js')
    <script>
        Dropzone.autoDiscover = false;
        // Dropzone.options.docform = false;
        let token = $('meta[name="csrf-token"]').attr('content');
        $(function() {
            var myDropzone = new Dropzone("div#dropzoneDragArea", {
                paramName: "file",
                url: "{{ route('document.store_file') }}",
                previewsContainer: 'div.dropzone-previews',
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: false,
                parallelUploads: 1,
                maxFiles: 1,
                params: {
                    _token: token
                },
                // The setting up of the dropzone
                init: function() {
                    var myDropzone = this;
                    //form submission code goes here
                    $("form[name='docform']").submit(function(event) {
                        //Make sure that the form isn't actully being sent.
                        event.preventDefault();
                        URL = $("#docform").attr('action');
                        formData = $('#docform').serialize();
                        $("button[type='submit']").text('Adding...');

                        $.ajax({
                            type: 'POST',
                            url: URL,
                            data: formData,
                            success: function(result) {
                                

                                if (result.status == "success") {
                                    // fetch the useid
                                    var document_id = result.document_id;
                                    $("#document_id").val(
                                        document_id
                                    ); // inseting document_id into hidden input field
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
                        let document_id = document.getElementById('document_id').value;
                        formData.append('document_id', document_id);
                    });
                    this.on("success", function(file, response) {
                        console.log(file);
                        console.log(response);
                        Swal.fire(
                            'Added!',
                            'Document Added Successfully!',
                            'success'
                        )
                        fetchAllDocuments();

                    });
                    this.on("queuecomplete", function() {
                        this.removeAllFiles(true);
                        $("button[type='submit']").text('Add Document');
                        $("form[name='docform']")[0].reset();
                        $("#addDocumentModal").modal('hide');
                    });
                }
            });
        });
    </script>
@endpush
