@extends('layouts.app', ['activePage' => 'masterlist', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            @include('layouts.components.notification')
            <div class="row my-3">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-header card-header-primary d-flex justify-content-between align-items-center">
                            <h3 class="text-light">{{ __('Documents') }}</h3>
                            {{-- <button type="button"  class="btn btn-light"  data-toggle="modal" data-target="#addDocumentModal"> --}}
                            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#addDocumentModal">
                                <i class="bi-plus-circle me-2"></i> Add New Document</button>
                        </div>

                        <div class="card-body " id="show_all_documents">
                            {{-- @include('layouts.components.loader') --}}

                        </div>
                    </div>
                </div>
            </div>

            {{-- Document modal start --}}
            {{-- @include('layouts.document.add')
            @include('layouts.document.edit') --}}
            {{-- Document modal end --}}
        </div>
    </div>
@endsection
@push('footer')
    @include('scripts.document_add')
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();
            if ($('.alert').length) {
                setInterval(() => {
                    $('.alert').addClass("fadeOutUp");
                }, 3000);

            }
        });
    </script>

    <script src="{{ asset('auto.js') }}"></script>

@endpush
