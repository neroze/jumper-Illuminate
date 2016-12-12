<div class="row">
  @if($coordinator)
	 	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	      <div class="tile-stats">
	          <div class="icon">
	          <!-- <i class="fa green fa-user"></i> -->
	          </div>
	          <div class="count green">Coordinator</div>

	          <h3 style="font-size: 20px;">{{$coordinator['name']}}</h3>
	          <p>{{$coordinator['email']}}</p>
	      </div>
	  </div>
	  @endif

	  @if($childrens)
	  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
          <div class="icon"><i class="fa fa-users"></i>
          </div>
          <div class="count">{{ $childrens }}</div>

          <h3>Childrens Enrolled</h3>
          <p>Total number of children Enrolled to you.</p>
      </div>
     @endif
  	</div>

 </div>

 <div class="row">

 <!-- assinstants -->
	 <div class="col-md-6 col-sm-6 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Assistants <small> List of the Assistants Educator</small> </h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
			
				<div class="row">
					<div class="col-md-8">
					<h5>Recently assigned assistants</h5>
						<ul class="list-group">
						@if($assistants)
							@foreach( $assistants as $key => $user)
		  					<li class="list-group-item">
		  							
		  							{{ $user->name }} 
		  							
		  					</li>
							@endforeach
						@endif
						</ul>
					</div>
					<div class="col-md-4 text-center">
						<h5>Total Assistants Assigned</h5>
						<h1 class="green" style="font-size: 100px;">{{ count($assistants) }}</h1>
					</div>
				</div>
				
					
				</div>
			</div>
	  </div>
<!-- end of assistants list -->

<!-- list of expired certificates -->
@include('site.dashboard.certificate_expired')

<!-- list of about to expire certificates -->
@include('site.dashboard.certificate_about_to_expire')

</div>

