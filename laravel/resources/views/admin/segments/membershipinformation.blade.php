<div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="false">
    <div class="ks-overview-tab">
        <div class="row">
            <div class="col-xl-9 ks-tables-container">
                <div class="card panel panel-default ks-information ks-light">
                    <h5 class="card-header">
                        <span class="ks-text">Member Info</span>
                    </h5>
                    <div class="card-block ks-datatable">
                        <table class="table table-hover tablesaw tablesaw-columntoggle dataTable" >
                            <thead>
                            <tr>
                                <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>Name</th>
                                <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='1'>Company</th>
                                <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='2'>Joined</th>
                                <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='3'>MemberShip Paid On</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td> {{ $data['member']->firstname }} {{ $data['member']->lastname }}</td>
                                <td> {{ $data['member']->company }}</td>
                                <td> {{ $data['member']->created_at->format('M Y') }}</td>
                                <td> {{ $data['member']->lastpayment }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <h5 class="card-header">
                        <span class="ks-text">Recent Activity</span>
                    </h5>
                    <div class="card-block ks-datatable">
                        <div class="card-block ks-datatable">
                            <ul>
                            @if(isset($data['recent']['msg']) && isset($data['recent']['date']))
                                @for($i=0; $i<= count($data['recent']['msg'])-1; $i++)
                                    <li>{{ $data['recent']['date'][$i] }} : {{ $data['recent']['msg'][$i] }}<br><hr></li>
                                @endfor
                            @endif
                            </ul>
                        </div>
                    </div>
                    <div class="card panel panel-default ks-information ks-dark-primary ks-body">
                        <h5 class="card-header">
                            <span class="ks-text">User's Timeline</span>
                        </h5>
                        <div class="ks-feed">
                            @if($data['timelines'])
                                @foreach($data['timelines'] as $postData)
                                    <div class="card panel panel-default ks-post">
                                        <div class="ks-header">
                                            <a href="#" class="ks-user">
                                                <img src="{{ $data['timelines']['user']->gravatar }}" class="ks-avatar" width="36" height="36">
                                                <a href="/profile/{{ $data['timelines']['user']->username }}"><span class="ks-name">{{ $data['timelines']['user']->firstname }} {{ $data['timelines']['user']->lastname }} &#64;{{ $data['timelines']['user']->username }}</span></a>
                                            </a>
                                            <span class="ks-date-created">{{ $postData['created_at'] }}</span>
                                        </div>
                                        <div class="ks-body">
                                            <div class="ks-text">
                                                @if(isset($postData['image_url']))
                                                    <div class="img-responsive">
                                                        <img class="thumb" src="{{ $postData['image_url'] }}" />
                                                    </div>
                                                @endif
                                                {{ $postData['post_content'] }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card panel panel-default ks-information ks-light">
                    <h5 class="card-header">
                        <span class="ks-text">Contact Info</span>
                        <a href="/admin/{{ $data['member']->id }}/edit" class="btn btn-primary-outline ks-light ks-no-text"><span class="la la-pencil ks-icon"></span></a>
                    </h5>
                    <div class="card-block">
                        <table class="ks-table-description">
                            <tr>
                                <td class="ks-icon">
                                    <span class="la la-map-marker"></span>
                                </td>
                                <td class="ks-text">
                                    {{ $data['member']->address }}, {{ $data['member']->city }}, {{ $data['member']->state }}
                                    {{ $data['member']->country }}
                                </td>
                            </tr>
                            <tr>
                                <td class="ks-icon ks-fs-16">
                                    <span class="la la-phone"></span>
                                </td>
                                <td class="ks-text">
                                    {{ $data['member']->phone }}
                                </td>
                            </tr>
                            <tr>
                                <td class="ks-icon ks-fs-14">
                                    <span class="la la-envelope"></span>
                                </td>
                                <td class="ks-text">
                                    <a href="#">{{ $data['member']->email }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="ks-icon ks-fs-15">
                                    <span class="la la-globe"></span>
                                </td>
                                <td class="ks-text">
                                    <a href="#">{{ $data['member']->website }}</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card panel panel-default ks-information ks-light">
                    <h5 class="card-header">
                        <span class="ks-text">Account Controls</span>
                    </h5>
                    <div class="card-block">
                        <table class="ks-table-description">
                            <tr>
                                <td class="ks-icon">
                                    Deactivate Account
                                </td>
                                <td>&nbsp;</td>
                                <td class="ks-text">
                                    @if($data['member']->deactivated == 1)
                                        <form id="activate" method="post" action="/admin/profile/{{ $data['member']->id }}/controls">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="buttontype" value="activate">
                                            <button type="button" class="activateAlert btn btn-warning btn-block">Activate</button>
                                        </form>
                                    @else
                                        <form id="deactivate" method="post" action="/admin/profile/{{ $data['member']->id }}/controls">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="buttontype" value="deactivate" >
                                            <button type="button" class="deactivateAlert btn btn-warning btn-block">Deactivate</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="ks-icon ks-fs-16">
                                    Terminate Account
                                </td>
                                <td>&nbsp;</td>
                                <td class="ks-text">
                                    <form id="terminate" method="post" action="/admin/profile/{{ $data['member']->id }}/controls">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="buttontype" value="terminate" >
                                        <button type="button" class="terminateAlert btn btn-danger btn-block">Terminate</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="ks-icon">
                                    Extend Membership
                                </td>
                                <td colspan="2">
                                    <form method="post" action="/admin/profile/{{ $data['member']->id }}/extend">
                                        {{ csrf_field() }}
                                        <select class="form-control" name="extend">
                                            <option value="1W">1 Week</option>
                                            <option value="2W">2 Weeks</option>
                                            <option value="1M">1 Month</option>
                                            <option value="3M">3 months</option>
                                            <option value="6M">6 months</option>
                                            <option value="1Y">1 year</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-block">Extend</button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td>Expire On:</td>
                                <td>
                                    <form method="post" action="/admin/profile/{{ $data['member']->id }}/extend">
                                        {{ csrf_field() }}
                                        <input name="expiration" type="date" class="form-control" id="expiration" value="{{ $data['member']['exp'] }}">
                                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>