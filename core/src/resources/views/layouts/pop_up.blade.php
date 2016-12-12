<!-- save time sheet model -->
<div class="modal fade"  @yield('pop_up_id') tabindex="-1" role="dialog" aria-labelledby="" >
  <div class="modal-dialog" role="document">
    	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">@yield('pop_up_title')</h4>
	      </div>
      	<div class="modal-body">
        	@yield('pop_up_content')
        </div>

      
	      <div class="modal-footer">
	     	 @yield('pop_up_footer')
	       <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary"  v-on:click="save_now()">Save changes </button> -->
	      </div>
    </div>
  </div>
</div>   
