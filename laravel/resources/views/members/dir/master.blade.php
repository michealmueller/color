<!DOCTYPE html>
<html lang="en">

<!-- BEGIN HEAD -->
<head>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <!--<link rel="stylesheet" type="text/css" href="/libs/bootstrap/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="/libs/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/fonts/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/fonts/montserrat/styles.css">

    <link rel="stylesheet" type="text/css" href="/libs/tether/css/tether.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/common.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/custom.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/uikit/cards.min.css">
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" type="text/css" href="/assets/styles/themes/primary.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/profile/settings.min.css">
    <!-- END THEME STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" type="text/css" href="/assets/styles/app.css">
    <!-- END THEME STYLES -->

    <link rel="stylesheet" type="text/css" href="/libs/plyr/plyr.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/widgets/panels.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/dashboard/mail.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/profile/social.min.css">

    <link rel="stylesheet" type="text/css" href="/assets/styles/apps/file-manager.min.css">
    <link rel="stylesheet" type="text/css" href="/libs/tablesaw/tablesaw.css">
    <link rel="stylesheet" type="text/css" href="/libs/datatables-net/media/css/dataTables.bootstrap4.min.css"> <!-- original -->
    <link rel="stylesheet" type="text/css" href="/assets/styles/libs/datatables-net/datatables.min.css"> <!-- customization -->

    <link href="/libs/select2/css/select2.min.css" rel="stylesheet" />
    <!--ZURB Table Responsive -->
    <!--END-->

    <script src="/libs/jquery/jquery.min.js"></script>

    <script src="/libs/filtertable/jquery.filtertable.js"></script>
</head>

<body class="ks-page-header-fixed ks-page-loading"> <!-- remove ks-page-header-fixed to unfix header -->
@include('nav2')
<div class="ks-page-container">
    @yield('content')
</div>
<script>
    $(document).ready(function() {
        $('#toggleForm').on('click', function (e) {
            e.preventDefault();
            $('#hideme').toggle('slow');
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

<script src="/assets/scripts/popper.min.js"></script>
<script src="/libs/bootstrap4/js/bootstrap.js"></script>
<script src="/libs/responsejs/response.min.js"></script>
<script src="/libs/loading-overlay/loadingoverlay.min.js"></script>
<script src="/libs/tether/js/tether.min.js"></script>
<script src="/libs/typeahead/typeahead.bundle.min.js"></script>
<script src="/libs/select2/js/select2.min.js"></script>
<script src="/libs/velocity/velocity.min.js"></script>
<script src="/libs/tablesaw/tablesaw.js"></script>
<script src="/libs/tablesaw/tablesaw-init.js"></script>

<script src="/libs/plyr/plyr.js"></script>

<script src="/libs/datatables-net/media/js/jquery.dataTables.min.js"></script>
<script src="/libs/datatables-net/media/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/scripts/common.min.js"></script>



<script type="application/javascript">
    $(document).ready(function() {
        $('.ks-update').on('click', function() {
            var card = $(this).closest('.card');

            card.LoadingOverlay("show", {
                image: "",
                custom: $("<div>", {
                    text: 'Loading...'
                }),
                color: "rgba(255, 255, 255, 0.6)",
                zIndex: 2
            });

            setTimeout(function() {
                card.LoadingOverlay("hide");
            }, 2000);
        });
    });
</script>

<script type="application/javascript">
    (function ($) {
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            $('.selectpicker').select2({
                placeholder: 'Select an Option'
            })
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

@yield('javascript')

</body>
</html>