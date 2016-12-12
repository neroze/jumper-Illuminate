 <div class="col-md-6 col-sm-6 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>System Users <small>System Users Status </small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content" id="user_status_panel">
				<users-status name="user_status" graph-data="{{$users_status}}"></users-status>
			</div>
		</div>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12" id="user-status">
		<div class="x_panel">
			<div class="x_title">
				<h2>User Role Status <small>Number of users by role</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
			@if($role)
				<my-component name="role" graph-data="{{$role}}" ></my-component>
			@endif

			</div>
		</div>
  </div>