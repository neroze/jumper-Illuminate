  <!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <h3>Dashboard</h3>


        @if( Auth::user()->hasRole('root_admin') || Auth::user()->hasRole('admin'))
            @include('jumperCore::layouts.partials.sidebar.admin')
        @endif


    </div>
</div>