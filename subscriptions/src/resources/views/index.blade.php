@extends('jumperCore::layouts.dash')
@section('content')
<div id="manage-orders">
	
	<div class="row" >
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Subscriptions <small>All subscriptions</small></h2>
					<div class="clearfix"></div>
				</div>
				
				<div class="x_content">
					<search-panel :set_search_param="setSearchParam"></search-panel>
					<table id="orders" class="table table-striped responsive-utilities jambo_table">
						<thead>
							<tr class="headings">
								<th>
									<!-- <input type="checkbox" class="tableflat"> -->
								</th>
								<th>Date</th>
								<th>Customer ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Sell Price</th>
								<th>Payment Terms</th>
								<th>Expires On</th>
								<!-- <th class=" no-link last"><span class="nobr"></span></th> -->
						</tr>
					</thead>
					<tbody>
						<tr class="even pointer"  v-for="order in filter_by_date(orders) ">
							<td width="20px" class="a-center "  >
								<i class="fa fa-arrow-right"></i>
							</td>
							<td class=" "> @{{ order.created_at | dd/mm/yyyy }} </td>
							<td class=" "> @{{ order.stripe_id }} </td>
							<td class=" "> @{{ order.user.name }}</td>
							<td class=" "> @{{ order.user.email }}</td>
							<td>@{{ order.amount_format }}</td>
							<td class=" "> @{{ order.stripe_plan }} </td>
							<td class=" "> @{{ order.subscription_ends_at | dd/mm/yyyy }} </td>
						</tr>
						
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>
</div>
@stop