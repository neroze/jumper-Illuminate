<!DOCTYPE html>
<html lang="en">
@include('jumperCore::layouts.partials.head')
<body class="nav-md">

    <div class="container body">

        <div class="main_container">

            <!-- page content -->
            <div class="col-md-12">
                <div class="col-middle">
                    <div class="text-center text-center">
                        <h1 class="error-number">Please Add Subscription to your acoount</h1>
                        <!-- <h1>Please check your email  <span style="font-size: 30px;">OR</span> Contact FDC team</h1> -->
                        <p>
                           <h3>Your account is not active. <br> Please add Subscription or contact {{ config('app.name', 'FDC APP') }} team.</h3>
                        </p>
                        <div class="mid_center">
                         
                             <a class="btn btn-success"  href="{{ url('/admin/user/account') }}">Add Subscription</a>
                             <a class="btn btn-info"  href="{{ url('/logout') }}"> <i class="fa fa-sign-out"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

        </div>
        <!-- footer content -->
    </div>

   
    <!-- /footer content -->
</body>
@include('jumperCore::layouts.partials.footer')