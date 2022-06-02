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
@push('footer')
    @include('scripts.route_crud')
@endpush

@push('js')
    <script src="https://unpkg.com/pdfobject@2.2.7/pdfobject.min.js"></script>
    <script type="text/javascript">
        PDFObject.embed("{{ route('show-pdf', ['id' => $image->id]) }}", "#pdf-viewer");
        $(function() {
            $('.datepicker').datepicker();
        });

        var tabEl = document.querySelector('button[data-bs-toggle="tab"]')
        tabEl.addEventListener('shown.bs.tab', function(event) {
            event.target // newly activated tab
            event.relatedTarget // previous active tab
        })
    </script>
    <script src="{{ asset('auto.js') }}"></script>


@endpush
