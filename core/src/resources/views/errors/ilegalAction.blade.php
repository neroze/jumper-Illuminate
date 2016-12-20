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
                        <h1 class="error-number red"> <i class="fa fa-warning"></i> Warning</h1>
                        <!-- <h1>Please check your email  <span style="font-size: 30px;">OR</span> Contact FDC team</h1> -->
                        <p>
                           <h3 class="red">Ilegal Action Attempted,Your Action has been reported to Admin. Please do not try this again.</h3>
                        </p>
                        <div class="mid_center">
                         
                            <form>
                                <div class="col-xs-12 form-group pull-right top_search">
                                    <div class="input-group">
                                        <!-- <input type="text" class="form-control" placeholder="Search for..."> -->
                                        <span class="input-group-btn">
               
                            <a class="btn btn-info"  href="{{ url('/') }}">Home</a>
                            <!-- <a class="btn btn-success"  href="{{ url('/logout') }}">Logout</a> -->
                        </span>
                                    </div>
                                </div>
                            </form>
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