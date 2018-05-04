@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card panel panel-default ks-widget">
                <div class="card-header">
                    Reports
                </div>
                <div class="tab-content">
                    <div class="tab-pane active ks-column-section" id="in-patient" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ks-tabs-container ks-tabs-default ks-tabs-no-separator">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="active" role="tabpanel">
                                            <div class="col-md-12 row">
                                                <div class="col-md-4">
                                                    <form method="post"> {{ csrf_field() }}
                                                        <input type="hidden" name="reportType" value="active">
                                                        <div class="form-group row v-center">
                                                            <div class="col-sm-12">
                                                                <button type="submit" class="btn btn-primary btn-block ">Active Users Report</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-md-4">
                                                    <form method="post"> {{ csrf_field() }}
                                                        <input type="hidden" name="reportType" value="expired">
                                                        <div class="form-group row v-center">
                                                            <div class="col-sm-12">
                                                                <button type="submit" class="btn btn-primary btn-block ">Expired Users Report</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-md-4">
                                                    <form method="post"> {{ csrf_field() }}
                                                        <input type="hidden" name="reportType" value="company">
                                                        <div class="form-group row v-center">
                                                            <label for="specific">Specific Company:</label>
                                                            <input class="form-control" name="specific" id="specific" placeholder="Specific Company">
                                                            <div class="col-sm-12">
                                                                <button type="submit" class="btn btn-primary btn-block ">Company Report</button>
                                                            </div>
                                                        </div>
                                                    </form>
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
        </div>
    </div>
@endsection