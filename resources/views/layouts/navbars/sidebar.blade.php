<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      {{ __('docmon') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>

      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons text-success">archive</i>
            <p>{{ __('All Documents') }}</p>
        </a>
      </li>   
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('overdues') }}">
          <i class="material-icons text-danger">content_paste</i>
            <p class="position-relative">{{ __('Overdues') }}
            
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $overdues }}
                <span class="visually-hidden">Need immediate action</span>
              </span>
            </p>
        </a>
        
      </li>      
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('due-today') }}">
          <i class="material-icons text-warning">content_paste</i>
            <p>{{ __('Due today') }}
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                {{ $dueToday }}
                <span class="visually-hidden">Today's Dues</span>
              </span>            
            </p>

        </a>
      </li>      
   
      <li class="nav-item {{ ($activePage == 'docInfo' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link {{ ($activePage == 'docInfo') ? '' : 'collapsed' }}" data-toggle="collapse" href="#doccollapse" aria-expanded="{{ ($activePage == 'docInfo') ? 'true' : 'false' }}">
          <i class="material-icons md-48 text-success">list</i>
          <p>{{ __('Document info') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'docInfo'|| $activePage == 'statuses' || $activePage == 'mor'  || $activePage == 'divisions' || $activePage == 'doctypes') ? 'show' : '' }}" id="doccollapse">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'originOffice' || $activePage == 'docInfo' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('origin-offices.index') }}">
                <span class="sidebar-mini"> OO </span>
                <span class="sidebar-normal">{{ __('Origin Offices') }} </span>
              </a>
            </li>
            
            <li class="nav-item{{ $activePage == 'divisions' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('divisions.index') }}">
                <span class="sidebar-mini"> DV</span>
                <span class="sidebar-normal">{{ __('Divisions') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'doctypes' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('doctypes.index') }}">
                <span class="sidebar-mini"> DT</span>
                <span class="sidebar-normal">{{ __('Doc Types') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'mor' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('mor.index') }}">
                <span class="sidebar-mini"> MR</span>
                <span class="sidebar-normal">{{ __('Means of Receiving') }} </span>
              </a>
            </li>

            <li class="nav-item{{ $activePage == 'statuses' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('statuses.index') }}">
                <span class="sidebar-mini"> ST</span>
                <span class="sidebar-normal">{{ __('Statuses') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>      
      <li class="nav-item{{ $activePage == 'employees' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('employees.index') }}">
          <i class="material-icons md-48 text-primary">manage_accounts</i>
            <p>{{ __('Employees') }}</p>
        </a>
      </li>
     
  
     

    </ul>
  </div>
</div>
