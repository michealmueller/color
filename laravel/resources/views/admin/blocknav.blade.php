<div class="ks-column ks-page">
    <div>

        <div class="ks-logo pull-left admin">
            <div class="img-responsive img-thumbnail" ><img src="/assets/img/CMG-logo-admin.png"></div>
        </div>
    </div>
        <div class="ks-body">
            <div class="container-fluid ks-dashboard ks-rows-section">
                <div class="row">
                    <div class="col-lg-3 admin-block">
                        <div class="card panel panel-purple ks-amount-widget color1">
                            <div class="card-header">
                                    <a class="blocklink" href="/admin/directory">Total Members / Active Members</a>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <form method="post" action="/admin/reports">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="reportType" value="active">
                                            <div class="form-group row v-center">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-sm btn-primary btn-block ">Total Users Report</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-sm-6">
                                        <form method="post" action="/admin/reports">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="reportType" value="active">
                                            <div class="form-group row v-center">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-sm btn-primary btn-block ">Active Users Report</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block panel-body">
                                <div class="ks-amount">@if(isset($data['totalMembers'])){{ $data['totalMembers'] }}@endif / @if(isset($data['activeMembers'])){{ $data['activeMembers'] }}@endif</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 admin-block">
                        <div class="card panel panel-info ks-amount-widget color2" data-type="info">
                            <div class="card-header">
                                <a class="blocklink" href="/admin/expiring">Expiring This Month</a>
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-8">
                                        <form method="post" action="/admin/reports">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="reportType" value="expired">
                                            <div class="form-group row v-center">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-sm btn-primary btn-block ">Expiring Users Report</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                            </div>
                            <div class="card-block panel-body">
                                <div class="ks-amount">@if(isset($data['expiringMembers'])){{ $data['expiringMembers'] }}@endif</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card panel panel-success ks-amount-widget color3" data-type="success">
                            <div class="card-header">
                                <a class="blocklink" href="/admin/new">New This Month</a>
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-8">
                                        <form method="post" action="/admin/reports">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="reportType" value="newmonth">
                                            <div class="form-group row v-center">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-sm btn-primary btn-block ">Monthly New Users Report</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                            </div>
                            <div class="card-block panel-body">
                                <div class="ks-amount">
                                    @if(isset($data['newMembers']))
                                        {{ $data['newMembers'] }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 admin-block">
                        <div class="card panel panel-purple ks-amount-widget color1">
                            <div class="card-header">
                                <a class="blocklink" href="/admin/renewed">Renewed Members</a>
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-8">
                                        <form method="post" action="/admin/reports">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="reportType" value="renewed">
                                            <div class="form-group row v-center">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-sm btn-primary btn-block ">Renewed Users Report</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                            </div>
                            <div class="card-block panel-body">
                                <div class="ks-amount">
                                    @if(isset($data['renewedMembers']))
                                        {{ $data['renewedMembers'] }}
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card panel panel-primary ks-action-widget">
                            <div class="card-block">
                                <a href="/admin/addmember" class="ks-action">
                                    <span class="ks-icon la la-user"></span>
                                    <span class="ks-text">Add <br> Member</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card panel ks-action-widget">
                            <div class="card-block">
                                <a href="http://colormarketing.co/wp-admin/edit.php?post_type=event" target="_blank" class="ks-action">
                                    <span class="ks-icon la la-list"></span>
                                    <span class="ks-text">Create <br> Event</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card panel ks-action-widget">
                            <div class="card-block">
                                <a href="/admin/directory" class="ks-action">
                                    <span class="ks-icon la la-users"></span>
                                    <span class="ks-text">View <br> Members</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>