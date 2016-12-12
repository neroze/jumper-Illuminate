
var J = require('../jumper/lib.js');
var Chart = require('../jumper/chart.js');
// register

J.Vue.component('total-childrens', {
	props: ['number_of_childern'],
  template: '<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">'
					    +'<div class="tile-stats">'
					        +'<div class="icon"><i class="fa fa-child sun"></i></div>'
					        +'<div class="count">'
					           +' {{ number_of_childern }}'
					        +'</div>'
					        +'<h3>Childrens </h3>'
					        +'<p>Total Number of Childrens enrolled into system</p>'
					    +'</div>'
					+'</div>'
	,ready:function() {
     
  },
  methods:{
  	
  },
  data:function(){
  	return {
  		users_status:1000
  	}
  }
})
// create a root instance
new J.Vue({
  el: '#dashboard-panel'
})