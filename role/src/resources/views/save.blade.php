<div class="modal fade" id="saveRoleModal" tabindex="-1" role="dialog" aria-labelledby="">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">User Role / from jumper </h4>
      </div>
      <div class="modal-body">
        <form id="save_role_modal">
				  <div class="form-group">
				    <label for="name"  >Name</label>
				    <input type="text" class="form-control" id="name" v-model="role.name" name="name" placeholder="Name">
				  </div>
				  <div class="form-group">
				    <label for="display_name">Display Name</label>
				    <input type="text" class="form-control" id="display_name" v-model="role.display_name" name="display_name" placeholder="Display Name">
				  </div>
				  <div class="form-group">
				    <label for="description">Description</label>
				    <textarea class="form-control" name="description" id="description" v-model="role.description" name="description" rows="3"></textarea>
				  </div>
				</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  v-on:click="save_now()">Save changes </button>
      </div>
    </div>
  </div>
</div>