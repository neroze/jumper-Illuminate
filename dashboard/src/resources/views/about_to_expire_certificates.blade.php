@if( !$about_to_expire_certificates->isEmpty() )
	   <div class="col-md-6 col-sm-6 col-xs-12 ">
			<div class="x_panel">
				<div class="x_title">
					<h2>Training Certificates About to Expire <small> Total Certificates expire in next 2 week </small> </h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
			
				<div class="row animated shake">
					<div class="col-md-8">
					<h5>About to expire </h5>
						<ul class="list-group">
						@if($about_to_expire_certificates)
							@foreach($about_to_expire_certificates as $key => $doc)
		  					<li class="list-group-item alert " role="alert">
		  							{{ $doc['educator_name'] }}
		  							 <i class="label label-danger"> {{ date("F j, Y",strtotime($doc['expire_date']) )  }}</i>
		  							 {{ $doc['training_title'] }} 
		  							
		  					</li>
							@endforeach
							</ul>
						@endif
						
					</div>
					<div class="col-md-4 text-center">
						<h5>Total Certificates </h5>
						<h1 class="red" style="font-size: 100px;">{{ count($about_to_expire_certificates) }}</h1>
					</div>
				</div>
				
					<a href="/admin/all-about-to-expire-certificates" class="pull-right label-info label" style="padding: 5px;"> View All..</a>
				</div>
			</div>
	  </div>
	@endif