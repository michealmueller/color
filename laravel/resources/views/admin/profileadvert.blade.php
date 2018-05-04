@extends('admin.master')
@section('content')
            <div class="ks-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                    @include('errors')
                    @if(! empty($success))
                        <div class="form-group alert alert-success">
                            <ul>
                                <li>{{ $success }}</li>
                            </ul>
                        </div>
                    @endif
                        <div class="card text-centered" id="hideme">
                            <div class="card-header">Current Adverts</div>
                            <div class="card-block">
                                    <div class="row">
                                        @foreach($data['currentAdverts'] as $advert)

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <b><u>Advert Name:</u></b><h3>{{ $advert->advert_name }}</h3>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <form method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="advert_id" value="{{ $advert->id }}">
                                                            <button class="btn btn-danger btn-block">Remove</button>
                                                        </form>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <b>Advert Link:</b>
                                                        <a href="{{ $advert->advert_link }}">{{ $advert->advert_link }}</a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-2"></div>
                                                    <div class="col-sm-8">
                                                        <b>Advert Image:</b>
                                                        <img src="{{ $advert->advert_location }}" width="150">
                                                    </div>
                                                    <div class="col-sm-2"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                            </div>
                        </div>
                            <div class="card panel panel-default ks-light ks-panel ks-signup">
                                <div class="card-block">
                                    <h4 class="ks-header">Upload Profile Advertisment</h4>
                                    <div class="col-md-12">
                                        <div id="advert_placeholder" >
                                        </div>
                                    </div>
                                    <form method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="input-group-btn">
                                                <span class="btn btn-primary">
                                                    Browse&hellip; <input id="advertInput" type="file" name="advertInput" style="display: none;">
                                                </span>
                                            </label>
                                            <input type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div  class="input-icon icon-left icon-lg icon-color-primary">
                                            <label for="advert_link">Advertisment Url</label> - <small>the url the advertisment should link to when clicked.</small>
                                            <input class="form-control" type="url" name="advert_link" placeholder="URL For advertisment">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary ">Upload</button>
                                    </div>
                                    </form>
                                </div>
                            </div>

                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
@endsection