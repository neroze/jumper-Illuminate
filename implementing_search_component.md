# Import search.js and search_panel.js
<pre>
	var Search = require('../search/search.js');
 	var Search = require('../search/search.js');
</pre>

# Extending search Factor functions from search.js
<pre>
var User = {}
User.add_new_user = function(){
	...
}

User.edit_user = function(){
	...
}

User.delete_user = function(){
	...
}

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
</pre>

# adding search props example
<pre>
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
</pre>

# Implementing component in template
<search-panel :set_search_param="setSearchParam"></search-panel>
## implementing search filter in looop 
v-for="user in users | filterByDate"

## Example
<pre>

			&#60; tr class="even pointer"  v-for="user in users | filterByDate" &#62;
				
</pre>
