#component implementation of jquery plugin date_range_picker (http://www.daterangepicker.com/#config)

## implementation 
<pre>
var date_picker = require('../jumper/date_picker.js');

new J.Vue({
	el: '#save-child',
	data: {
		
	},
	ready: function() {
		this.init();
	},
	methods: Child
	,components: {
		'date_picker':date_picker // regular component registration
    'date-picker_async':function(resolve){  // for Async component registration
    	setTimeout(function () {
			    resolve(date_picker)
			}, 1000)
    }
  }
});
</pre>

````sh
 <date-picker name="training_expire_date" :init_data.sync="training.expire_date" ></date-picker>


 ## @params
 name :  name for the component
 init_data : parent variable for two way binding