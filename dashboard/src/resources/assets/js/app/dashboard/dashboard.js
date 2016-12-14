var J = require('../jumper/lib.js');
var Opt = require('../config/option.js');
var userStatus 		= require('./users_status.js');
var MyComponents 	= require('./role_with_users.js');

var Dash = {};

Dash.init = function(){
}

Dash.fire_notifications = function(e){
	e.preventDefault();
	J.alert({text:"Firing notification is on progress, please do not refresh the page."});
	J.btn_loading(e.target);
	var self = this;
	this.$http.get(base_url('fire-notifications')).then((resp)=>{
		var resp = resp.data;
		J.alert({type:"sucess",text:"All Notification Sent."});
		J.btn_reset(e.target);
	},(error) => {
		J.log("eoorr"+ error);
	});
}

new J.Vue({
	el: '#dashboard-panel',
	data: {
		childs:[]
	},
	ready: function() {
		this.init();
	},
	methods: Dash
});



    

