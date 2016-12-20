var Vue = require('Vue');
var J = require('../jumper/lib.js');
var vueResource = require('vue-resource');
Vue.use(vueResource);
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
		$.ajax({
			url: base_url('role'),
			type: 'POST',
			dataType: 'json',
			data: self.role
		}).done(function(resp) {
				self.roles.push(resp.data[0]);
				J.alert({text:"New Role Added."});
				$("#save_role_modal")[0].reset();
				self.modal.modal('hide');
			})
			.fail(function() {
				console.log("error");
			});
	},
	update:function(){
		var self  = this;
		var _id = self.cache_role.id;
		$.ajax({
			url: base_url('role/'+_id),
			type: 'PUT',
			dataType: 'json',
			data: self.role
		}).done(function(resp) {
				var a =  _.find(self.roles, {'id':_id});
				a.name = self.role.name;
				a.display_name = self.role.display_name;
				a.description = self.role.description;
				//hide modal
				self.modal.modal('hide');
				J.alert({text:"Role Details Updated."});
		})
		.fail(function() {
			console.log("error");
		});
	},
	save_now: function() {
		var self = this;
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
		var self = this;
		$.ajax({
			url: base_url('role'),
			type: 'GET',
			dataType: 'json'
		})
			.done(function(_data) {
				if (_data.stat == true) {
					self.$set('roles', _data.data);
					setTimeout(function() {
						self.set_data_table();
						self.set_report_data();
					}, 700);
				}
				self.message = "This is aweomse message";
			})
			.fail(function() {
				console.log("error");
			});
	},
	set_report_data:function(){
		var self = this;
		var reports = [];
		_.forEach(this.roles, function(value, key) {
		 		reports.push({name:value.display_name,total:value.users.length});
		});

		this.$set('reports', reports);
	}
	,
	destory_role:function(_role){
		var self = this
		$.ajax({
			url: base_url('role/' + _role.id),
			type: 'DELETE',
			dataType: 'json'
		})
			.done(function(resp) {
				if(resp.stat){
					self.roles.$remove(_role);
					J.alert({text:"Role Deleted."});
				}else{
					J.alert({text:resp.msg,type:"error"});
				}
			})
			.fail(function() {
				console.log("error");
			});
	},
	delete_role: function(_role) {
		if(confirm("Please Confirm to delete.")){
			this.destory_role(_role);
		}
	},
	show_edit_model: function(_role) {
		//show modal
		this.modal.modal('show');
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
	ready: function() {
		this.get_all_roles();
	},
	init: function() {

	},
	methods: Role,
	methods_old: {
		save_now: function() {
			var _data = $("#save_role_modal").serialize();
			this.$http.post('/admin/role', _data, function(resp) {
				$('#saveRoleModal').modal('hide')
			})
		},
	}
});

//Role.init(_role);