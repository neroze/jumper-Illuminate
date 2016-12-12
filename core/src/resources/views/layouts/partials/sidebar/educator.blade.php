<ul class="nav side-menu">
    <li><a href="/"><i class="fa  fa-trello"></i> Dashboard <span class="fa fa-chevron-down"></span></a>  </li> 
    <li><a href="/admin/educator/{{ Auth::user()->id }}/edit">
        <i class="fa  fa-building-o"></i> Update Profile Details <span class="fa fa-chevron-down"></span></a>  
    </li> 
    <li>
        <a href="/educator/children/{{ Auth::user()->id }}">
        <i class="fa fa-drupal"></i> Enrollment List <span class="fa fa-chevron-down"></span></a>  
    </li> 
    
</ul>