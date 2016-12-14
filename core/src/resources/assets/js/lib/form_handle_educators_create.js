 jQuery().ready(function() {  
    $
	("#final_step").click(function() {	 
	
	  //lets get the values 	  
	  $("#bizstatus3").change(function() {
	    var active_state= $('#bizstatus3').prop('checked'); 
	     if(active_state)  {
		 biz_status2='YES';
		  $("#businessextrafields2").show();   	
	   }
	   else {
		  biz_status2='NO';
		  $("#businessextrafields2").hide();   	
	   }
	     
     });  
	 
 }); 	
 
     if(biz_status=='YES' &&  expat_status=='YES')  {			 	 		 
     //scnerio 1  clicked expat clicked own business filled out all fields re business 
     if( $('#dti_number').val()!='' || $('#sec_number').val()!='' && $('#company_name').val()!='') {
      //status here 
      status='expat_bigbiz_pending_verification';
				 
   }
}
			 
		if(!error) { 
		
		//first step     
		var origin=$('#origin').val();
		var country_current=$('#country_current').val(); 
		var app_status=$('#app_status').val(); 
		var fb_url=$('#fb_url').val(); 		
		var web_url=$('#web_url').val(); 
		
		//second step  
		var dti_number=$('#dti_number').val(); 	
		var sec_number=$('#sec_number').val(); 		
		var company_name=$('#company_name').val(); 
		var fb_id=$('#fb_id').val(); 
		var member_id=$('#member_id').val(); 
		var from=$('#from').val(); 
		
		//third step
		var fb_name_full=$('#fb_first_name').val(); 
		var fb_first_name=$('#fb_first_name').val(); 	
		var email_add=$('#email_add').val(); 
		var fb_image_url=$('#fb_image_url').val(); 	
		var fb_locale=$('#fb_locale').val(); 
		var fb_dob=$('#fb_dob').val(); 
		
		//fourth step
		var fb_profile_url=$('#fb_profile_url').val();   
		var applicant_name=$('#applicant_name').val();  
		var password1=$('#password1').val(); 
		var password2=$('#password2').val(); 
		
		 
			
	    $(".loading_result").html('<img src="images/spinner.gif" /> Creating Educator please wait...');
		var fd = new FormData();  
		fd.append('file', document.getElementById('file1').files[0]);
		fd.append('file2', document.getElementById('file2').files[0]);
		fd.append('origin', origin);
		fd.append('country_current', country_current);	
		fd.append('app_status', app_status);
		fd.append('company_name', company_name);
		fd.append('dti_number', dti_number);
		fd.append('sec_number', sec_number);	
		fd.append('fb_url', fb_url);
		fd.append('web_url', web_url);
		fd.append('email_add', email_add);
		fd.append('password1', password1);
	    fd.append('member_id', member_id);
		fd.append('applicant_name', applicant_name);
		fd.append('fb_first_name', fb_first_name);
		fd.append('from', from);
		
		$.ajax({
			url: 'includes/create_account.php',
			type: 'POST',
			data: fd,
			processData: false,
			contentType: false,
			success: function(data, textStatus, jqXHR)   {    
	   			 $(".loading_result").hide();
	             $("#").html(data);			  
             }
              
		});    
       }
	});
