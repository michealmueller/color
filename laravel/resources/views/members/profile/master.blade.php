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
    <title>{{ $data['user']->firstname }}'s Profile, Color Marketing Group</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="/libs/bootstrap4/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" type="text/css" href="/libs/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/fonts/line-awesome/css/line-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="assets/fonts/open-sans/styles.css">
    <link rel="stylesheet" type="text/css" href="/assets/fonts/montserrat/styles.css">

    <link rel="stylesheet" type="text/css" href="/libs/tether/css/tether.min.css">
    <link rel="stylesheet" type="text/css" href="/libs/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/common.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/custom.min.css">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" type="text/css" href="/assets/styles/themes/primary.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/profile/settings.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/libs/bootstrap-notify/bootstrap-notify.min.css">
    <!-- END THEME STYLES -->


    <link rel="stylesheet" type="text/css" href="/assets/styles/widgets/panels.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/profile/social.min.css">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="/assets/styles/apps/file-manager.min.css">
    <link href="/libs/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.1/croppie.min.css" />

    <script src="/libs/jquery/jquery.min.js"></script>

    <script src="/libs/tether/js/tether.min.js"></script>
    <script src="/libs/bootstrap4/js/bootstrap.bundle.min.js"></script>
    <script src="/libs/filtertable/jquery.filtertable.js"></script>
    <script src="libs/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="/libs/velocity/velocity.min.js"></script>
    <style>
        body{
            height:min-content;
            padding-bottom: 50px;
            padding-top: 90px;
            font-family: "Helvetica", "Open Sans";!important;!important;
            font-size:1rem;!important;!important;
        }
        .tab-content .ks-body {
            margin: 0px !important;
            padding: 0px !important;
        }
    </style>
</head>
<!-- END HEAD -->

<body class="ks-page-header-fixed ks-page-loading"> <!-- remove ks-page-header-fixed to unfix header -->
<!--include('members.profile.nav')-->
@include('nav2')
@include('notification')
@if(Route::current()->getName() == 'membersdirectory' || Route::current()->getName() == 'memberfiles')
    <div class="ks-page-container">
        @endif


        @yield('content')


        @if(Route::current()->getName() == 'memberdirectory' || Route::current()->getName() == 'memberfiles')
    </div>
@endif
<!-- BEGIN BOOTSTRAP MODELS-->
<div class="modal fade bd-example-modal-lg-followers" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Who is following you</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-close"></span>
                </button>
            </div>
            <div class="modal-body">
                @if(isset($data['numFollowers']) && $data['numFollowers'] > 0)
                    <table>
                        @foreach($data['followerList'] as $follower)
                            <tr>
                                <td><img width="50" src="{{ $follower->gravatar }}"></td>
                                <td><a href="/profile/{{ $follower->username }}">{{ $follower->firstname }} {{ $follower->lastname }}</a></td>
                                <td><a href="/follow/{{ $follower->id }}"><button class="btn btn-sm btn-info">Follow</button></a></td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <div>No one is following you</div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary-outline ks-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg-following" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Who you are Following</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-close"></span>
                </button>
            </div>
            <div class="modal-body">
                @if(isset($data['numFollowing']) && $data['numFollowing'] > 0)
                    <table>
                        @foreach($data['followingList'] as $following)
                            <tr>
                                <td><img width="50" src="{{ $following->gravatar }}"></td>
                                <td><a target="_blank" href="/profile/{{ $following->username }}">{{ $following->firstname }} {{ $following->lastname }}</a></td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary-outline ks-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg-skills" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Members who share this skill - </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-close"></span>
                </button>
            </div>
            <div class="modal-body">
                @if(isset($data['numFollowing']) && $data['numFollowing'] > 0)
                    <table>
                        @foreach($data['followingList'] as $following)
                            <tr>
                                <td><img width="50" src="{{ $following->gravatar }}"></td>
                                <td><a target="_blank" href="/profile/{{ $following->username }}">{{ $following->firstname }} {{ $following->lastname }}</a></td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary-outline ks-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--END-->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!--<script src="/libs/jquery/jquery.min.js"></script>-->

<script src="/assets/scripts/cropper/cropper.min.js"></script>
<script src="/libs/responsejs/response.min.js"></script>
<script src="/libs/jscrollpane/jquery.mousewheel.js"></script>
<script src="/libs/flexibility/flexibility.js"></script>

<script src="/assets/scripts/custom-file-input.js" type="text/javascript"></script>
<script src="/libs/typeahead/typeahead.bundle.min.js"></script>
<script src="/libs/select2/js/select2.min.js"></script>
<script src="libs/jquery-form-validator/jquery.form-validator.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/assets/scripts/common.min.js"></script>
<!-- END THEME LAYOUT SCRIPTS -->
@yield('javascript')
<script type="application/javascript">
    (function ($) {
        $(document).ready(function() {
            $('.selectpicker').select2({
                placeholder: 'Select an Option',
                dropdownAutoWidth : true,
                width: '100%'
            });
        });
    })(jQuery);
