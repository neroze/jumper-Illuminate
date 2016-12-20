var J = require('../jumper/lib.js');
var Search = require('../search/search.js');
var SearchPanel = require('../search/search_panel.js');

var User = {};

User.add_new = function(formData){
	var self = this;
	this.$http.post(base_url('add-new-user'), formData).then((resp)=>{
		if(resp.data.stat == true){
			self.user.id  = resp.data.id;
			resp.data.data.roles = [];
			_.each(self.user.roles, function(role){
					var id = parseInt(role);
					if(id == 5){ // in case of educator
							resp.data.data.roles.push({id:id,name:"educator"});
					}
			})

			self.users.push(resp.data.data);
			
			self.modal.modal('hide');
			J.alert({text:"New User Added."});
			J.reset(self.user);
			$("#creat-new-user")[0].reset();
		}else{
			J.alert({text:resp.data.msg,type:"error"});
		}
			
	},(error) => {
		J.log("eoorr"+ error);
	});
}

User.update = function(formData){
		var self  = this;
		var _id = self.cache_user.id;

		this.$http.post(base_url('save-user/'+_id), formData).then((resp)=>{

			var a =  _.find(self.users, {'id':_id});
			a.name = self.user.name;
			a.email = self.user.email;
			a.roles = [];

			_.forEach(self.user.roles, function(role, key) {
			  a.roles.push({"id": parseInt(role)});
			});

			//hide modal
			self.modal.modal('hide');
			J.alert({text:"User Details Saved."});
			J.reset(self.user);
			$("#creat-new-user")[0].reset();

		},(error) => {
			J.log("eoorr"+ error);
		});
}


User.save_now = function(){
	var self = this;
	var formData = new FormData();

  // append string
  formData.append('name', this.user.name );
  formData.append('email', this.user.email);
  formData.append('contact', this.user.contact);
  formData.append('password', this.user.password );
  this.user.roles = _.uniq(this.user.roles);
  formData.append('roles', _.isEmpty(this.user.roles)? null : this.user.roles );

  if(this.cache_user == null){
			this.add_new(formData);
	}else{
			this.update(formData);
			this.cache_user = null;
	}
	
}

User.get_all_users = function(){
	var self = this;
	var url = '';
	if(location.hash == ""){
		 url = base_url('all-users')
	}else{
		url = base_url('all-users/'+location.hash.replace("#",""));
	}
	
	this.$http.get(url).then((resp) => {
    if(resp.data.stat == true){
    	window.role_meta = resp.data.data.role_meta;
    	self.$set('users', resp.data.data.users);
    	self.$set('role_meta', window.role_meta);

    	setTimeout(function(){
			J.set_data_table('#users');
		},1000);
    }
  }, (response) => {
 		J.log(response)
  });

}

User.show_edit_model = function(_user){
	var self = this;
	//show modal
	this.modal.modal('show');

	// set edit values
	this.user.name 	= _user.name;
	this.user.email = _user.email;
	this.user.contact = _user.contact;
	this.user.password = null;
	//this.user.roles 	= _user.roles;
	
	setTimeout(function(){
		self.select_user_roles(_user.roles);
	},500);
	// set role in cache
	this.cache_user = _user;	
}

User.select_user_roles = function(_roles){
	var self = this;
	var _user_roles = [];
	_roles = _.uniq(_roles);
	_.forEach(_roles, function(value, key) {
	  _user_roles.push( parseInt( value.id));
	  self.user.roles.push( parseInt( value.id));
	});

	$("#user_controller").val(_user_roles);
}

User.destory_user= function(_user){
		var self = this
		this.$http.post(base_url('delete-user/' + _user.id)).then((resp)=>{
				self.users.$remove(_user);
				J.alert({text:"User Deleted."});
		},(error) => {
			J.log("eoorr"+ error);
		});
}

User.update_user_status = function(_user){
		var self = this
		this.$http.post(base_url('update-user-status/' + _user.id)).then((resp)=>{
			//return resp.data.data.status;
			return resp;
		},(error) => {
			J.log("eoorr"+ error);
		});
}

User.delete_user = function(_user) {
	if(confirm("Please Confirm to delete.")){
		this.destory_user(_user);
	}
}

User.toggleStatus = function(_user) {
	
	this.update_user_status(_user);

	if(_user.status) {
		_user.status = 0;
	}else {
		_user.status = 1;
	}
}

User.edit_details = function(user){
	var user_role = _.find(user.roles, {name:"educator"});
	if(user_role){
		location.href = base_url('educator/'+user.id+'/edit');
	}
}


// extending search functions
User = Object.assign(User,Search);

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

new J.Vue({
	el: '#manage-user',
	data: {
		users: [],
		role_meta:[],
		user:{
			name:null,
			email:null,			
			contact:null,			
			password:null,			
			roles:[],
			status:null,
			status_text: null,
		},
		cache_user:null,
		modal:$("#saveUserModal"),
		filterBy: "",
    dateRange: {},
    serach_date_range: null
	},
	ready: function() {
		this.get_all_users();
	},
	init: function() {

	},
	methods: User,
 	filters: User.filers_actions(),
  components:{
      'search-panel':SearchPanel
  }
});