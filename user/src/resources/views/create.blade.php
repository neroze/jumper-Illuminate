<div class="modal fade" id="saveUserModal" tabindex="-1" role="dialog" aria-labelledby="">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">User Details</h4>
      </div>
      <div class="modal-body">
        <form class="fieldset-form" id="creat-new-user" method="post" action="">
        	{{ csrf_field() }}
          <fieldset>
           
            <div class="form-group">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" name="name" v-model="user.name" value="" >
            </div>
            <div class="form-group">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" v-model="user.email" value="" >
            </div>
       
            <div class="form-group">
              <label for="password" class="form-label">Password</label>
               <input type="password" class="form-control" name="password" id="password" v-model="user.password" value="" >
            </div>

            <div class="form-group">
            	<label for="password" class="form-label">Contact</label>
            	 <input type="text" class="form-control" v-model="user.contact" name="contact" id="contact" value="" >
            </div>

            <div class="form-group">
            	<label for="role" class="form-label">Role</label> <br>
            		<select v-model="user.roles" multiple id="user_controller"  class="form-control">
								  <option :id="role.name" :value="role.id"  v-for="(index, role)  in role_meta">@{{ role.display_name}}</option>
								</select>
            		
            </div>
          
           
          </fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  v-on:click="save_now()">Save changes </button>
      </div>
    </div>
  </div>
</div>		    