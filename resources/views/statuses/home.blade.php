@extends('layouts.app', ['activePage' => 'statuses', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
        @include('layouts.components.status_nav')
        @include('layouts.components.notification')

          
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">{{__("Statuses")}}</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                    <a class="nav-link " href="{{ route("statuses.create") }}" >
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
                    @foreach ($statuses as $origin_office)
                    
                    <tr>

                      <td>
                        {{ $origin_office->id }}
                      </td>
                      <td>
                        {{ $origin_office->name }}
                      </td>
                      <td>
                        <a href="{{ route("statuses.edit", $origin_office->id)}}">Edit</a>
                        
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
      <div class="row"> {{ $statuses->links() }}</div>
      
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