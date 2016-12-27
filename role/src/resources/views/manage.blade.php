@extends('jumperCore::layouts.dash')
@section('content')
<div id="manage-role">
	<div class="row">
		 <ul>
		 	<li style="padding: 3px; margin: 3px; font-size: 12px;" v-for="report in reports"  class="label label-info animated flipInY">
		 		<i class="fa fa-users"></i> @{{ report.name}} ( @{{ report.total }} ) 
		 	</li>
		 </ul>
	</div>
	<div class="row" >
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Manage Access Roles <small>User Roles</small></h2>
					<ul class="nav navbar-right panel_toolbox">
						<li>
	 						<a href="#" class="btn btn-sm" data-toggle="modal" data-target="#saveRoleModal">
								<i class="fa fa-plus" aria-hidden="true"></i> Add New Role
							</a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				
				<div class="x_content">
					<table id="roles" class="table table-striped responsive-utilities jambo_table">
						<thead>
							<tr class="headings">
								<th>
									ID
								</th>
								<th>Role Title </th>
								<th>Description </th>
								<th class=" no-link last"><span class="nobr">Action</span>
							</th>
						</tr>
					</thead>
					<tbody>
					
						<tr class="even pointer"  v-for="role in roles">
							<td width="20px" class="a-center ">
								@{{ role.id }}
							</td>
							<td class=" "> @{{ role.display_name }} <span v-if="role.users"> ( @{{ role.users.length }} )  </span> </td>
							<td class=" ">@{{ role.description}}</td>
							
							<td width="20%" class="text-right last">
								<a class="btn btn-info btn-sm" href="#" v-on:click="show_edit_model(role)"
										data-toggle="tooltip" data-placement="left" v-bind:title="'Edit '+role.display_name"
								>
									<i class="fa fa-edit"></i>
								</a>
								<a class="btn btn-danger btn-sm hide" v-on:click="delete_role(role)" href="#"
									data-toggle="tooltip" data-placement="left" :id="role.display_name" v-bind:title="'Delete '+role.display_name"
								>
									<i class="fa fa-remove"></i>
								</a>
							</td>
						</tr>
						
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
	</div>
	@include('jumperRole::save')
</div>
@stop