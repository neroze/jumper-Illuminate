var J = require('../jumper/lib.js');
var Chart = require('../jumper/chart.js');

// register
J.Vue.component('enrollments-widget', {
	props: ['graphData'],
  name:"enrollments-comp",
  template: '<div class="col-md-12 chart-widget"  id="echart_pie3"></div>',
	ready:function() {
     var _data = this.parseEnrollmentForSplineChart( $.parseJSON(this.graphData)  );
     Chart.splineChart('echart_pie3', _data );
  },
  methods:{
  	parseEnrollmentForSplineChart:function(_data){
      var month_names_short = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

  		var data = [];
  		var label = [];
  		_.each(_data, function(item) {

          label.push(month_names_short[item.month - 1]);
  				data.push(item.user_count);
  				
  		});

  		return {label:label,data:data};
  	}
  }
})
// create a root instance
new J.Vue({
  el: '#dashboard'
})
