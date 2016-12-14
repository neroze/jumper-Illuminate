<!DOCTYPE html>
<html lang="en">
@include('jumperCore::layouts.partials.head')

<body id="app" style="opacity: 0" class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="/" class="site_title"><i class="fa fa-paw"></i> <span>FDC!</span></a>
                    </div>
                    <div class="clearfix"></div>
                    @include('jumperCore::layouts.partials.user_profile_card')
                    <br />
                    @include('jumperCore::layouts.partials.sidebar')
                    @include('jumperCore::layouts.partials.footer_buttons')

                </div>
            </div>

           @include('jumperCore::layouts.partials.top_navigation')

                <!-- page content -->
            <div class="right_col" role="main">
