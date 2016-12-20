# Import search.js and search_panel.js

## var Search = require('../search/search.js');
## var Search = require('../search/search.js');

# Extending search Factor functions from search.js

# extending search functions
User = Object.assign(User,Search); // replace User with ur Module name

User.setSearchParam = function(_obj){
    this.dateRange.from =  _obj.from;
    this.dateRange.to =  _obj.to;
    this.filterBy  =  _obj.filterBy;
    if(_obj.filterBy == ""){
        this.filterBy = "";
    }else{
        this.seach_now();
    }
}

# adding search props example
new J.Vue({
	el: '#manage-user',
	data: {
		.
		.
		.
		filterBy: "",
    dateRange: {},
    serach_date_range: null,
    .
    .
    .
	},
	methods: User,
 	filters: User.filers_actions(),
  components:{
      'search-panel':SearchPanel
  }
});

# Implementing component in template
<search-panel :set_search_param="setSearchParam"></search-panel>
## implementing search filter in looop 
v-for="user in users | filterByDate"

## Example
<table id="users" class="table table-striped responsive-utilities jambo_table">
			<thead>
				<tr class="headings">
					<th>ID </th>
					<th>Full Name </th>
					<th>Email </th>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr class="even pointer"  v-for="user in users | filterByDate" >
				<td class=" "> @{{ user.id }} </td>
				<td class=" "> @{{ user.name }} </td>
				<td class=" "> @{{ user.email }} </td>
				
		</tbody>
</table>