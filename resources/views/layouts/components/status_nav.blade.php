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