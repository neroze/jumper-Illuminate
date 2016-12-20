<ul class="nav side-menu">
    <li><a href="/"><i class="fa  fa-trello"></i> Dashboard <span class="fa fa-chevron-down"></span></a>  </li>
    @if( Auth::user()->hasRole('root_admin'))
    <li><a><i class="fa fa-slack"></i> User Roles <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" style="display: none">
            <li><a href="/{{ env('APP_PREFIX')}}/role-manage">Manage Roles</a>
            </li>
           
        </ul>
    </li> 
    @endif
                       
    <li><a href="/{{ env('APP_PREFIX')}}/manage-user"><i class="fa fa-user"></i> Manage All Users <span class="fa fa-chevron-down"></span></a>
    <!-- <li><a href="{{ url('/admin/manage-time-sheets') }}"><i class="fa  fa-building"></i> Manage Time Sheets </span></a></li> -->
   
  
  
</ul>