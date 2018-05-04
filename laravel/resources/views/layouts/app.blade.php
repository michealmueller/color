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
        <title>{{ $data['user']->firstname }}'s Profile, Color Marketing Group</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link rel="stylesheet" type="text/css" href="/libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/fonts/line-awesome/css/line-awesome.min.css">
        <!--<link rel="stylesheet" type="text/css" href="assets/fonts/open-sans/styles.css">-->

        <link rel="stylesheet" type="text/css" href="/assets/fonts/montserrat/styles.css">

        <link rel="stylesheet" type="text/css" href="/libs/tether/css/tether.min.css">
        <link rel="stylesheet" type="text/css" href="/libs/jscrollpane/jquery.jscrollpane.css">
        <link rel="stylesheet" type="text/css" href="/libs/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/styles/common.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/styles/custom.min.css">
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN THEME STYLES -->
        <link rel="stylesheet" type="text/css" href="/assets/styles/themes/primary.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/styles/profile/settings.min.css">
        <!-- END THEME STYLES -->

        <link rel="stylesheet" type="text/css" href="/libs/plyr/plyr.css">
        <link rel="stylesheet" type="text/css" href="/assets/styles/widgets/panels.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/styles/profile/social.min.css">

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="/assets/styles/apps/file-manager.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="/libs/bootstrap-markdown-editor/css/bootstrap-markdown-editor.css"> <!-- original -->
        <link rel="stylesheet" type="text/css" href="/assets/styles/libs/bootstrap-markdown-editor/bootstrap-markdown-editor.min.css"> <!-- customization -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.1/croppie.min.css" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
        <script src="/libs/filtertable/jquery.filtertable.js"></script>
    @yield('css')
</head>
<body class="ks-page-header-fixed ks-page-loading" style="padding-top: 150px;">
    @include('nav2')
    @yield('content')

</body>
<script src="/js/app.js"></script>
@yield('js')
<script src="/libs/responsejs/response.min.js"></script>
<script src="/libs/loading-overlay/loadingoverlay.min.js"></script>
<script src="/libs/tether/js/tether.min.js"></script>
<script src="/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="/libs/jscrollpane/jquery.jscrollpane.min.js"></script>
<script src="/libs/jscrollpane/jquery.mousewheel.js"></script>
<script src="/libs/flexibility/flexibility.js"></script>
<script src="/libs/noty/noty.min.js"></script>
<script src="/assets/scripts/custom-file-input.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="/libs/velocity/velocity.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!--TABLESAW -->
<script src="/libs/tablesaw/tablesaw.js"></script>
<script src="/libs/tablesaw/tablesaw-init.js"></script>
<!-- END TABLESAW-->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/assets/scripts/common.min.js"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<script src="/libs/plyr/plyr.js"></script>
<script type="application/javascript">
    (function ($) {
        $(document).ready(function () {
            plyr.setup();

            $('[data-toggle="tooltip"]').tooltip({
                delay: {
                    show: 500
                }
            });
        });
    })(jQuery);
</script>
<script type="application/javascript">
    (function($){
        $("a[data-toggle]").on("click", function(e) {
            e.preventDefault();  // prevent navigating
            var selector = $(this).data("toggle");  // get corresponding selector from data-toggle
            $(selector).slideToggle();
        });
    })(jQuery);
</script>
<script src="/js/app.js"></script>
@yield('js')
</html>
