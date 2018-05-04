<?php
/**
 * Created by PhpStorm.
 * User: arthm
 * Date: 12/2/2017
 * Time: 6:46 PM
 */
?>
@extends('master')

@section('content')
    <section class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-md-4 login-sec">
                    <img style="display: block; margin: 0 auto;" width="150" src="assets/img/CMG-logo.jpg">
                    <form method="post">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="card-block">
                                <form class="form-container" action="/login">
                                    <div class="form-group">
                                        <div class="input-icon icon-left icon-lg icon-color-primary">
                                            <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                                            <span class="icon-addon">
                                                <span class="la la-at"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-icon icon-left icon-lg icon-color-primary">
                                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                                            <span class="icon-addon">
                                                <span class="la la-key"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Log In</button>
                                    </div>
                                    <div class="ks-text-center">
                                        &nbsp;
                                    </div>
                                    <div class="ks-text-center">
                                        Don't have an account? <br><a class="btn btn-success" href="{{ route('register') }}">Sign Up</a>
                                    </div>
                                    <div class="ks-text-center center-bottom">
                                        <amall><a href="{{ route('password.request') }}">Forgot your password?</a></amall>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 banner-sec">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img class="d-block img-fluid" src="/assets/img/2_preview.jpeg" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <div class="banner-text">

                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid" src="/assets/img/3_preview.jpeg" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <div class="banner-text">

                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid" src="/assets/img/5_preview.jpeg" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <div class="banner-text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection