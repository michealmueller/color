
<!DOCTYPE html>
<html lang="en">

<!-- BEGIN HEAD -->
<head>
    <!-- Hotjar Tracking Code for http://members.colormarketing.org -->
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
    <title>Color Marketing Group - Admin</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" href="/libs/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="/libs/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="/assets/fonts/line-awesome/css/line-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="/assets/styles/themes/primary.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/profile/settings.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/widgets/panels.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/widgets/panels.min.css">
    <link rel="stylesheet" type="text/css" href="/libs/izi-modal/css/iziModal.min.css">


    <link rel="stylesheet" type="text/css" href="/assets/styles/apps/projects/grid-board.min.css">

    <link rel="stylesheet" type="text/css" href="/libs/tether/css/tether.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/common.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/custom.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/fonts/kosmo/styles.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/libs/bootstrap-notify/bootstrap-notify.min.css">

    <link href="/libs/select2/css/select2.min.css" rel="stylesheet" />

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME STYLES -->

    <link class="ks-sidebar-dark-style" rel="stylesheet" type="text/css" href="/assets/styles/themes/sidebar-black.min.css">
    <link rel="stylesheet" type="text/css" href="/libs/plyr/plyr.css">



    <script src="/libs/jquery/jquery.min.js"></script>
    <script src="/libs/filtertable/jquery.filtertable.js"></script>
    <script src="/libs/izi-modal/js/iziModal.min.js"></script>
    <script src="/libs/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="/libs/velocity/velocity.min.js"></script>

</head>
<!-- END HEAD -->

<body class="ks-sidebar-default ks-theme-primary ks-page-loading" style="padding-top: 0"> <!-- remove ks-page-header-fixed to unfix header -->

<div class="ks-page-container">
    @include('admin.nav')
    @include('notification')
    @if(Route::current()->getName() != 'adminprofile')
        @include('admin.blocknav')
    @endif
    @yield('content')

</div>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
@if(\Session::has('userData'))
@php
    $userData = \Session::get('userData')[0]
@endphp
<div id="ks-izi-modal-warning" class="iziModal" data-izimodal-fullscreen="true" data-izimodal-title="That User has an account "
     data-izimodal-subtitle="Please choose the correct one below."
     data-izimodal-icon="la la-home" data-izimodal-padding="20" data-izimodal-autoopen="false" data-izimodal-headercolor="#debb0c"
     aria-hidden="true" aria-labelledby="ks-izi-modal-warning" role="dialog" style="border-bottom: 3px solid rgb(222, 187, 12); z-index: 999; border-radius: 3px; margin-left:
     -300px; max-width: 800px; display: none;">
    <div class="iziModal-wrap" style="height: auto;">
        <div class="iziModal-content" style="padding: 20px;">
            <table class="table table-hover">

                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tr>
                    <td>{{ $userData->id }}</td>
                    <td>{{ $userData->firstname }} {{ $userData->lastname }}</td>
                    <td>{{ $userData->username }}</td>
                    <!--<td>{{ $userData->email }}</td>-->
                    <td>
                        <form method="post" action="/admin/companies/addmember">
                            {{ csrf_field() }}
                            <input type="hidden" name="form" value="addselected">
                            <input type="hidden" name="user_id" value="{{ $userData->id }}">
                            <input type="hidden" name="company_id" value="{{ session()->get('company_id') }}">
                            <button class="btn btn-primary btn-sm">Select</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
    {{ session()->forget('userData') }}
    {{ session()->forget('company_id') }}
@endif
        <!--<script src="libs/jquery/jquery.min.js"></script>-->


        <script src="/libs/bootstrap4/js/bootstrap.bundle.min.js"></script>
        <script src="/libs/filtertable/jquery.filtertable.js"></script>
        <script src="/libs/select2/js/select2.min.js"></script>

        <script src="/libs/responsejs/response.min.js"></script>
        <script src="/libs/loading-overlay/loadingoverlay.min.js"></script>
        <script src="/libs/tether/js/tether.min.js"></script>

        <script src="/libs/jscrollpane/jquery.jscrollpane.min.js"></script>
        <script src="/libs/jscrollpane/jquery.mousewheel.js"></script>
        <script src="/libs/flexibility/flexibility.js"></script>

        <script src="/libs/jquery-file-upload/js/load-image.all.min.js"></script>
        <script src="/libs/jquery-file-upload/js/canvas-to-blob.min.js"></script>
        <script src="/libs/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
        <script src="/libs/jquery-file-upload/js/jquery.iframe-transport.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="/assets/scripts/common.min.js"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
@if(Route::current()->getName() == 'directory')
    <script src="/libs/datatables-net/media/js/jquery.dataTables.min.js"></script>


    <script src="/libs/jquery-confirm/jquery-confirm.min.js"></script>
    <!--TABLESAW -->
    <script src="/libs/tablesaw/tablesaw.js"></script>
    <script src="/libs/tablesaw/tablesaw-init.js"></script>
    <!-- END TABLESAW-->
@endif
<script type="application/javascript">
    (function ($) {
        $(document).ready(function() {
            $('.selectpicker').select2({
                placeholder: 'Select an Option',
                dropdownAutoWidth : true,
                width: '100%'
            })
        });
    })(jQuery);
