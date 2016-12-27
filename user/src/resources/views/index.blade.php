@extends('jumperCore::layouts.dash')
@section('content')
<div id="manage-user">
	
	<div class="row" >
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Manage System Users <small>Users List</small></h2>
					<ul class="nav navbar-right panel_toolbox">
						<li>
	 						<a href="#" class="btn btn-sm" data-toggle="modal" data-target="#saveUserModal">
								<i class="fa fa-plus" aria-hidden="true"></i> Add New User
							</a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<search-panel :set_search_param="setSearchParam"></search-panel>
					<table id="users" class="table table-striped responsive-utilities jambo_table">
						<thead>
							<tr class="headings">
								<th>ID </th>
								<th>Full Name </th>
								<th>Email </th>
								<th>Role </th>
								<th>Create Date </th>
								<th>Contact </th>
								<th class=" no-link last"><span class="nobr">Action</span>
							</th>
						</tr>
					</thead>
					<tbody>
					
						<tr class="even pointer"  v-for="user in filter_by_date(users) " >
						<!-- <tr class="even pointer"  v-for="user in users | byRole | filterByDate" > -->
							<td class=" "> @{{ user.id }} </td>
							<td class=" "> @{{ user.name }} </td>
							<td class=" "> @{{ user.email }} </td>
							<td class=" "> 
								<span v-for="role in user.roles">
									<i class="fa fa-asterisk"> @{{ role.id | show_role }} </i>
								</span>
							</td>
							<td class=" "> @{{ user.created_at | dd/mm/yyyy }} </td>
							<td class=" "> @{{ user.contact }} </td>
							
							<td width="20%" class="text-right last" >
								<a class="btn btn-success btn-sm" href="javascript:;" v-if="user.status" v-on:click="toggleStatus(user)"
									data-toggle="tooltip" data-placement="left" :title="'Toogle '+user.name+'\'s Status Active / Inactive'"
								>
								   <i class="fa fa-circle"></i>
								</a>
								<a class="btn btn-grey btn-sm" href="javascript:;" v-else v-on:click="toggleStatus(user)"
									data-toggle="tooltip" data-placement="left" :title="'Toogle '+user.name+'\'s Status Active / Inactive'"
								>
								    <i class="fa  fa-circle"> </i> 
								</a>
								<a class="btn btn-primary btn-sm" href="#" v-on:click="show_edit_model(user)"
									data-toggle="tooltip" data-placement="left" :title="'Quick Edit '+user.name+' Details'"
								>
									<i class="fa fa-edit"></i>
								</a>
								
								@if(Auth::user()->hasRole('root_admin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('company') )
									<a class="btn btn-danger btn-sm" v-on:click="delete_user(user)" href="#" 
										data-toggle="tooltip" data-placement="left" :title="'Delete '+user.name"
									>
										<i class="fa fa-remove"></i>
									</a>
									<a class="btn btn-warning btn-sm" target="_blank" :href="'/admin/users/'+user.id+'/impersonate'"
										data-toggle="tooltip" data-placement="left" :title="'Impersonate '+user.name+'\'s Session'"
									>
										<i class="fa  fa-male"></i> 
									</a>
								@endif
							</td>
						</tr>
						
					</tbody>
				</table>
		
			</div>
		</div>
	</div>
</div>
@include('jumperUser::create')
</div>
@stop