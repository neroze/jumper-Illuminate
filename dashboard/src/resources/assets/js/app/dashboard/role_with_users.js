var J = require('../jumper/lib.js');
var Chart = require('../jumper/chart.js');

// register
J.Vue.component('my-component', {
	props: ['graphType','graphData'],
  template: '<div class="col-md-12 chart-widget" id="echart_pie2">test</div>',
	ready:function() {
     var _roleData = this.parseRoleForPieChart( $.parseJSON(this.graphData)  );
     Chart.pieChart('echart_pie2', _roleData );
  },
  methods:{
  	parseRoleForPieChart:function(_roleData){
  		var data = [];
  		var label = [];
  		_.each(_roleData, function(item) {
  				var a = {};
  				a.value =  	item.users.length;
  				a.name 	= 	item.display_name;
  				label.push(item.display_name);
  				data.push(a);
  		});
  		return {label:label,data:data};
  	}
  }
})
// create a root instance
new J.Vue({
  el: '#dashboard'
})
