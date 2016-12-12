
	@if($expired_trainings)
	   <div class="col-md-6 col-sm-6 col-xs-12 ">
			<div class="x_panel">
				<div class="x_title">
					<h2>Expired Training Certificates <small> </small> </h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
			
				<div class="row animated shake">
					<div class="col-md-8">
					<h5>Recently expired </h5>
						<ul class="list-group">
						@if($expired_trainings)
							@foreach($expired_trainings as $key => $doc)
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
						<h5>Total Expired Certificate</h5>
						<h1 class="red" style="font-size: 100px;">{{ count($expired_trainings) }}</h1>
					</div>
				</div>
				
					<a href="/admin/all-about-to-expire-certificates/due" class="btn-sm btn-info">Expired</a>
				</div>
			</div>
	  </div>
	@endif