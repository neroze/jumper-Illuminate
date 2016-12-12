<ul class="nav side-menu">
    <li><a href="/"><i class="fa  fa-trello"></i> Dashboard <span class="fa fa-chevron-down"></span></a>  </li> 
    <li><a href="/educator/profile/{{ Auth::user()->id }}">
        <i class="fa  fa-building-o"></i> Profile <span class="fa fa-chevron-down"></span></a>  
    </li> 
    <li>
        <a href="/educator/assigned-to-coordinator/{{ Auth::user()->id }}">
        <i class="fa fa-drupal"></i> Educators <span class="fa fa-chevron-down"></span></a>  
    </li> 
    <li><a href="{{ url('/coordinator/field-visits') }}"><i class="fa  fa-pagelines"></i> Manage Field Visits </span></a></li>
  
  
</ul>