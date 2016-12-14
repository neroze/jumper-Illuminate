@extends('jumperCore::layouts.dash')

@section('content')
<div id="dashboard-panel">
	<div class="row">

		@if($user->hasRole('root_admin') )
			@include('jumperDash::total_app_users')
	  	@include('jumperDash::total_balance')
	  @else
	  	<h5>You need to be Root Admin</h5>
		@endif
	</div>
	
	<div id="dashboard">
	@if($user->hasRole('root_admin') ||  $user->hasRole('admin') )
		@include('jumperDash::admin_level_charts')
	@endif
	</div>
   <div style="clear: both;"></div>
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
