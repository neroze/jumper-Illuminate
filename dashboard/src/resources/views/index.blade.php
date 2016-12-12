@extends('jumperCore::layouts.dash')

@section('content')
<div id="dashboard-panel">
	<div class="row">

		@if($user->hasRole('root_admin') )
			@include('dash::total_app_users')
	  	@include('dash::total_balance')
	  	@include('dash::fireNotifications')
		@endif
	</div>
	<div class="row" id="dashboard">
	@if($user->hasRole('root_admin') ||  $user->hasRole('admin') || $user->hasRole('company') || $user->hasRole('company_admin'))
		@include('dash::admin_level_charts')
	@endif
	</div>

</div>
@stop

@section('footerScript')
	<script>
			@if ( $user->onGenericTrial() )
				setTimeout(function(){
						redAlert('<p>Your Tiral Period ends at {{ $user->trial_ends_at }}. Please, add your subscription. </p>');
				}, 2000);
			@endif
	</script>
@stop
