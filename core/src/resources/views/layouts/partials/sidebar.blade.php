  <!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <h3>Dashboard</h3>


        @if( Auth::user()->hasRole('root_admin') || Auth::user()->hasRole('admin'))
            @include('layouts.partials.sidebar.admin')
        @elseif( Auth::user()->hasRole('company') || Auth::user()->hasRole('company_admin') )
             @include('layouts.partials.sidebar.company') 
        @elseif( Auth::user()->hasRole('coordinator') )
             @include('layouts.partials.sidebar.coordinator')
        @elseif( Auth::user()->hasRole('educator') )
             @include('layouts.partials.sidebar.educator')
        @endif


    </div>
</div>