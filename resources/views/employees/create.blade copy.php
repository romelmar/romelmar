@extends('layouts.app', ['activePage' => 'employees', 'titlePage' => __('Divisions')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="POST" action="{{ route('employees.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add Employee') }}</h4>
                {{-- <p class="card-category">{{ __('Office information') }}</p> --}}
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

                <div class="row">
                    <div class="col-sm-9">
                      <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Firstname') }}</label>
                        <div class="col-sm-10">
                          <div class="form-group{{ $errors->has('firstname') ? ' has-danger' : '' }}">
                            <input class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" id="input-firstname" type="text" placeholder="{{ __('Firstname') }}"  required="true" aria-required="true"/>
                            @if ($errors->has('firstname'))
                              <span id="firstname-error" class="error text-danger" for="input-firstname">{{ $errors->first('firstname') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Lastname') }}</label>
                        <div class="col-sm-10">
                          <div class="form-group{{ $errors->has('lastname') ? ' has-danger' : '' }}">
                            <input class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" id="input-lastname" type="text" placeholder="{{ __('Lastname') }}"  required="true" aria-required="true"/>
                            @if ($errors->has('lastname'))
                              <span id="lastname-error" class="error text-danger" for="input-lastname">{{ $errors->first('lastname') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('D esignation') }}</label>
                        <div class="col-sm-10">
                          <div class="form-group{{ $errors->has('designation') ? ' has-danger' : '' }}">
                            <input class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation" id="input-designation" type="text" placeholder="{{ __('Designation') }}"  required="true" aria-required="true"/>
                            @if ($errors->has('designation'))
                              <span id="designation-error" class="error text-danger" for="input-designation">{{ $errors->first('designation') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      {{-- ------------------------------- profile pic ------------------------- --}}
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