@extends('admin.master')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card panel panel-default ks-widget">
                <div class="card-header">
                    Digital Color Forecasts
                </div>
                <div class="tab-content">
                    <div class="tab-pane active ks-column-section" id="in-patient" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ks-tabs-container ks-tabs-default ks-tabs-no-separator">
                                    <ul class="nav ks-nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#" data-toggle="tab" data-target="#tab1">Digital Color Report</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="tab" data-target="#tab2">Roving Report</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab1" role="tabpanel">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="col-md-12">
                                                {{ csrf_field() }}
                                                    <div class="form-group col-md-4">
                                                        <label for="title">Title:</label>
                                                        <input class="form-control" type="text" name="title" >
                                                    </div>

                                                    <div class="col-md-4 img-responsive pull-right">
                                                        <div id="feature_placeholder" >
                                                        </div>
                                                    </div>

                                                    <label for="feature">Feature Image</label>
                                                    <div class="form-group">
                                                        <div class="input-group col-md-4">
                                                            <label class="input-group-btn">
                                                                <span class="btn btn-primary">
                                                                    Browse&hellip; <input id="featureInput" type="file" name="featureInput" style="display: none;">
                                                                </span>
                                                            </label>
                                                            <input type="text" class="form-control" readonly>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="body">Body</label>
                                                        <div id="summernote"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Create</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="tab2" role="tabpanel">
                                            Roving Report
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
