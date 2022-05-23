@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Document')])
@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        {{-- {{ dd($document->meansOfReceiving)}} --}}
        {{-- --------------------------------------------------------- --}}
 
        @if ($message = Session::get('success'))
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
        @endif

       
        <div class="col-md-12">
          <form method="post" action="{{ route('documents.update', $document->id) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')


            <div class="card form-wrap">
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

                <div class="row justify-content-between">
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-3">
                                <label>{{ __('Control #') }}</label>
                                <div class="form-group{{ $errors->has('control_number') ? ' has-danger' : '' }}">
                                  <input class="form-control{{ $errors->has('control_number') ? ' is-invalid' : '' }}" name="control_number" id="input-control_number" type="text" value="{{ $document->control_number }}"  required="true" aria-required="true"/>
                                  @if ($errors->has('control_number'))
                                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('control_number') }}</span>
                                  @endif
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <label>{{ __('Subject') }}</label>
                                <div class="form-group{{ $errors->has('subject') ? ' has-danger' : '' }}">
                                  <input class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" id="input-subject" type="text" value="{{ $document->subject }}"  required="true" aria-required="true"/>
                                  @if ($errors->has('subject'))
                                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('subject') }}</span>
                                  @endif
                                </div>
                            </div>
                        </div>     
                        <div class="row">
                            <div class="col-sm-12 mt-4">
                                <div class="form-group">
                                    <label for="action_taken"> {{ __("Action Taken")}}</label>
                                    <textarea class="form-control" id="action_taken" name="action_taken" rows="5">{{ $document->action_taken }}</textarea>
                                  </div>
                            </div>
                        </div>                   
                        <div class="row">
                            <div class="col-sm-12 mt-4">
                                <div class="form-group">
                                    <label for="required_action"> {{ __("Action Required")}}</label>
                                    <textarea class="form-control" id="required_action" name="required_action" rows="5">{{ $document->required_action }}</textarea>
                                  </div>
                            </div>
                        </div>                   
                    </div>
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>{{ __('Date Received') }}</label>
                                <div class="form-group">
                                  <input type="text" id="date_received" name="date_received" class="form-control datepicker" value="{{ $document->date_received }}">
                                  {{-- <input type="hidden" name="date_received" value=" " > --}}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>{{ __('Deadline / Schedule') }}</label>
                                <div class="form-group">
                                  <input type="text" id="deadline" name="deadline" class="form-control datepicker" value="{{ $document->deadline }}">
                                  {{-- <input type="hidden" name="deadline" value=" " > --}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>{{ __('Status') }}</label>
                                <div class="form-group">
                                  <input data-db="status" type="text" id="status_id" name="name" class="form-control autocomp" placeholder="{{ $document->status->name}}">
                                  <input type="hidden" name="status_id" value="{{ $document->status_id }}" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>{{ __('Focal') }}</label>
                                <div class="form-group">
                                  <input data-db="employee" type="text" id="employee_id" name="name" class="form-control autocomp" placeholder="{{ $document->employee->fullname() }}">
                                  <input type="hidden" name="employee_id" value="{{ $document->employee_id }}" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>{{ __('Origin Office') }}</label>
                                <div class="form-group">
                                  <input data-db="OriginOffice" type="text" id="origin_id" name="name" class="form-control autocomp" placeholder="{{ $document->origin_office->name }}" >
                                  <input type="hidden" name="origin_id" value="{{ $document->origin_id }}" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>{{ __('Means of Receiving') }}</label>
                                <div class="form-group">
                                  <input data-db="mor" type="text" id="mor_id" name="name" class="form-control autocomp" placeholder="{{ $document->meansOfReceiving->name}}" >
                                  <input type="hidden" name="mor_id" value="{{$document->mor_id}}" >
                                </div>                                
                                                           
                            </div>
                            <div class="col-sm-6">
                                <label>{{ __('Document Type') }}</label>
                                <div class="form-group">
                                  <input data-db="doctype" type="text" id="doctype_id" name="name" class="form-control autocomp" placeholder="{{$document->doctype->name}}">
                                  <input type="hidden" name="doctype_id" value="{{$document->doctype_id}}" >
                                </div> 
                            </div>
                        </div>
                    </div>

                </div>
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

<script type="text/javascript">
    $(function() {
       $('.datepicker').datepicker();
    });
</script>   
<script src="{{ asset('auto.js') }}"></script>
@endpush
