@extends('jumperCore::layouts.dash')
@section('content')
<div id="user-account">
	
	<div class="row">
		<div class="col-md-12">
			@if ( $user->subscribed("main") )
			
			@else
			<div class="alert alert-danger">
				<i class="fa fa-lock"></i>
				
				@if ( $user->onGenericTrial() )
				<p>Your Tiral Period ends at {{ $user->trial_ends_at }}. Please, add your subscription. </p>
				@else
				<p>Your Tiral Period has ended. Please, add your subscription. </p>
				@endif
			</div>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			@if (Session::has('message'))
			<div class="alert alert-info">
				<i class="fa fa-check"></i>
				{{ Session::get('message') }}
			</div>
			@endif
			
			@if ($errors->any())
			<div class="alert alert-danger">
				<i class="fa fa-lock"></i>
				{!! implode('', $errors->all('
				<p>:message</p>
				')) !!}
			</div>
			@endif
		</div>
	</div>
	
	<div class="row" >
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>User Profile<small>User Subscription Managment</small></h2>
					<div class="clearfix"></div>
				</div>
				
				<div class="x_content">
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>User Subscription Panel</h4>
						</div>
						<div class="panel-body">
							@if ($user->subscribed('main'))
							@if ( $user->subscription('main')->cancelled() )
							@if ( $user->subscription('main')->onGracePeriod() )
							<p>Your subscription will ends on {{ $user->subscription('main')->subscription_ends_at }} </p>
							<a href="{{ url('/admin/user/resume-subscription') }}" class="btn btn-success" >Resume Subscription</a>
							@else
							<p>Your subscription has ended on {{ $user->subscription('main')->subscription_ends_at }} </p>
							<a href="{{ url('/admin/user/subscribe') }}" class="btn btn-success" >Add Subscription</a>
							@endif
							@else
							<p>Your subscription will renew on {{ $user->subscription('main')->subscription_ends_at }} </p>
							<a href="{{ url('/admin/user/cancel-subscription') }}" class="btn btn-danger" >Cancel Subscription</a>
							@endif
							@else
							<a href="{{ url('/admin/user/subscribe') }}" class="btn btn-success" >Add Subscription</a>
							
							@endif
							
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	
</div>
@stop

@section('footerScript')
 <script>
 		setTimeout(function(){
 			$('.alert').addClass("shake animated");
 		}, 1000);
 		

 </script>
@stop