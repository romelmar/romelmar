@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Document')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
       
 
        {{-- @if ($message = Session::get('success'))
        <div data-notify="container" 
             class="col-11 col-md-4 alert alert-info alert-with-icon animated fadeInDown" 
             role="alert" 
             data-notify-position="top-center" 
             style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; left: 0px; right: 0px;"><button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 50%; margin-top: -9px; z-index: 1033;"><i class="material-icons">close</i></button><i data-notify="icon" class="material-icons">add_alert</i><span data-notify="title"></span>
              <span data-notify="message">
                Successfully updated <b>Origin Office Table</b>
              </span>
              <a href="#" target="_blank" data-notify="url"></a>
        </div>
        @endif --}}

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
        @endif

       
        <div class="col-md-12">
          <form method="post" action="{{ route('documents.update', $document->id) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit Document') }}</h4>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif

{{-- ------------------------------------------------------------------------------------------------------------------                 --}}
              <div class="row justify-content-between">
                  <div class="col-sm-7">
                      <label>{{ __('Subject') }}</label>
                      <div class="form-group{{ $errors->has('subject') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" id="input-subject" type="text" placeholder="{{ __('Subject') }}" value="{{ $document->subject }}" required="true" aria-required="true"/>
                        @if ($errors->has('subject'))
                          <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('subject') }}</span>
                        @endif
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <label>{{ __('Status') }}</label>
                    <div class="form-group">
                      <input data-db="status" type="text" id="status_id" name="name" class="form-control autocomp" placeholder="{{ $document->status->name }}">
                      <input type="hidden" name="status_id" value="{{ $document->status->id }}" >
                    </div>
                  </div>
              </div>
{{-- ---------------------------------------------------------------------------------------------------------------------------               --}}

{{-- ------------------------------------------------------------------------------------------------------------------                 --}}
              <div class="row justify-content-between">
                  <div class="col-sm-6">
                    {{-- <label>{{ __('Origin Office') }}</label>
                    <div class="form-group">
                      <input data-db="OriginOffice" type="text" id="origin_id" name="name" class="form-control autocomp" placeholder="{{ $document->origin_office->name }}">
                      <input type="hidden" name="origin_id" value="{{ $document->origin_office->id }}" >
                    </div> --}}
                  </div>
                  
                  <div class="col-sm-4">
                    <label>{{ __('Focal') }}</label>
                    <div class="form-group">
                      <input data-db="employee" type="text" id="employee_id" name="name" class="form-control autocomp" placeholder="{{$document->employee->fullname()}}">
                      <input type="hidden" name="employee_id" value="{{ $document->employee->id }}" >
                    </div>
                  </div>
              </div>
 {{-- ---------------------------------------------------------------------------------------------------------------------------               --}}
{{-- ------------------------------------------------------------------------------------------------------------------                 --}}
              <div class="row justify-content-between">
                  <div class="col-lg-6">
                    <label>{{ __('Action Taken') }}</label>
                    <div class="form-group{{ $errors->has('action_taken') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('action_taken') ? ' is-invalid' : '' }}" name="action_taken" id="input-action_taken" type="text" placeholder="{{ __('Action Taken') }}" value="{{ $document->action_taken }}" required="true" aria-required="true"/>
                      @if ($errors->has('action_taken'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('action_taken') }}</span>
                      @endif
                    </div>
                  </div>                  
                  
                  <div class="col-sm-4">
                    <label>{{ __('Origin Office') }}</label>
                    <div class="form-group">
                      <input data-db="OriginOffice" type="text" id="origin_id" name="name" class="form-control autocomp" placeholder="{{ $document->origin_office->name }}">
                      <input type="hidden" name="origin_id" value="{{ $document->origin_office->id }}" >
                    </div>                    
                    {{-- <label>{{ __('Document Type') }}</label>
                    <div class="form-group">
                      <input data-db="doctype" type="text" id="doctype_id" name="name" class="form-control autocomp" placeholder="{{ $document->doctype->name }}">
                      <input type="hidden" name="doctype_id" value="{{ $document->doctype->id }}" >
                    </div> --}}
                  </div>
              </div>
 {{-- ---------------------------------------------------------------------------------------------------------------------------               --}}
{{-- ------------------------------------------------------------------------------------------------------------------                 --}}
              <div class="row justify-content-between">
                  <div class="col-lg-6">
                    <label>{{ __('Action Required') }}</label>
                    <div class="form-group{{ $errors->has('required_action') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('required_action') ? ' is-invalid' : '' }}" name="required_action" id="input-required_action" type="text" placeholder="{{ __('Action Required') }}" value="{{ $document->required_action }}" required="true" aria-required="true"/>
                      @if ($errors->has('required_action'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('required_action') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="row">
                      <div class="col-sm-6">
                        <label>{{ __('Document Type') }}</label>
                        <div class="form-group">
                          <input data-db="doctype" type="text" id="doctype_id" name="name" class="form-control autocomp" placeholder="{{ $document->doctype->name }}">
                          <input type="hidden" name="doctype_id" value="{{ $document->doctype->id }}" >
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <label>{{ __('Means of Receiving') }}</label>
                        <div class="form-group">
                          <input data-db="mor" type="text" id="mor_id" name="name" class="form-control autocomp" placeholder="{{ $document->meansOfReceiving->name }}">
                          <input type="hidden" name="mor_id" value="{{ $document->meansOfReceiving->id }}" >
                        </div>
                      </div>
                    </div>

                  </div>                  
              </div>
 {{-- ---------------------------------------------------------------------------------------------------------------------------               --}}
          </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
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

        if($('.alert').length){
          setInterval(() => {
            $('.alert').addClass("fadeOutUp");
          }, 5000);
          
        }

    });
  </script>
  <script src="{{ asset('auto.js') }}"></script>
  
@endpush