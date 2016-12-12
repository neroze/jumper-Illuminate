 <div class="col-md-6 col-sm-6 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Field Visits <small>List of the Recent Field Visits</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
		
			<div class="row">
				<div class="col-md-8">
				<h5>Latest Field Visits</h5>
					<ul class="list-group">
					@if($visits)
						@foreach(array_slice($visits, 0, 15) as $key => $visit)
	  					<li class="list-group-item">
	  							{{ $visit['name'] }} 
	  							<i class="label label-info">{{ date("F j, Y",strtotime($visit['date']) )  }} </i>
	  							@if($visit['date'])
	  								<i class="label label-success">Open </i>
	  							@else
	  								<i class="label label-error">Close </i>
	  							@endif
	  					</li>
						@endforeach
					@endif
					</ul>
				</div>
				<div class="col-md-4 text-center">
					<h5>Total Field Visits</h5>
					<h1 class="green" style="font-size: 100px;">{{ count($visits) }}</h1>
				</div>
			</div>
				<div class="row">
					<a href="/coordinator/field-visits" class="btn-sm btn-info pull-right">
						View all...
					</a>
				</div>
				
			</div>
		</div>
  </div>


 <!-- Over Due Field Visists -->
 <div class="col-md-6 col-sm-6 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Over Due Field Visits <small>List of the over due field visits</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
		
			<div class="row">
				<div class="col-md-8">
				<h5>Latest Field Visits</h5>
					<ul class="list-group">
					@if($visits_due)
						@foreach(array_slice($visits_due, 0, 15) as $key => $visit)
	  					<li class="list-group-item">
	  							{{ $visit['name'] }} 
	  							<i class="label label-danger">{{ date("F j, Y",strtotime($visit['date']) )  }} </i>
	  							@if($visit['date'])
	  								<i class="label label-success">Open </i>
	  							@else
	  								<i class="label label-error">Close </i>
	  							@endif
	  					</li>
						@endforeach
					@endif
					</ul>
				</div>
				<div class="col-md-4 text-center">
					<h5>Total Field Visits</h5>
					<h1 class="green" style="font-size: 100px;">{{ count($visits) }}</h1>
				</div>
			</div>
				<div class="row">
					<a href="/coordinator/field-visits" class="btn-sm btn-info pull-right">
						View all...
					</a>
				</div>
				
			</div>
		</div>
  </div>


  <!-- list of expired certificates -->
@include('site.dashboard.certificate_expired')

<!-- list of about to expire certificates -->
@include('site.dashboard.certificate_about_to_expire')


