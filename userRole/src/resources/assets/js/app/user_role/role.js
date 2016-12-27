import Vue from 'vue'
import vueResource from 'vue-resource'
Vue.use(vueResource)
// var Vue = require('Vue');
var J = require('../jumper/lib.js');
// var vueResource = require('vue-resource');
// Vue.use(vueResource);
var _ = require('lodash');

var Role = {
	set_data_table: function() {
		var asInitVals = new Array();
		$('input.tableflat').iCheck({
			checkboxClass: 'icheckbox_flat-green',
			radioClass: 'iradio_flat-green'
		});

		setTimeout(function(){
			J.set_data_table('#roles');
		},700);
	},
	add_new:function(){
		var self = this;
		this.$http.post(base_url('role'), this.role).then(res => {
		  self.roles.push(res.data.data[0]);
			J.alert({text:"New Role Added."});
			$("#save_role_modal")[0].reset();
			$("#saveRoleModal").modal('hide');
		}).catch(err => {
		  redAlert(Jumper.lang.some_went_wrong);
		});
	},
	update:function(){
		var _id = this.cache_role.id;
		this.$http.put(base_url('role/'+_id),this.role).then(res => {
		  	var a =  _.find(this.roles, {'id':_id});
				a.name = this.role.name;
				a.display_name = this.role.display_name;
				a.description = this.role.description;
				//hide modal
				$("#saveRoleModal").modal('hide');
				J.alert({text:"Role Details Updated."});
				$("#save_role_modal")[0].reset();

		}).catch(err => {
		  redAlert(Jumper.lang.some_went_wrong);
		});
	},
	save_now: function() {
		var _data = $("#save_role_modal").serialize();
		//self.current_role.name = $('#name').val();
		if(this.cache_role == null){
			this.add_new();
		}else{
			this.update();
			this.cache_role = null;
		}
	},
	get_all_roles: function() {
		this.$http.get(base_url('role')).then(res => {
			if (res.data.stat == true) {
				this.roles = res.data.data;
				setTimeout(() => {
					this.set_data_table();
					this.set_report_data();
				}, 700);
			}
		}).catch(err => {
		  redAlert(Jumper.lang.some_went_wrong);
		});
	},
	set_report_data:function(){
		var self = this;
		var reports = [];
		_.forEach(this.roles, function(value, key) {
		 		reports.push({name:value.display_name,total:value.users.length});
		});
		this.reports = reports;
	}
	,
	destory_role:function(_role){
		this.$http.delete(base_url('role/' + _role.id)).then(res => {
		  if(res.data.stat){
				this.roles.$remove(_role);
				J.alert({text:"Role Deleted."});
			}else{
				J.alert({text:res.data.msg,type:"error"});
			}
		}).catch(err => {
		   redAlert(Jumper.lang.some_went_wrong);
		});
	},
	delete_role: function(_role) {
		if(confirm("Please Confirm to delete.")){
			this.destory_role(_role);
		}
	},
	show_edit_model: function(_role) {
		//show modal
		$("#saveRoleModal").modal('show');
		// set edit values
		this.role.name = _role.name;
		this.role.display_name = _role.display_name;
		this.role.description = _role.description;
		// set role in cache
		this.cache_role = _role;
	}
}

new Vue({
	el: '#manage-role',
	data: {
		reports:[],
		message: 'Hello Vue.js!',
		roles: [],
		role:{
			name:null,
			display_name:null,
			description:null
		},
		cache_role:null,
		modal:$("#saveRoleModal")
	},
	mounted: function() {
		this.get_all_roles();

	},
	methods: Role
});

//Role.init(_role);