<div class="tab-pane" id="eventsAttended" role="tabpanel" aria-expanded="false">
    <form method="post">

        <input type="hidden" name="user_id" value="{{ $data['member']->id }}">

        {{ csrf_field() }}
        <div class="col-md-12 paddingTopHalf">
            <div class="row">
                <div class="form-group formgroupPadding">
                    <label for="events">Events:</label>
                    <select id="events" class="form-control" name="event">
                        @if(isset($data['events']))
                            <option value="null">Select event</option>
                            @foreach($data['events'] as $event)
                                <option value="{{ $event->ID }}">{{ $event->post_title }}</option>
                            @endforeach
                        @else
                            <option value="null">No events to list</option>
                        @endif
                    </select>
                </div>
                <div class="form-group formgroupPadding">
                    <label for="paymentDate">Payment Date:</label>
                    <input class="form-control" type="date" name="paymentDate">
                </div>
                <div class="form-group">
                    <label>Amount Paid:</label>
                    <div class="input-group formgroupPadding">
                        <span class="input-group-addon">$</span>
                        <input type="text" class="form-control" name="amount">
                        <span class="input-group-addon">.00</span>
                    </div>
                </div>
                <div class="form-group formgroupPadding">
                    <label for="attendeeType">Attendee Type:</label>
                    <select id="attendeeType" class="form-control" name="attendeeType">
                        <option value="member">Member</option>
                        <option value="academic">Academic</option>
                        <option value="company">Company</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <button class="btn btn-primary">Add user to event</button>
                </div>
            </div>
        </div>
    </form>
    @if(isset($data['attendedevents']))
    <div class="col-md-12">
        <div class="ks-body">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                @if(isset($data['attendedevents']))
                    @foreach($data['attendedevents'] as $attendedevent)
                        <div class="swiper-slide">
                            <div class="card panel panel-default ks-project">
                                <div class="ks-header">
                                </div>
                                <div class="ks-body">
                                    <h4 class="ks-text">{!! html_entity_decode($attendedevent['name']) !!}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @endif
</div>