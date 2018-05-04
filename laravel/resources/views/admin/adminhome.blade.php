@extends('admin.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card panel panel-default ks-widget">
            <div class="card-header">
                Statistics
            </div>
            <div class="tab-content">
                <div class="tab-pane active ks-column-section" id="in-patient" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ks-tabs-container ks-tabs-default ks-tabs-no-separator">
                                <ul class="nav ks-nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#" data-toggle="tab" data-target="#tab1">Monthly</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-toggle="tab" data-target="#tab2">Yearly</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1" role="tabpanel">
                                        @php $chart_height = 400; @endphp
                                        <div class="card-panel" style="height: {{ $chart_height + 50 }}px">
                                            <iframe id="Monthly Income" src="{{ route('chart', ['name' => 'monthly', 'height' => $chart_height]) }}" height="{{ $chart_height + 50 }}" width="100%" style="width:100%; border:none;"></iframe>
                                        </div>
                                        @php $chart_height = 400; @endphp
                                        <!--<div class="card-panel" style="height: {{ $chart_height + 50 }}px">
                                            <iframe id="Monthly Income" src="{{ route('chart', ['name' => 'monthlyUsers', 'height' => $chart_height]) }}" height="{{ $chart_height + 50 }}" width="100%" style="width:100%; border:none;"></iframe>
                                        </div>-->
                                    </div>
                                    <div class="tab-pane" id="tab2" role="tabpanel">
                                        @php $chart_height = 400; @endphp
                                        <div class="card-panel" style="height: {{ $chart_height + 50 }}px">
                                            <iframe id="Yearly Income" src="{{ route('chart', ['name' => 'yearly', 'height' => $chart_height]) }}" height="{{ $chart_height + 50 }}" width="100%" style="width:100%; border:none;"></iframe>
                                        </div>
                                        @php $chart_height = 400; @endphp
                                        <!--<div class="card-panel" style="height: {{ $chart_height + 50 }}px">
                                            <iframe id="Yearly Income" src="{{ route('chart', ['name' => 'yearlyUsers', 'height' => $chart_height]) }}" height="{{ $chart_height + 50 }}" width="100%" style="width:100%; border:none;"></iframe>
                                        </div>-->
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