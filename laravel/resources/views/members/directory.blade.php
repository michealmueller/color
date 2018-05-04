@extends('members.dir.master')


@section('content')
    <div class="ks-column ks-page directory">
        <div class="ks-page-content">
            <div class="ks-page-content-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-centered" id="hideme">
                                <div class="card-header">Member Directory Search</div>
                                <div class="card-block">
                                    <form method="get" action="/members/directory">
                                        <input type="hidden" name="search" value="true">
                                        <input type="hidden" name="advanced" id="advanced" value="false">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                {{ Form::select('cmg_position',$data['membership_type'], $data['search_values']['cmg_position'], ['class'=>'form-control selectpicker', 'data-placeholder' => 'Membership Type']) }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="firstname" placeholder="First Name" value="{{ $data['search_values']['firstname'] or '' }}" style="width: 48%; float: left;">
                                                <input type="text" class="form-control" name="lastname" placeholder="Last Name" value="{{ $data['search_values']['lastname'] or ''}}"  style="width: 48%; float: right;">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $data['search_values']['email'] or ''}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="company" placeholder="Company" value="{{ $data['search_values']['company'] or '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                               <a href="#" class="advanced-search" data-toggle="tooltip" title="click to see more search fields">Advanced Search</a>
                                            </div>
                                        </div>
                                        <div class="form-group row advanced" style="display: none;">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="city" placeholder="City" value="{{ $data['search_values']['city'] or '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row advanced" style="display: none;">
                                            <div class="col-md-12">
                                                {{ Form::select('state',$data['states'], $data['search_values']['state'], ['class'=>'form-control selectpicker', 'data-placeholder' => 'State']) }}
                                            </div>
                                        </div>
                                        <div class="form-group row advanced" style="display: none;">
                                            <div class="col-md-12">
                                                {{ Form::select('country',$data['country'], $data['search_values']['country'], ['class'=>'form-control selectpicker', 'data-placeholder' => 'Country']) }}
                                            </div>
                                        </div>
                                        <div class="form-group row advanced" style="display: none;">
                                            <div class="col-md-12">
                                                <select name="events" type="text" class="form-control selectpicker" data-placeholder="Events" disabled>
                                                    <option value=""></option>
                                                    @foreach($data['events'] as $event)
                                                        <option value="{{  $event->ID }}" @if( isset($data['search_values']['events']) && $data['search_values']['events'] == $event->ID ) selected @endif>
                                                            {{  $event->post_title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row advanced" style="display: none;">
                                            <div class="col-md-12">
                                                {{ Form::select('industry',$data['industry'],$data['search_values']['industry'],['class'=>'form-control selectpicker', 'data-placeholder' => 'Industry']) }}
                                            </div>
                                        </div>
                                        <div class="form-group row advanced" style="display: none;">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="products_services" placeholder="Products & Services" value="{{ $data['search_values']['products_services'] or ''}}">
                                            </div>
                                        </div>
                                        <div class="form-group row advanced" style="display: none;">
                                            <div class="col-md-12">
                                                <input type="checkbox" value="1" name="speaker_presenter" {{ (isset($data['search_values']['speaker_presenter']) && !is_null($data['search_values']['speaker_presenter'])) ? 'checked' : ''}}><span style="font-size: 12px;"> Speaker / Presenter</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary btn-block">Search</button>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="/members/directory" class="btn btn-default btn-block">Clear</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                @if(isset($data['users']))
                                    @if(isset($data['search_values']['search']))
                                    <h4>Member Search Results</h4>
                                    @endif
                                    @foreach($data['users'] as $user)
                                        <div class="col-md-12 directory-card">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    @if($user->gravatar == null)
                                                        <img class="ks-avatar img-responsive" src="/assets/img/profile/avatar_default.jpeg">
                                                    @else
                                                        <img class="ks-avatar img-responsive" src="{{ $user->gravatar }}">
                                                    @endif
                                                </div>
                                                <div class="col-sm-4">
                                                    <h4><a href="/profile/{{ $user->username }}">{{ $user->firstname }} {{ $user->lastname }}</a></h4>
                                                    <p>{{ $user->company }}</p>
                                                    <span>Member Since: {{ $user->created_at }}</span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <span><b>State:</b> {{ $user->state }}</span>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <span><b>Country:</b> {{ $user->country }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <span><b>Industy:</b> {{ $user->industry }}</span>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <span><b>Product/Service:</b> {{ $user->products_services }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            @if($user->compweb != '')
                                                                <a href="{{preg_replace('/^(?!https?:\/\/)/', 'http://', $user->compweb)}}" data-toggle="tooltip" title="Company Website">
                                                                    <span class="ks-icon la la-globe"></span>
                                                                </a>
                                                            @endif
                                                            <a href="mailto:{{$user->email}}"><span class="ks-icon la la-envelope" data-toggle="tooltip" title="Email {{ $user->firstname }}"></span></a>
                                                            @if($user->speaker_presenter == 1)
                                                                <span class="ks-icon la la-microphone" data-toggle="tooltip" title="Speaker Presenter"></span>
                                                            @endif
                                                            @if($user->cmg_position == 1)
                                                                <span class="ks-icon la la-users" data-toggle="tooltip" title="Board Member"></span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if(!count($data['users']))
                                        <div class="col-md-12">
                                            <h4>No results found</h4>
                                            <p>
                                                Please refine your search, click <a href="/members/directory">here</a> to start over.
                                            </p>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            {{ $data['users']->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('javascript')
    <script>
        (function ($) {
            $(document).ready(function() {
                $( ".advanced-search" ).click(function(e) {
                    if($(".advanced").toggle().is(':visible')) {
                        $( ".advanced-search").parent().parent().hide();
                        $( "#advanced").val('true');
                    }else{
                        $( "#advanced").val('false');
                    }
                    e.stopPropagation();
                });
                @if($data['search_values']['advanced'] == 'true')
                  $( ".advanced-search" ).click();
                @endif
            });
        })(jQuery);
    </script>
@stop
