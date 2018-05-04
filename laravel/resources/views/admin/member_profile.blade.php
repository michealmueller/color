@extends('admin.master')

@section('content')
    <div class="ks-column ks-page">
        <div class="ks-header">
            <section class="ks-title">
                <h3>Member Profile</h3>
            </section>
        </div>

        <div class="ks-content">
            <div class="ks-body ks-profile">
                <div class="ks-header">
                    <div class="ks-user">
                        <img src="{{$data['member']->gravatar }}" class="ks-avatar" width="100" height="100">
                        <div class="ks-info">
                            <div class="ks-name">{{$data['member']->firstname }} {{$data['member']->lastname }}</div>
                            <div class="ks-description">{{$data['member']->state }}, {{$data['member']->country }}</div>
                        </div>
                    </div>
                    <div class="ks-statistics">
                        <div class="ks-item">
                            <div class="ks-amount">{{ $data['member']->created_at->format('m-d-Y') }}
                                <br>
                                                    {{ $data['member']->created_at->format('h:i:s A') }}
                            </div>
                            <div class="ks-text">Member Since</div>
                        </div>
                        <div class="ks-item">
                            <div class="ks-amount">{{ $data['member']['eventsAttendedNum'] }}</div>
                            <div class="ks-text">Events Attended</div>
                        </div>
                        <div class="ks-item">
                            <div class="ks-amount">
                                @if($data['member']->lastpayment != null && $data['member']->deactivated == 0)
                                    <div style="color:green">
                                        Active
                                    </div>
                                @else
                                    @if($data['member']->deactivated == 1)
                                        <div style="color:red">
                                            Deactivated
                                        </div>
                                        @else
                                        <div style="color:red">
                                            Inactive
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="ks-item">
                            <div class="ks-amount">
                                {{ $data['userDaysLeft'] }}
                            </div>
                            <div class="ks-text">
                                Days Remaining
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ks-tabs-container ks-tabs-default ks-tabs-no-separator ks-full ks-light">
                    <ul class="nav ks-nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" data-toggle="tab" data-target="#overview" aria-expanded="true">Membership Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="tab" data-target="#eventsAttended" aria-expanded="false">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="tab" data-target="#notes" aria-expanded="false">Notes</a>
                        </li>

                    </ul>
                </div>
                    <div class="tab-content">
                        @include('admin.segments.membershipinformation')
                        @include('admin.segments.events')
                        @include('admin.segments.notes')
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
