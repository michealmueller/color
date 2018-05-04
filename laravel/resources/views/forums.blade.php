<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Hotjar Tracking Code for http://members.colormarketing.co -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:665620,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <meta charset="UTF-8">
    <title>Color Marketing - Chatter</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="/assets/styles/reset.min.css">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" href="/libs/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/fonts/line-awesome/css/line-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="assets/fonts/open-sans/styles.css">
    <link rel="stylesheet" type="text/css" href="/assets/fonts/montserrat/styles.css">

    <link rel="stylesheet" type="text/css" href="/libs/tether/css/tether.min.css">

    <link rel="stylesheet" type="text/css" href="/assets/styles/themes/primary.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/profile/settings.min.css">

    <link rel="stylesheet" type="text/css" href="/assets/styles/common.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/custom.min.css">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME STYLES -->
    <!-- END THEME STYLES -->

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

@yield('css')
    <script src="/libs/jquery/jquery.min.js"></script>
    <script src="/libs/bootstrap4/js/bootstrap.bundle.min.js"></script>
    <script src="/libs/filtertable/jquery.filtertable.js"></script>



</head>
<body class="ks-page-header-fixed ks-page-loading" style="padding-top: 50px;">
@include('nav2')
@yield('content')
</body>
<script src="/libs/responsejs/response.min.js"></script>
<script src="/libs/loading-overlay/loadingoverlay.min.js"></script>
<script src="/libs/tether/js/tether.min.js"></script>
@yield('js')
</html>