<!DOCTYPE html>
<html lang="en">

<!-- BEGIN HEAD -->
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
    <!----------->
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link rel="stylesheet" type="text/css" href="/libs/bootstrap4/css/bootstrap.min.css">
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
        <link rel="stylesheet" type="text/css" href="/assets/styles/widgets/panels.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/styles/profile/social.min.css">

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="/assets/styles/apps/file-manager.min.css">
        <link rel="stylesheet" type="text/css" href="/libs/tablesaw/tablesaw.css">
        <link rel="stylesheet" type="text/css" href="/libs/datatables-net/media/css/dataTables.bootstrap4.min.css"> <!-- original -->
        <link rel="stylesheet" type="text/css" href="/assets/styles/libs/datatables-net/datatables.min.css"> <!-- customization -->

        <link rel="stylesheet" type="text/css" href="/libs/bootstrap-markdown-editor/css/bootstrap-markdown-editor.css"> <!-- original -->
        <link rel="stylesheet" type="text/css" href="/assets/styles/libs/bootstrap-markdown-editor/bootstrap-markdown-editor.min.css"> <!-- customization -->

        <link href="/libs/select2/css/select2.min.css" rel="stylesheet" />

        <script src="/libs/jquery/jquery.min.js"></script>
        <script src="/libs/filtertable/jquery.filtertable.js"></script>
</head>
<!-- END HEAD -->

<body class="ks-page-header-fixed ks-page-loading"> <!-- remove ks-page-header-fixed to unfix header -->
@include('nav2')
@include('notification')
<div class="ks-page-container">
    @yield('content')
</div>


<!-- BEGIN PAGE LEVEL PLUGINS -->
<!--<script src="/libs/jquery/jquery.min.js"></script>-->

<script src="/libs/responsejs/response.min.js"></script>
<script src="/libs/loading-overlay/loadingoverlay.min.js"></script>
<script src="/libs/tether/js/tether.min.js"></script>
<script src="/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="/libs/jscrollpane/jquery.jscrollpane.min.js"></script>
<script src="/libs/jscrollpane/jquery.mousewheel.js"></script>
<script src="/libs/flexibility/flexibility.js"></script>
<script src="/libs/noty/noty.min.js"></script>
<script src="/assets/scripts/custom-file-input.js" type="text/javascript"></script>
<script src="/libs/typeahead/typeahead.bundle.min.js"></script>
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
@if(Route::current()->getName() == 'profile')

    <script>
        function handleFileSelect(evt) {
            var files = evt.target.files;
            f = files[0];
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    var span = document.createElement('span');
                    span.innerHTML = ['<img class="thumb" src="', e.target.result,'" height="150" title="', escape(theFile.name), '"/>'].join('');
                    document.getElementById('img_placeholder').insertBefore(span, null);
                };
            })(f);
            reader.readAsDataURL(f);
        }
        document.getElementById('fileInput').addEventListener('change', handleFileSelect, false);
    </script>


    <script type="text/javascript">
        function selectAll()
        {
            selectBox = document.getElementById("rightValues");

            for (var i = 0; i < selectBox.options.length; i++)
            {
                selectBox.options[i].selected = true;
            }
        }
        document.getElementById('Submit').addEventListener('click', selectAll, false);
    </script>


    <script>
        function handleFileSelect2(evt) {
            var files = evt.target.files;
            f = files[0];
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    var span = document.createElement('span');
                    span.innerHTML = ['<img class="thumb" src="', e.target.result,'" height="100" title="', escape(theFile.name), '"/>'].join('');
                    document.getElementById('avatar_placeholder').insertBefore(span, null);
                };
            })(f);
            reader.readAsDataURL(f);
        }
        document.getElementById('avatarInput').addEventListener('change', handleFileSelect2, false);
    </script>

    <script>
        jQuery(document).ready(function($) {
            // Set the Options for "Bloodhound" suggestion engine
            var engine = new Bloodhound({
                remote: {
                    url: '/find?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            $(".search-input").typeahead({
                hint: true,
                highlight: true,
                minLength: 1,
                limit: 30
            }, {
                source: engine.ttAdapter(),

                // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                name: 'usersList',

                // the key from the array we want to display (name,id,email,etc...)
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown">'
                    ],
                    suggestion: function (data) {
                        //return '<a href="profile/' + data.username+ '" class="list-group-item">' + data.firstname + ' ' + data.lastname+ ' - @' + data.username + '</a>'
                        return '<a href="/profile/' + data.username + '" class="list-group-item"><image src="' + data.gravatar + '" height="30" /> ' + data.lastname + ', ' + data.firstname + ' @' + data.username + '</a></div>'
                    }
                }
            });
        });
    </script>
@endif
@if(Route::current()->getName() == 'colorforecast' || Route::current()->getName() == 'colorreport')
    <script>
        // Find all iframes
        var $iframes = $( "iframe" );

        // Find &#x26; save the aspect ratio for all iframes
        $iframes.each(function () {
            $( this ).data( "ratio", this.height / this.width )
            // Remove the hardcoded width &#x26; height attributes
                .removeAttr( "width" )
                .removeAttr( "height" );
        });

        // Resize the iframes when the window is resized
        $( window ).resize( function () {
            $iframes.each( function() {
                // Get the parent container&#x27;s width
                var width = $( this ).parent().width();
                $( this ).width( width )
                    .height( width * $( this ).data( "ratio" ) );
            });
            // Resize to fix all iframes on page load.
        }).resize();
    </script>
@endif

@if(Route::current()->getName() == 'membersdirectory')
    <script src="/libs/datatables-net/media/js/jquery.dataTables.min.js"></script>
    <script src="/libs/select2/js/select2.min.js"></script>
    <script type="application/javascript">
        (function ($) {
            $(document).ready(function() {
                $('#ks-datatable').DataTable({
                    "initComplete": function () {
                        $('.dataTables_wrapper select').select2({
                            minimumResultsForSearch: Infinity
                        });
                    }
                });
            });
        })(jQuery);
    </script>
@endif

@if(Route::current()->getName() == 'academic')
    <script src="//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js"></script>


    <script>
        $(function() {

            // We can attach the `fileselect` event to all file inputs on the page
            $(document).on('change', ':file', function() {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });

            // We can watch for our custom `fileselect` event like this
            $(document).ready( function() {
                $(':file').on('fileselect', function(event, numFiles, label) {

                    var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;

                    if( input.length ) {
                        input.val(log);
                    } else {
                        if( log ) alert(log);
                    }

                });
            });

        });
    </script>
@endif

<script>
    var items = {};
    $("#addButton").click(function (e) {
        e.preventDefault();
        var selectedItem = $("#leftValues option:selected");
        $("#rightValues").append(selectedItem);
    });

    $("#removeButton").click(function (e) {
        e.preventDefault();
        var selectedItem = $("#rightValues option:selected")

        selectedItem.map(function(item){
            items[item] = selectedItem[item].value;
        });
        $(selectedItem).remove();
    });
</script>

<script>
    $('#hideme').hide();

    $('#toggle').on('click', function (e) {
        e.preventDefault();
        $('#hideme').toggle();
    });
</script>
</body>
</html>