@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Due today</p>
              <h3 class="card-title">{{ $dueToday }}
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">date_range</i>
                <a href="#pablo">Due soon</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">{{ __('Recent')}}</p>
              <h3 class="card-title">{{ $recent }}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-success">date_range</i> {{ __('Added this week')}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">info_outline</i>
              </div>
              <p class="card-category">{{ __('Immediate')}}</p>
              <h3 class="card-title">{{ $overdues }}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">warning</i> {{ __('Overdue Documents')}}
              </div>
            </div>
          </div>
        </div>

      </div>
@include('layouts.components.notification')
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Documents</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link " href="{{ route("documents.create") }}" >
                        <i class="material-icons">add</i> Add
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    {{-- <li class="nav-item">
                      <a class="nav-link active" href="#messages" data-toggle="tab">
                        <i class="material-icons">code</i> Website
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#settings" data-toggle="tab">
                        <i class="material-icons">cloud</i> Server
                        <div class="ripple-container"></div>
                      </a>
                    </li> --}}
                  </ul>
                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead class=" text-primary">
                    <th>
                      {{ __('Date')}}
                    </th>
                    <th>
                      {{ __('Subject') }}
                    </th>
                    
                    {{-- <th>
                      {{ __('Action Taken')}}
                    </th>
                    <th>
                      {{ __('Action Required')}}
                    </th> --}}
                    <th></th>
                  </thead>
                  
                  <tbody class="">
                    @foreach ($docs as $doc)
                    
                    <tr>

                      <td>
                        <button type="button" class="btn btn-info">
                          Received<span class="badge bg-primary">{{ $doc->date_received }}</span>
                        </button>
                        <button type="button" class="btn btn-{{ $doc->expired() }}">
                          Deadline<span class="badge bg-secondary">{{ $doc->deadline }} </span>
                        </button>
                       
                      </td>
                      <td>
                        {{ $doc->subject }}
                       
                      </td>
                      
                      {{-- <td>
                        {{ $doc->action_taken }}
                      </td>
                      <td>
                        {{ $doc->required_action }}
                      </td> --}}
                      <td class="flex action-td">
                        <a href="{{ route("documents.show", $doc->id)}}"><i class="material-icons">visibility</i></a>
                        <a href="{{ route("documents.edit", $doc->id)}}" rel="tooltip" title="Edit: {{ $doc->subject }}" ><i class="material-icons">edit</i></a></td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
              
            </div>
          </div>
        </div>

      </div>
      <div class="row"> {{ $docs->links() }}</div>
      </div>
      
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
      if($('.alert').length){
          setInterval(() => {
            $('.alert').addClass("fadeOutUp");
          }, 3000);
          
        }
    });
  </script>

<script src="{{ asset('auto-docs.js') }}"></script>
@endpush

