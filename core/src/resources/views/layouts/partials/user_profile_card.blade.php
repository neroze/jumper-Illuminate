<!-- menu prile quick info -->
<div class="profile">
    <div class="profile_pic">
        @if($img = Auth::user()->profile_pic)
             <img class="img-circle profile_img" src="{{ url('uploads/profile_pic/'.$img) }}"
             alt="" />
        @else
            <img src="{{ Jumper::get_gravatar(Auth::user()->email) }}" alt="..." class="img-circle profile_img">
        @endif
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2>{{ (Auth::user())?Auth::user()->name:'' }}</h2>
    </div>
</div>
<!-- /menu prile quick info -->