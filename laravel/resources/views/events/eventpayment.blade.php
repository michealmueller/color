@extends('master')
@section('content')
    <div class="ks-page">
        <div class="ks-body">
            <div class="ks-logo"><img class="img-responsive" width="400px" src="/assets/img/CMG-Logo2.png"></div>

            <div class="card panel panel-default light ks-panel ks-confirm">
                <div class="card-block">
                    <div class="ks-header">Almost Done!<br><small>Just need payment.</small></div>
                    <div class="ks-description">
                        Event Information:<br>
                        Name: {!! html_entity_decode($data['meta']['event_name']) !!} <br>
                        Date: @if(isset($data['meta']['event_dates']['start']) && isset($data['meta']['event_dates']['end']))
                            {{ $data['meta']['event_dates']['start'] }} - {{  $data['meta']['event_dates']['end'] }}<br>
                        @elseif(isset($data['meta']['event_dates']['start']) && !isset($data['meta']['event_dates']['end']))
                            {{ $data['meta']['event_dates']['start'] }} <br>
                        @endif
                        Time: {{ $data['meta']['event_time'] }}<br>
                        <br>
                        Price: ${{ $data['registrationAmount'] }}.00
                        <br>
                        <br>
                        @if($data['meta']['guests_allowed'] == 1)
                        <form method="get">
                            {{ csrf_field() }}
                            <select name="guests">
                                @if(isset($_GET['guests']))
                                    <option value="{{ $_GET['guests'] }}">
                                        @if($_GET['guests'] == 0)
                                            No
                                        @else
                                            {{ $_GET['guests'] }}
                                        @endif
                                            Guests</option>
                                @endif
                                <option value="0">No Guests</option>
                                <option value="1">1 Guests</option>
                                <option value="2">2 Guests</option>
                                <option value="3">3 Guests</option>
                            </select>

                            @if(isset($_GET['guests']))
                                @for($i=1; $i <= $_GET['guests']; $i++)
                                    <br><input class="form-control" type="text" name="guest{{$i}}" placeholder="Guest {{$i}}"
                                    @if(isset($_GET['guest'.$i]))
                                        value="{{ $_GET['guest'.$i] }}"
                                    @endif
                                    ><br>
                                @endfor
                            @endif

                            <button type="submit" class="btn btn-sm btn-info"><span class="la la-refresh"></span> Update</button>
                        </form>
                        <br><br><b>*** Click update after entering your guests. ***</b>
                        @endif
                    </div>
                    <div class="ks-resend">
                        <form method="POST" action="/NewEventCharge" >
                            {{ csrf_field() }}
                            <input type="hidden" name="registrationAmount" value="{{ $data['registrationAmount'] }}">
                            <input type="hidden" name="eventID" value="{{ $data['event']->ID }}">
                            <input type="hidden" name="registrationType" value="{{ $data['registrationType'] }}">
                            <input type="hidden" name="event_name" value="{!! html_entity_decode($data['meta']['event_name']) !!}">
                            <input type="hidden" name="event_date_start" value="{{ $data['meta']['event_dates']['start'] }}">
                            <input type="hidden" name="event_date_end" value="{{ $data['meta']['event_dates']['end'] }}">
                            <input type="hidden" name="event_time" value="{{ $data['meta']['event_time'] }}">
                            @if(isset($_GET['guests']))
                                <input type="hidden" name="guestsNum" value="{{ $_GET['guests'] }}">
                                @for($i=1; $i <= $_GET['guests']; $i++)
                                    @if(isset($_GET['guest'.$i]))
                                    <input type="hidden" name="guests{{$i}}" value="{{ $_GET['guest'.$i] }}">
                                    @endif
                                @endfor
                            @endif
<!--
data-key="pk_live_dCD9fVKPRZAwjHA71YGc3isg"
data-key="pk_test_uOpzdE7e2XF36aTaxUcTjUN0"
-->
                            <script
                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="pk_live_dCD9fVKPRZAwjHA71YGc3isg"
                                    data-amount="{{ $data['registrationAmount'] }}00"
                                    data-name="{!! html_entity_decode($data['meta']['event_name']) !!} Registration"
                                    data-description="registration for {!! html_entity_decode($data['meta']['event_name']) !!}"
                                    data-locale="auto"
                                    data-zip-code="true">
                            </script>
                        </form>
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