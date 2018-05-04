@extends('master')

@section('content')
    <div class="ks-page">
        <div class="ks-body">
            <div class="ks-logo"><img class="img-responsive" width="250px" src="/assets/img/CMG-Logo2.png"></div>

            <div class="card panel panel-default light ks-panel ks-forgot-password">
                <div class="card-block">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}

                            <h4 class="ks-header">
                                Reset / Forgot Password
                                <span>If this is your <b>first</b> login, please enter your email to reset your password.</span>
                            </h4>

                            <div class="form-group">
                                <div class="input-icon icon-left icon-lg icon-color-primary">
                                    <input name="email" type="text" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    <span class="icon-addon">
                            <span class="la la-at"></span>
                        </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
