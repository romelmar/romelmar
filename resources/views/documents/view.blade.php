@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Document')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card form-wrap">
                        <div class="card-body ">
                            <main>
                                <div class="row g-5">
                                    <div class="col-md-5 col-lg-4 order-md-last">
                                        <ul class="list-group mb-3">
                                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                                <div>
                                                    <h6 class="my-0">
                                                        {{ __('Control #: ') . $document->control_number }}</h6>
                                                    <small class="text-muted">{{ __('As of ') . now() }}</small>
                                                    {{-- <p><span class="text-muted">{{ $document->get_status() }}</span></p> --}}
                                                </div>


                                            </li>
                                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                                <div>
                                                    <h6 class="my-0">{{ __('Date Received') }}</h6>
                                                    <small class="text-muted">{{ $document->action_taken }}</small>
                                                </div>
                                                <span class="text-muted">{{ $document->date_received }}</span>
                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between lh-sm bg-{{ $document->expired() }} deadline">
                                                <div>
                                                    <h6 class="my-0">{{ __('Deadline / Schedule') }}</h6>
                                                    <small class="text-muted">{{ $document->required_action }}</small>
                                                </div>
                                                <span class="text-muted">{{ $document->deadline }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                                <div>
                                                    <h6 class="my-0 text-primary ">{{ $document->employee->fullname() }}
                                                    </h6>
                                                    <small
                                                        class="text-success">{{ $document->origin_office->name }}</small>
                                                </div>
                                                <span class="text-muted">Focal</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                                <div>
                                                    <h6 class="my-0">{{ __('Means of Receiving') }}</h6>
                                                    <small class="my-0">{{ $document->doctype->name }}</small>
                                                </div>
                                                <span
                                                    class="text-muted">{{ $document->meansOfReceiving->name }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                                <ul class="list-group">
                                                    @foreach ($images as $image)
                                                        <li class="list-group-item">
                                                            <a href="#" class="" data-toggle="modal"
                                                                data-target="#viewPDFModal">
                                                                <i
                                                                    class="material-icons text-danger">attachment</i>{{ $image->image_path }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-7 col-lg-8">
                                        <div class="card shadow">
                                            <div
                                                class="card-header card-header-primary d-flex justify-content-between align-items-center">
                                                <h3 class="text-light">
                                                    {{ __('Routes - ' . $document->subject . ' (' . $document->origin_office->name . ')') }}
                                                </h3>
                                                <button type="button" class="btn btn-light" data-toggle="modal"
                                                    data-target="#addRouteModal">
                                                    <i class="bi-plus-circle me-2"></i> Add</button>
                                            </div>

                                            <div class="card-body " id="show_all_documents">
                                                @include('layouts.components.loader')

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </main>
                        </div>
                        <div id="example1"></div>

                    </div>

                </div>
            </div>
        </div>

    </div>
    </div>

    @include('modal.view_pdf')
    @include('modal.add_route')
    @include('modal.edit_route')
@endsection
@push('js')
    <script src="https://unpkg.com/pdfobject@2.2.7/pdfobject.min.js"></script>
    <script>
        PDFObject.embed("{{ route('show-pdf', ['id' => $image->id]) }}", "#pdf-viewer");
    </script>


    <script type="text/javascript">
        $(function() {
            $('.datepicker').datepicker();
        });
    </script>
    <script src="{{ asset('auto.js') }}"></script>

    <script>
        var tabEl = document.querySelector('button[data-bs-toggle="tab"]')
        tabEl.addEventListener('shown.bs.tab', function(event) {
            event.target // newly activated tab
            event.relatedTarget // previous active tab
        })
    </script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#addRoute").click(function(e) {

            e.preventDefault();
            $(this).text('Updating...');
            URL = $("#add_route_form").attr('action');

            var date_received = $("input[name=date_received]").val();
            var doc_id = $("input[name=doc_id]").val();
            var employee_id = $("input[name=employee_id]").val();
            var division_id = $("input[name=division_id]").val();
            var action = $("textarea[name=action]").val();

            $.ajax({
                type: 'POST',
                url: "{{ route('docroutes.create') }}",
                data: {
                    date_received: date_received,
                    doc_id: doc_id,
                    action: action,
                    employee_id: employee_id,
                    division_id: division_id,
                },
                success: function(response) {
                    if (response.status == "success") {
                        Swal.fire(
                            'Updated!',
                            'Document Route Updated Successfully!',
                            'success'
                        )
                        fetchAllRoutes();
                    }
                    $("#addRouteModal").modal('hide');
                    $("button#addRoute").text('Update Document');
                    $("#add_route_form")[0].reset();
                },
                error: function(error) {
                    console.log(error)
                }
            });
        });

        // ----------------------- edit Route -------------------------------------------
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();

            let id = $(this).attr('id');
            $.ajax({
                url: "{{ route('edit.doc_route') }}",
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    dr = response[0].date_received;
                    $("#editRouteModal textarea[name='action'").val(response.action);

                    for (let x in response[0]) {

                        var el = document.querySelector('#editRoute');
                        el.setAttribute('data-id', id);

                        if (x.search("_id") < 0) $("#editRouteModal #" + x).val(response[0][x]);
                        else {
                            name = x.replace('_id', '');

                            $("#editRouteModal input[name='" + x + "'").val(response[0][x]);
                            $("#editRouteModal #" + x).val(response[name]);
                        }
                    }
                }
            });
        });

        $("button#editRoute").click(function(e) {
            e.preventDefault();

            var date_received = $("#editRouteModal input[name=date_received]").val();
            var action = $("#editRouteModal textarea[name=action]").val();
            var division_id = $("#editRouteModal input[name=division_id]").val();
            var employee_id = $("#editRouteModal input[name=employee_id]").val();

            var el = document.querySelector("button#editRoute");
            var id = el.getAttribute('data-id');

            $(this).text('Updating...');

            $.ajax({
                type: 'POST',
                url: '{{ route('update.doc_route') }}',
                data: {

                    date_received: date_received,
                    action: action,
                    division_id: division_id,
                    employee_id: employee_id,
                    id: id

                },
                method: 'put',
                success: function(data) {
                    // console.log(data.success);
                    if (data.status == 200) {
                        Swal.fire(
                            'Updated!',
                            'Document Route Updated Successfully! ',
                            'success'
                        )
                        fetchAllRoutes();
                    }
                    $("#editRouteModal").modal('hide');
                    $("button#editRoute").text('Update Document');
                    $("#add_route_form")[0].reset();

                }
            });
        });

        // ----------------------------------------------------------------
        fetchAllRoutes();

        function fetchAllRoutes() {
            $.ajax({
                url: '{{ route('fetchAllRoute',$document->id) }}',
                method: 'get',
                success: function(response) {
                    $("#show_all_documents").html(response);
                    var table = $('#myTable').DataTable({
                        "order": [
                            [1, "desc"]
                        ],
                        columnDefs: [{
                            orderable: false,
                            targets: [2]
                        }]
                    });

                    table.columns().iterator('column', function(ctx, idx) {
                        $(table.column(idx).header()).prepend('<span class="sort-icon"/>');
                    });
                }
            });
        }
    </script>
@endpush