</script>
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

        //when saving in contant info it will back to that tab
        @if (session('tab'))
        @if(session('tab') == 'general')
        $('.nav-link[data-target="#settings"]').click();
        $('.nav-link[data-target="#general"]').click();
        @endif
        @if(session('tab') == 'contact')
        $('.nav-link[data-target="#settings"]').click();
        $('.nav-link[data-target="#contact"]').click();
        @endif
        @if(session('tab') == 'skills')
        $('.nav-link[data-target="#settings"]').click();
        $('.nav-link[data-target="#skills"]').click();
        @endif
        @if(session('tab') == 'addeventinfo')
        $('.nav-link[data-target="#settings"]').click();
        $('.nav-link[data-target="#addeventinfo"]').click();
        @endif
        @endif

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
        //document.getElementById('Submit').addEventListener('click', selectAll, false);
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

@if(Route::current()->getName() == 'membersdirectory')
    <script src="/libs/datatables-net/media/js/jquery.dataTables.min.js"></script>
    <script src="/libs/datatables-net/media/js/dataTables.bootstrap4.min.js"></script>
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
        $.notify({
            message:'Member will be removed on update.',
            type: 'info-solid-active'
        })
    });
</script>
<script>
    $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        var x               = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                var fields =
                    '<div>\
                        <div class="form-group ">\
                            <div class="col-md-6 ">\
                                <input type="text" class="form-control" placeholder="Skill '+ x+'" name="Skill'+x+'" value="">\
                            </div>\
                        </div>\
                        <a href="#" class="remove_field"><button class="btn btn-danger">Remove</button></a>\
                        <div>&nbsp;</div>\
                    </div>';
                $(wrapper).append(fields); //add input box
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>
<script>
    $('.skills').on('click', function(){
        var skill = $(this).data('id');
        console.log(skill);
        $.post(
            '/skillsearch.php',
            { skill:skill } ,
            function(data){
                console.log(data);
            }
        );
    });

</script>
<script>
    !function(e){var t=function(t,n){this.$element=e(t),this.type=this.$element.data("uploadtype")||(this.$element.find(".thumbnail").length>0?"image":"file"),this.$input=this.$element.find(":file");if(this.$input.length===0)return;this.name=this.$input.attr("name")||n.name,this.$hidden=this.$element.find('input[type=hidden][name="'+this.name+'"]'),this.$hidden.length===0&&(this.$hidden=e('<input type="hidden" />'),this.$element.prepend(this.$hidden)),this.$preview=this.$element.find(".fileupload-preview");var r=this.$preview.css("height");this.$preview.css("display")!="inline"&&r!="0px"&&r!="none"&&this.$preview.css("line-height",r),this.original={exists:this.$element.hasClass("fileupload-exists"),preview:this.$preview.html(),hiddenVal:this.$hidden.val()},this.$remove=this.$element.find('[data-dismiss="fileupload"]'),this.$element.find('[data-trigger="fileupload"]').on("click.fileupload",e.proxy(this.trigger,this)),this.listen()};t.prototype={listen:function(){this.$input.on("change.fileupload",e.proxy(this.change,this)),e(this.$input[0].form).on("reset.fileupload",e.proxy(this.reset,this)),this.$remove&&this.$remove.on("click.fileupload",e.proxy(this.clear,this))},change:function(e,t){if(t==="clear")return;var n=e.target.files!==undefined?e.target.files[0]:e.target.value?{name:e.target.value.replace(/^.+\\/,"")}:null;if(!n){this.clear();return}this.$hidden.val(""),this.$hidden.attr("name",""),this.$input.attr("name",this.name);if(this.type==="image"&&this.$preview.length>0&&(typeof n.type!="undefined"?n.type.match("image.*"):n.name.match(/\.(gif|png|jpe?g)$/i))&&typeof FileReader!="undefined"){var r=new FileReader,i=this.$preview,s=this.$element;r.onload=function(e){i.html('<img src="'+e.target.result+'" '+(i.css("max-height")!="none"?'style="max-height: '+i.css("max-height")+';"':"")+" />"),s.addClass("fileupload-exists").removeClass("fileupload-new")},r.readAsDataURL(n)}else this.$preview.text(n.name),this.$element.addClass("fileupload-exists").removeClass("fileupload-new")},clear:function(e){this.$hidden.val(""),this.$hidden.attr("name",this.name),this.$input.attr("name","");if(navigator.userAgent.match(/msie/i)){var t=this.$input.clone(!0);this.$input.after(t),this.$input.remove(),this.$input=t}else this.$input.val("");this.$preview.html(""),this.$element.addClass("fileupload-new").removeClass("fileupload-exists"),e&&(this.$input.trigger("change",["clear"]),e.preventDefault())},reset:function(e){this.clear(),this.$hidden.val(this.original.hiddenVal),this.$preview.html(this.original.preview),this.original.exists?this.$element.addClass("fileupload-exists").removeClass("fileupload-new"):this.$element.addClass("fileupload-new").removeClass("fileupload-exists")},trigger:function(e){this.$input.trigger("click"),e.preventDefault()}},e.fn.fileupload=function(n){return this.each(function(){var r=e(this),i=r.data("fileupload");i||r.data("fileupload",i=new t(this,n)),typeof n=="string"&&i[n]()})},e.fn.fileupload.Constructor=t,e(document).on("click.fileupload.data-api",'[data-provides="fileupload"]',function(t){var n=e(this);if(n.data("fileupload"))return;n.fileupload(n.data());var r=e(t.target).closest('[data-dismiss="fileupload"],[data-trigger="fileupload"]');r.length>0&&(r.trigger("click.fileupload"),t.preventDefault())})}(window.jQuery)
</script>
</body>
</html>