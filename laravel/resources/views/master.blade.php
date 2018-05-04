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
    <title>Color Marketing Group</title>

    <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="/libs/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/fonts/line-awesome/css/line-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="/libs/tether/css/tether.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/common.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/pages/auth.min.css">

    <link rel="stylesheet" href="/assets/styles/custom.min.css" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="/assets/fonts/montserrat/styles.css">
    <link rel="stylesheet" type="text/css" href="/libs/jscrollpane/jquery.jscrollpane.css">
    <link rel="stylesheet" type="text/css" href="/libs/flag-icon-css/css/flag-icon.min.css">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" type="text/css" href="/assets/styles/themes/primary.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/profile/settings.min.css">
    <!-- END THEME STYLES -->

    <link rel="stylesheet" type="text/css" href="/assets/styles/widgets/panels.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/profile/social.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/libs/bootstrap-notify/bootstrap-notify.min.css">

    <link rel="stylesheet" type="text/css" href="/assets/styles/pricing/plans.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.css" />

    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="/libs/select2/css/select2.min.css" rel="stylesheet" />
    <!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">-->

    <script src="/libs/jquery/jquery.min.js"></script>
    <script src="/libs/select2/js/select2.min.js"></script>

    <script src="libs/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="/libs/velocity/velocity.min.js"></script>
@if(Route::current()->getName() == 'login')
        <link rel="stylesheet" type="text/css" href="/assets/styles/login2.css">
@endif
</head>
<body class="newlogin">
@if(Route::current()->getName() == 'home')
    @include('nav2')
    @include('notification')
@endif

    @yield('content')
    <script>
        $('#hiddenInput3').hide();
        $('#compindustrySelect').on('change', function(){
            if( $('#compindustrySelect').val() == 'other'){
                $('#hiddenInput3').show()
            }else{
                $('#hiddenInput3').hide();
            }
        });
        $('#hiddenInput2').hide();
        $('#industrySelect').on('change', function(){
            if( $('#industrySelect').val() == 'other'){
                $('#hiddenInput2').show()
            }else{
                $('#hiddenInput2').hide();
            }
        });

        $('#hiddenInput1').hide();
        $('#positionSelect').on('change', function(){
            if( $('#positionSelect').val() == 'other'){
                $('#hiddenInput1').show()
            }else{
                $('#hiddenInput1').hide();
            }
        });
    </script>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/libs/responsejs/response.min.js"></script>
<script src="/libs/tether/js/tether.min.js"></script>
<script src="/libs/bootstrap4/js/bootstrap.bundle.min.js"></script>
<script src="/libs/flexibility/flexibility.js"></script>
<script src="/assets/scripts/custom-file-input.js" type="text/javascript"></script>
    <script src="/libs/typeahead/typeahead.bundle.min.js"></script>

<!--<script src="/libs/listbox_members-TGH.js"></script>-->

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/assets/scripts/common.min.js"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<script>
    $(document).ready(function(){
        var animTime = 300,
            clickPolice = false;

        $(document).on('touchstart click', '.acc-btn', function(){
            if(!clickPolice){
                clickPolice = true;

                var currIndex = $(this).index('.acc-btn'),
                    targetHeight = $('.acc-content-inner').eq(currIndex).outerHeight();

                $('.acc-btn h1').removeClass('selected');
                $(this).find('h1').addClass('selected');

                $('.acc-content').stop().animate({ height: 0 }, animTime);
                $('.acc-content').eq(currIndex).stop().animate({ height: targetHeight }, animTime);

                setTimeout(function(){ clickPolice = false; }, animTime);
            }

        });

    });
</script>

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
    })(JQuery);
</script>

    @if(Route::current()->getName() == 'register')
        <script>
            $(document).ready(function() {
            var max_fields      = 10; //maximum input boxes allowed
            var wrapper         = $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID
            var x               = 2; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    var fields          = '<div><div class="form-group row">\
                    <div class="col-lg-6 col-md-6 col-sm-6">\
                    <span class="req">*</span><label>First Name:</label>\
                        <input type="text" class="form-control" placeholder="First name" name="firstname'+x+'" value="" required>\
                    </div>\
                    <div class="col-lg-6 col-md-6 col-sm-6">\
                    <span class="req">*</span><label>Last Name:</label>\
                        <input type="text" class="form-control" placeholder="Last name" name="lastname'+x+'" value="" required>\
                    </div>\
                    </div>\
                    <div class="form-group">\
                        <div class="col-lg-12 col-md-12 col-sm-12">\
                        <span class="req">*</span><label>Username:</label>\
                        <input type="text" class="form-control" placeholder="Username" name="username'+x+'" value="" required>\
                        </div>\
                        </div>\
                        <div class="form-group">\
                        <div class="col-lg-12 col-md-12 col-sm-12">\
                        <span class="req">*</span><label>Email:</label>\
                        <input type="text" class="form-control" placeholder="Email" name="email'+x+'" value="" required>\
                        </div>\
                        </div>\
                        <div class="form-group">\
                        <div class="col-lg-12 col-md-12 col-sm-12">\
                        <span class="req">*</span><label>Password:</label>\
                        <input type="password" class="form-control" placeholder="Password" name="password'+x+'" required>\
                        </div>\
                        </div>\
                        <a href="#" class="remove_field"><button class="btn btn-danger">Remove</button></a><div>&nbsp;</div></div>';
                    $(wrapper).append(fields); //add input box
                }
                document.getElementById("totalReps").value = x;
            });
            document.getElementById("totalReps").value = x;

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
                $('#totalReps').val(x);
            })
            });
        </script>

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

            //# sourceURL=pen.js
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
        //# sourceURL=pen.js
    </script>
@endif
@if(Route::current()->getName() == 'login')
<script type="text/javascript">
    var image = new Array ();
    image[0] = "http://placehold.it/20";
    image[1] = "http://placehold.it/30";
    image[2] = "http://placehold.it/40";
    image[3] = "http://placehold.it/50";
    var size = image.length
    var x = Math.floor(size*Math.random());

    $('#random').attr('src',image[x]);
</script>
@endif

<script>
    $('.selectpicker').select2({
        width:300
    });
</script>

<script>
    $('#section2').on('click', function(){
        $('#section1 :checkbox:enabled').prop('checked', false);
    });

    $('#section1').on('click', function(){
        $('#section2 :checkbox:enabled').prop('checked', false);
    });

    $('#section3').on('click', function(){
        $('#section4 :checkbox:enabled').prop('checked', false);
    });

    $('#section4').on('click', function(){
        $('#section3 :checkbox:enabled').prop('checked', false);
    });
</script>
<script>
    $('.carousel').carousel({
        interval: 1000 * 10
    });
</script>

</body>
</html>