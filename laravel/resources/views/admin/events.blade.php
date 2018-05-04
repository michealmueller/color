@extends('admin.master')

@section('content')
    <div class="ks-body">
        <div class="ks-content">
            <div class="ks-body ks-projects-grid-board">
                <div class="ks-projects">
                    <div class="ks-body">
                        <div class="row">
                            <div class="ks-table-container">
                                <div class="card panel panel-default ks-information ks-light">
                                    <div class="card-header">
                                        <section class="ks-text">
                                            <h5>Upcoming Events</h5>
                                        </section>
                                    </div>
                                    <div class="card-block ks-slider">
                                        <div class="swiper-container swiper-container-horizontal">
                                            <!-- Additional required wrapper -->
                                            <div class="swiper-wrapper">
                                            @if(isset($data['events']['futureEvents']))
                                                @foreach($data['events']['futureEvents'] as $event)
                                                    <div class="swiper-slide">
                                                        <div class="card panel panel-default ks-project">
                                                            <div class="ks-header">
                                                            </div>
                                                            <div class="ks-body">
                                                                <a href="#" class="ks-name">
                                                                    <span class="ks-text">{!! html_entity_decode
                                                                    ($event['name']) 
                                                                    !!}</span>
                                                                </a>
                                                                <div class="ks-description">
                                                                    {{ $event['event_content'] }}
                                                                </div>
                                                                <div class="ks-meta">
                                                                    <div class="ks-item">
                                                                        <div class="ks-name">
                                                                            Dates
                                                                        </div>
                                                                        <div class="ks-description">
                                                                            {{ $event['date_start'] }} - {{ $event['date_end'] }}
                                                                            <br>
                                                                            {{ $event['time'] }} - {{ $event['time_end'] }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="ks-item ks-images">
                                                                        <div class="ks-name">
                                                                            Registered Users
                                                                        </div>
                                                                        <div class="ks-description">
                                                                            @if(count($event['attendies']) > 0)
                                                                                @foreach($event['attendies'] as $user)
                                                                                    <a href="profile/{{ $user->id }}" class="ks-image">
                                                                                        <img class="ks-avatar" src="{{ $user->gravatar }}" width="25" height="25">
                                                                                    </a>
                                                                                @endforeach
                                                                                <a target="_blank" href="/admin/export/{{ $event['event']->ID }}"><button class="btn btn-info">Download CSV</button></a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card panel panel-default ks-information ks-light">
                                    <div class="card-header">
                                        <section class="ks-text">
                                                <h5>Past Events</h5>
                                        </section>
                                    </div>
                                    <div class="card-block ks-slider">
                                        <div class="swiper-container swiper-container-horizontal">
                                            <!-- Additional required wrapper -->
                                            <div class="swiper-wrapper">
                                            @if(isset($data['events']['pastEvents']))
                                                @foreach($data['events']['pastEvents'] as $event)
                                                    <div class="swiper-slide">
                                                        <div class="card panel panel-default ks-project">
                                                            <div class="ks-header">
                                                            </div>
                                                            <div class="ks-body">
                                                                <a href="#" class="ks-name">
                                                                    <span class="ks-text">{{ $event['name'] }}</span>
                                                                </a>
                                                                <div class="ks-description">
                                                                    {{ $event['event_content'] }}
                                                                </div>
                                                                <div class="ks-meta">
                                                                    <div class="ks-item">
                                                                        <div class="ks-name">
                                                                            Dates
                                                                        </div>
                                                                        <div class="ks-description">
                                                                            {{ $event['date_start'] }} - {{ $event['date_end'] }}
                                                                            <br>
                                                                            {{ $event['time'] }} - {{ $event['time_end'] }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="ks-item ks-images">
                                                                        <div class="ks-name">
                                                                            Registered Users
                                                                        </div>
                                                                        <div class="ks-description">
                                                                            @if(count($event['attendies']) > 0)
                                                                                @foreach($event['attendies'] as $user)
                                                                                    <a href="profile/{{ $user->id }}" class="ks-image">
                                                                                        <img class="ks-avatar" src="{{ $user->gravatar }}" width="25" height="25">
                                                                                    </a>
                                                                                @endforeach
                                                                                <a target="_blank" href="/admin/export/{{ $event['event']->ID }}"><button class="btn btn-info btn-block">Download CSV</button></a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection