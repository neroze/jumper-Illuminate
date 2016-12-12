<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FDC APP') }}</title>
      <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- Bootstrap core CSS -->

    <link data-url="{{ url('/') }}" href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ url('/fonts/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('/css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{ url('/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/maps/jquery-jvectormap-2.0.3.css') }}" />
    <link href="{{ url('/css/icheck/flat/green.css') }}" rel="stylesheet">
    <link href="{{ url('/css/floatexamples.css') }}" rel="stylesheet" />
    <link href="{{ url('/css/icheck/flat/green.css') }}" rel="stylesheet" />

    <!-- Custom styling plus plugins -->
    <link href="{{ url('css/datatables/tools/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link href="{{ url('bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/progressbar/bootstrap-progressbar-3.3.0.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

     <link href="{{ url('/css/dropzone.css') }}" rel="stylesheet" />



     <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    <!-- Scripts -->
    @yield('headerScript')
</head>