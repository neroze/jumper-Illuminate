
$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            }
        });

var _location = location.href;
if(_location.search('role-manage') > 0){
	require('./app/user_role_raw/role.js');
}
else if(_location.search('manage-user') > 0){
	require('./app/user_raw/user.js');
}
else if(_location.search("register") > 0){
	//require('./app/auth/register.js');
}

else{
	if(location.hash == ""){
		require('./app/dashboard_raw/role_with_users.js');
		require('./app/dashboard_raw/enrollments.js');
		require('./app/dashboard_raw/users_status.js');
		require('./app/dashboard_raw/dashboard.js');
	
	}
}