</script>
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
@if(Route::current()->getName() == 'adminprofile' )
    <script src="/libs/jquery-confirm/jquery-confirm.min.js"></script>
    <script type="application/javascript">
        (function ($) {
            $(document).ready(function () {
                // background dismiss
                $('.activateAlert').on('click', function () {
                    $.alert({
                        title: 'Account Activation',
                        content: '{{ $data['member']->firstname }}\'s account will be reactivated.',
                        animation: 'top',
                        closeAnimation: 'bottom',
                        backgroundDismiss: true,
                        buttons: {
                            okay: {
                                text: 'okay',
                                btnClass: 'btn-info',
                                action: function () {
                                    $('form#activate').submit();
                                }
                            }
                        }
                    });
                });

                $('.deactivateAlert').on('click', function () {
                    $.alert({
                        title: 'Account Deactivation',
                        content: '{{ $data['member']->firstname }}\'s account will be deactivated.',
                        animation: 'top',
                        closeAnimation: 'bottom',
                        backgroundDismiss: true,
                        buttons: {
                            okay: {
                                text: 'okay',
                                btnClass: 'btn-info',
                                action: function () {
                                    $('form#deactivate').submit();
                                }
                            }
                        }
                    });
                });

                // auto close
                $('.terminateAlert').on('click', function () {
                    $.confirm({
                        title: 'Are You Sure?',
                        content: 'This will permanently delete this users account...',
                        autoClose: 'cancelAction|10000',
                        escapeKey: 'cancelAction',
                        buttons: {
                            confirm: {
                                btnClass: 'btn-danger',
                                text: 'Delete {{ $data['member']->firstname }}\'s account',
                                action: function () {
                                    $('form#terminate').submit();
                                }
                            },
                            cancelAction: {
                                text: 'Cancel',
                                backgroundDismiss: true,
                                action: function () {
                                    //do something.
                                }
                            }
                        }
                    });
                });

                $('.removeMemberAlert').on('click', function () {
                    $.confirm({
                        title: 'Are You Sure?',
                        content: 'This will remove this member from there company....',
                        autoClose: 'cancelAction|10000',
                        escapeKey: 'cancelAction',
                        buttons: {
                            confirm: {
                                btnClass: 'btn-danger',
                                text: 'Remove s From Company ',
                                action: function () {
                                    $('form#terminate').submit();
                                }
                            },
                            cancelAction: {
                                text: 'Cancel',
                                backgroundDismiss: true,
                                action: function () {
                                    //do something.
                                }
                            }
                        }
                    });
                });
            });
        })(jQuery);
    </script>

    <script src="/libs/summmernote/summernote.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>

@endif

@if(Route::current()->getName() == 'profileadvert')
    <script src="//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js"></script>
    <script>
        function handleFileSelect(evt) {
            var files = evt.target.files;
            f = files[0];
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    var span = document.createElement('span');
                    span.innerHTML = ['<img class="thumb" src="', e.target.result,'" height="100" title="', escape(theFile.name), '"/>'].join('');
                    document.getElementById('advert_placeholder').insertBefore(span, null);
                };
            })(f);
            reader.readAsDataURL(f);
        }

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
        document.getElementById('advertInput').addEventListener('change', handleFileSelect, false);
    </script>
@endif

<script src="//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js"></script>
<script>
    function handleFileSelect(evt) {
        var files = evt.target.files;
        f = files[0];
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                var span = document.createElement('span');
                span.innerHTML = ['<img class="thumb" src="', e.target.result,'" height="100" title="', escape(theFile.name), '"/>'].join('');
                document.getElementById('feature_placeholder').insertBefore(span, null);
            };
        })(f);
        reader.readAsDataURL(f);
    }

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
    document.getElementById('featureInput').addEventListener('change', handleFileSelect, false);
</script>
@if(Route::current()->getName() == 'companyedit')
<script>
    var items = {};
    $("#removeButton").click(function (e) {
        e.preventDefault();
        var selectedItem = $("#rightValues option:selected");

        selectedItem.map(function(item){
            items[item] = selectedItem[item].value;
        });
        $(selectedItem).remove();
    });
</script>
@endif
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
            limit: 30,
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
                    //return '<a href="/profile/' + data.username + '" class="list-group-item"><image src="' + data.gravatar + '" height="30" /> ' + data.lastname + ', ' + data.firstname + ' @' + data.username + '</a></div>'
                    selectBox = document.getElementById("members");
                    selectBox.append('<option value="data.id">data.firstname data.lastname</option>')
                }
            }
        });
    });
</script>

<script>
    $('.addButton').click(function (e) {
        e.preventDefault();
        var selectedItem = $("#leftValues option:selected");
        console.log(selectedItem);
        $('div.inputRow').append("<div class='form-group bordered row'>" +
            "<label>Member Number:</label>"+
            "<input class='form-control' type='hidden' name='user_id[]' value='"+selectedItem[0].value+"'>" +
            "<label>Amount Paid:</label>"+
            "<input class='form-control' type='text' name='amount_paid[]' placeholder='Amount Paid'>" +
            "<label>Payment Date:</label>" +
            "<input class='form-control' type='text' name='payment_date[]' placeholder='yyyy-mm-dd'>" +
            "</div>"
        );
    });
</script>
<script type="application/javascript">
    (function ($) {
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        });
    })(jQuery);
</script>

<script>
    $('#section2').on('click', function(){
        $('#section1 :checkbox:enabled').prop('checked', false);
    });

    $('#section1').on('click', function(){
        $('#section2 :checkbox:enabled').prop('checked', false);
    });
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
    document.getElementById('updateMembers').addEventListener('click', selectAll, false);
</script>
</body>
</html>