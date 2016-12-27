var J = require('../jumper/lib.js');
var Chart = require('../jumper/chart.js');

// register
var userStatus =  J.Vue.component('users-status', {
  props: ['graphData','name'],
  template:'<div class="col-md-12 chart-widget" id="echart_pie4"></div>',
  mounted:function() {
    var _data = this.parseData( $.parseJSON(this.graphData)  );
    Chart.barDiagram('echart_pie4', _data );
  },
  methods:{
    parseData:function(_data){
      this.total_users = _data.length;
      this.active_users = _.filter(_data,{status:1}).length;
      this.inactive_users = this.total_users - this.active_users;

      return {
        label:['Total Users',"Active Users", "Inactive Users"],
        data:[this.total_users, this.active_users, this.inactive_users]
      }
    }
  },
  data:function(){
    return {
    total_users:0,
    active_users:0,
    inactive_users:0
  }
  }
})
// create a root instance
// new J.Vue({
//   el: '#user-status'
// });

module.exports = userStatus;
