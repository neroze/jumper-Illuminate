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
                        <h1 class="error-number">403</h1>
                        <h2>Sorry you do not have permission.</h2>
                        <p> Limited Access Page. <!-- <a href="#">Report this?</a> -->
                        </p>
                        <div class="mid_center">
                           
                            <form>
                                <div class="col-xs-12 form-group pull-right top_search">
                                    <div class="input-group">
                                        <!-- <input type="text" class="form-control" placeholder="Search for..."> -->
                                        <span class="input-group-btn">
               
                            <a class="btn btn-info"  href="{{ url('/') }}">Home</a>
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