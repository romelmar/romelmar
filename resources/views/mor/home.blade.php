@extends('layouts.app', ['activePage' => 'mor', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
        @include('layouts.components.status_nav')
      
  
          @if ($message = Session::get('success'))

          <div data-notify="container" 
               class="col-11 col-md-4 alert alert-info alert-with-icon animated fadeInDown" 
               role="alert" 
               data-notify-position="top-center" 
               style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; left: 0px; right: 0px;"><button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 50%; margin-top: -9px; z-index: 1033;"><i class="material-icons">close</i></button><i data-notify="icon" class="material-icons">add_alert</i><span data-notify="title"></span>
                <span data-notify="message">
                  {{$message}}
                </span>
                <a href="#" target="_blank" data-notify="url"></a>
          </div>
          @endif
          
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">{{__("Means of Receiving")}}</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                    <a class="nav-link " href="{{ route("mor.create") }}" >
                        <i class="material-icons">add</i> Add
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <th>
                      {{ __('Id')}}
                    </th>
                    <th>
                      {{ __('Name') }}
                    </th>
                    <th>
                      {{ __('Action') }}
                    </th>
 
                  </thead>
                  
                  <tbody>
                    @foreach ($MeansOfReceiving as $origin_office)
                    
                    <tr>

                      <td>
                        {{ $origin_office->id }}
                      </td>
                      <td>
                        {{ $origin_office->name }}
                      </td>
                      <td>
                        <a href="{{ route("mor.edit", $origin_office->id)}}">Edit</a>
                        
                      </td>
   
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
              
            </div>
          </div>
        </div>

      </div>
      <div class="row"> {{ $MeansOfReceiving->links() }}</div>
      
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();


        // $('.alert').delay(15000).addClass("fadeOutUp");`

        if($('.alert').length){
          setInterval(() => {
            $('.alert').addClass("fadeOutUp");
          }, 3000);
          
        }
    });
  </script>
@endpush