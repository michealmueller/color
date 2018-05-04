@extends('master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>You are not authorized to access this page.</h2>
            </div>
            <p>If you feel this is an error, please contact an administrator. be sure to tell them <b>what</b> you were
                trying to access, and <b>why</b> you believe this to be an error.
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-center">
                        <a href="{{ route('login') }}"><button class="btn btn-danger">Go Back</button></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <a href="mailto::admin@colormarketing.com"><button class="btn btn-primary">Contact an Administrator.</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection