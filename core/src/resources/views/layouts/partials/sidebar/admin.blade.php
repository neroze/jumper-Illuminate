<ul class="nav side-menu">
    <li><a href="/"><i class="fa  fa-trello"></i> Dashboard <span class="fa fa-chevron-down"></span></a>  </li>
    @if( Auth::user()->hasRole('root_admin'))
    <li><a><i class="fa fa-slack"></i> User Roles <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" style="display: none">
            <li><a href="/admin/role-manage">Manage Roles</a>
            </li>
           
        </ul>
    </li> 
    @endif
                       
    <li><a href="/admin/manage-user"><i class="fa fa-user"></i> Manage All Users <span class="fa fa-chevron-down"></span></a>


     <li><a><i class="fa fa-cc-stripe"></i> Manage Orders <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" style="display: none">
            <li><a href="/admin/orders">All Orders</a>
            </li>
           
        </ul>
    </li>

    <!-- <li><a href="{{ url('/admin/manage-educator#educator') }}">
        <i class="fa fa-slideshare"></i> Manage Educator <span class="fa  "></span></a>
    </li> -->

    <li><a><i class="fa fa-slideshare"></i> Manage Educators <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" style="display: none">
            <li><a href="{{ url('/admin/manage-educator#educator') }}">All Educators</a></li>
            <li><a href="{{ url('/admin/educator-credit') }}">Educator Credit</a></li>
            <li><a href="{{ url('/admin/import-educator') }}">Import</a></li>
        </ul>
    </li>


    <!-- <li><a href="{{ url('/admin/manage-educator#coordinator') }}">
        <i class="fa fa-slideshare"></i> Manage Coordinator <span class="fa  "></span></a>
    </li> -->
    <li><a><i class="fa fa-drupal"></i> Manage Childs <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" style="display: none">
            <li><a href="{{ url('/admin/manage-child') }}">All Children</a></li>
            <li><a href="{{ url('/admin/child/create') }}">Add New Children</a></li>
           <li><a href="{{ url('/admin/import-child') }}">Import </a></li>
           
        </ul>
    </li>
    <li><a href="/admin/manage-enrollment" ><i class="fa fa-stack-overflow"></i> Manage Enrollments <span class="fa "></span></a> </li>
    <li><a href="{{ url('/admin/manage-field-visits') }}"><i class="fa  fa-pagelines"></i> Manage Field Visits </span></a></li>
     <li><a href="{{ url('/admin/manage-visit-question') }}"><i class="fa   fa-university"></i> Field Visit review Questions </span></a></li>
    <li><a href="{{ url('/admin/manage-time-sheets') }}"><i class="fa  fa-building"></i> Manage Time Sheets </span></a></li>
   
  
  
</ul>