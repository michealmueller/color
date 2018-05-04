@extends('master')

@section('content')
    <div class="ks-page">
        <div class="ks-body">
            <div class="ks-logo"><img class="img-responsive" width="400px" src="/assets/img/CMG-Logo2.png"></div>

            <div class="card panel panel-default light ks-panel ks-confirm">
                <div class="card-block">
                    <div class="ks-header">You have been registered! <br><small>See you there!</small></div>
                    <div class="ks-description">
                        Event Information:<br>
                        Name: {!! html_entity_decode($data['meta']['event_name']) !!}<br>
                        Date: @if(isset($data['meta']['event_dates']['start']) && isset($data['meta']['event_dates']['end']))
                            {{ $data['meta']['event_dates']['start'] }} - {{  $data['meta']['event_dates']['end'] }}<br>
                        @elseif(isset($data['meta']['event_dates']['start']) && !isset($data['meta']['event_dates']['end']))
                            {{ $data['meta']['event_dates']['start'] }} <br>
                        @endif
                        Time: {{ $data['meta']['event_time'] }}
                    </div>
                    <div class="ks-resend">
                        Back to <a href="{{ route('profile') }}">Profile</a>
                    </div>
                </div>
            </div>
            @if(!Auth::user())
            <div class="ks-panel-extra">
                Don't have an account? <a href="{{ route('register') }}">Sign Up</a>
            </div>
            @endif
        </div>
    </div>

@endsection