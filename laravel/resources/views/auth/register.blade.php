@extends('master')

@section('content')

    <div class="ks-page">
        <div class="ks-body">
            <div class="ks-logo" style="padding-top:100px;"><img class="img-responsive" width="250" src="/assets/img/CMG-Logo2.png"></div>
            <h2>Please Choose The Membership Type you would like to Register for</h2>
            @include('errors')
            <div class="row">
                <div class="ks-tabs-container ks-tabs-default ks-tabs-with-separator ks-tabs-header-default ks-tabs-primary">
                    <ul class="nav ks-nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link @if(Session::has('regType') && session('regType') === 'user') active @endif" href="#" data-toggle="tab" data-target="#tab4">
                                <span class="ks-icon la la-user text-info"></span>
                                Individual Membership
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Session::has('regType') && session('regType') === 'company') active @endif" href="#" data-toggle="tab" data-target="#tab5">
                                <span class="ks-icon la la-building text-success"></span>
                                Company Membership
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Session::has('regType') && session('regType') === 'academic') active @endif" href="#" data-toggle="tab" data-target="#tab6">
                                <span class="ks-icon la la-book text-success"></span>
                                Academic Membership
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane @if(Session::has('regType') && session('regType') === 'user') active @endif" id="tab4" role="tabpanel">
                            <form method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="regType" value="user">
                                <div class="card panel panel-default ks-light ks-panel ks-signup">
                                    <div class="card-block">
                                        <h4 class="ks-header">JOIN Color Marketing Group</h4>
                                        <label><span class="req">*</span>Name:</label>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <input type="text" class="form-control" placeholder="First name" name="firstname" value="{{ old('firstname') }}" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <input type="text" class="form-control" placeholder="Last name" name="lastname" value="{{ old('lastname') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="req">*</span>Email:</label>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                                                <span class="icon-addon">
                                                <span class="la la-at"></span>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="req">*</span>Company:</label>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="text" class="form-control" placeholder="Company" name="company" value="{{ old('company') }}" required>
                                                <span class="icon-addon">
                                                <span class="la la-building"></span>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label><span class="req">*</span>Position:</label>
                                                <div class="input-icon icon-left icon-lg icon-color-primary">
                                                    {{ Form::select('position', $data['position'], 'Select a position', ['class'=>'form-control selectpicker', 'id'=>'positionSelect', 'data-width'=>'300']) }}
                                                    <div id="hiddenInput1">
                                                        <input id="hidden" type="text" name="otherPosition" placeholder="Other">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label><span class="req">*</span>Industry:</label>
                                                <div class="input-icon icon-left icon-lg icon-color-primary">
                                                    {{ Form::select('industry',$data['industry'], 'Select an industry', ['class'=>'form-control selectpicker', 'id'=>'industrySelect', 'data-width'=>'300']) }}
                                                    <div id="hiddenInput2">
                                                        <input id="hidden" type="text" name="otherIndustry" placeholder="Other Industry">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="req">*</span>Company Web Site:</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Company Website" name="compweb" value="{{ old('compweb') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="req">*</span>Products and Services:</label>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="text" class="form-control" placeholder="Products or Services" name="prod" value="{{ old('prod') }}" required>
                                                <span class="icon-addon">
                                                <span class="la la-tablet"></span>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label><span class="req">*</span>City:</label>
                                                <div class="input-icon icon-left icon-lg icon-color-primary">
                                                    <input type="text" class="form-control" placeholder="City" name="city" value="{{ old('city') }}" required>
                                                    <span class="icon-addon">
                                                        <span class="la la-envelope"></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label><span class="req">*</span>State:</label>
                                                <div class="input-icon icon-left icon-lg icon-color-primary">
                                                    {{ Form::select('state',$data['states'],'Select a state.',['class'=>'form-control selectpicker']) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label><span class="req">*</span>Zip:</label>
                                                <div class="input-icon icon-left icon-lg icon-color-primary">
                                                    <input type="text" class="form-control" placeholder="zip" name="zip" value="{{ old('zip') }}" required>
                                                    <span class="icon-addon">
                                                        <span class="la la-envelope"></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label><span class="req">*</span>Country</label>
                                                {{ Form::select('country',$data['country'],'Select a country.',['class'=>'form-control selectpicker']) }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="req">*</span>Username:</label>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}" required>
                                                <span class="icon-addon">
                                                <span class="la la-user"></span>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="req">*</span>Password:</label>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                                                <span class="icon-addon">
                                                <span class="la la-key"></span>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="req">*</span>Confirm Password:</label>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                                                <span class="icon-addon">
                                                <span class="la la-key"></span>
                                            </span>
                                            </div>
                                        </div>
                                        <!--<div class="form-group">
                                            <h4 class="ks-header">Select a region you wish to join.</h4>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="checkbox" name="region" value="na" required>North America / Canada<br>
                                                <input type="checkbox" name="region" value="asiapc">Asia Pacific<br>
                                                <input type="checkbox" name="region" value="euro">European<br>
                                                <input type="checkbox" name="region" value="latin" >Latin America<br>
                                            </div>
                                        </div>-->
                                        <div class="form-group row">
                                            <div class="col-sm-6" >
                                                <h5 class="ks-header"><span class="req">**</span>Consumer / Residential<br>
                                                    <small>Select all that Apply</small>
                                                </h5>
                                                <div id="section1">
                                                    <input type="checkbox" name="consumer[]" value="Transportation"/>Transportation<br>
                                                    <input type="checkbox" name="consumer[]" value="Visual Communications"/>Visual Communications<br>
                                                    <input type="checkbox" name="consumer[]" value="Technology"/>Technology<br>
                                                    <input type="checkbox" name="consumer[]" value="Home"/>Home<br>
                                                    <input type="checkbox" name="consumer[]" value="Consumer Goods" />Consumer Goods<br>
                                                    <input type="checkbox" name="consumer[]" value="Juvenile Products"/>Juvenile Products<br>
                                                    <input type="checkbox" name="consumer[]" value="Fashion"/>Fashion<br>
                                                    <input type="checkbox" name="consumer[]" value="Action / Recreation"/>Action / Recreation<br>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <h5 class="ks-header"><span class="req">**</span>Contract / Commercial<br>
                                                    <small>Select all that Apply</small>
                                                </h5>

                                                <div id="section2">
                                                    <input type="checkbox" name="contract[]" value="Health Care" >Health Care<br>
                                                    <input type="checkbox" name="contract[]" value="Hospitality / Entertainment"/>Hospitality / Entertainment<br>
                                                    <input type="checkbox" name="contract[]" value="Office"/>Office<br>
                                                    <input type="checkbox" name="contract[]" value="Retail Enviroment"/>Retail Enviroment<br>
                                                    <input type="checkbox" name="contract[]" value="Institutional / Public Space"/>Institutional / Public Space<br>
                                                    <input type="checkbox" name="contract[]" value="All of the Above"/>All of the Above<br>
                                                    <input type="checkbox" name="contract[]" value=""/>Other
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Join</button>
                                        </div>
                                        <div class="ks-text-center">
                                            Already have an account? <a href="{{ route('login') }}">Login</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane @if(Session::has('regType') && session('regType') === 'company') active @endif" id="tab5" role="tabpanel">
                            <form method="post">
                                <input type="hidden" name="regType" value="company">
                                {{ csrf_field() }}
                                <div class="card panel panel-default ks-light ks-panel ks-signup">
                                    <div class="card-block">
                                        <h4 class="ks-header">JOIN Color Marketing Group</h4>
                                        <div>
                                            &nbsp;
                                        </div>

                                        <div class="form-group">
                                            <label><span class="req">*</span>Company Name:</label>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="text" class="form-control" placeholder="Company Name" name="company" value="{{ old('company') }}" required>
                                                <span class="icon-addon">
                                                    <span class="la la-building"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="req">*</span>Company Address:</label>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="text" class="form-control" placeholder="Company Address" name="compaddress" value="{{ old('compaddress') }}" required>
                                                <span class="icon-addon">
                                                    <span class="la la-envelope"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label><span class="req">*</span>Company City:</label>
                                                <div class="input-icon icon-left icon-lg icon-color-primary">
                                                    <input type="text" class="form-control" placeholder="Company City" name="compcity" value="{{ old('compcity') }}" required>
                                                    <span class="icon-addon">
                                                        <span class="la la-envelope"></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label><span class="req">*</span>Company Zip:</label>
                                                <div class="input-icon icon-left icon-lg icon-color-primary">
                                                    <input type="text" class="form-control" placeholder="Company Zip" name="compzip" value="{{ old('compzip') }}" required>
                                                    <span class="icon-addon">
                                                    <span class="la la-envelope"></span>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="for-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label><span class="req">*</span>Company State:</label>
                                                <div class="input-icon icon-left icon-lg icon-color-primary">
                                                    {{ Form::select('compstate',$data['states'],'Select a state.',['class'=>'form-control selectpicker']) }}
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label><span class="req">*</span>Company Country:</label>
                                                <div class="input-icon icon-left icon-lg icon-color-primary">
                                                    {{ Form::select('compcountry',$data['country'],'Select a Country.',['class'=>'form-control selectpicker']) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="req">*</span>Company Phone:</label>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="text" class="form-control" placeholder="Company Phone" name="compphone" value="{{ old('compphone') }}" required>
                                                <span class="icon-addon">
                                                    <span class="la la-phone"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Company Fax:</label>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="text" class="form-control" placeholder="Company Fax" name="compfax" value="{{ old('compfax') }}">
                                                <span class="icon-addon">
                                                    <span class="la la-fax"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label><span class="req">*</span>Products & Services:</label>
                                                <input type="text" class="form-control" placeholder="Products or Services" name="prod" value="{{ old('prod') }}" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label><span class="req">*</span>Industry:</label>
                                                <div>
                                                    {{ Form::select('industry',$data['industry'], 'Select an industry', ['class'=>'form-control selectpicker', 'id'=>'compindustrySelect', 'data-width'=>'300']) }}
                                                    <div id="hiddenInput3">
                                                        <input id="hidden" type="text" name="otherIndustry" placeholder="Other Industry">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="form-group">
                                            <h4 class="ks-header">Select a region you wish to join.</h4>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="checkbox" name="region" value="na" required>North America / Canada<br>
                                                <input type="checkbox" name="region" value="asiapc">Asia Pacific<br>
                                                <input type="checkbox" name="region" value="euro">European<br>
                                                <input type="checkbox" name="region" value="latin">Latin America<br>
                                            </div>
                                        </div>-->

                                        <div class="form-group row">
                                            <div class="col-sm-6" >
                                                <h5 class="ks-header"><span class="req">**</span>Consumer / Residential</h5>
                                                <div id="section3">
                                                    <input type="checkbox" name="consumer[]" value="Transportation">Transportation<br>
                                                    <input type="checkbox" name="consumer[]" value="Visual Communications">Visual Communications<br>
                                                    <input type="checkbox" name="consumer[]" value="Technology">Technology<br>
                                                    <input type="checkbox" name="consumer[]" value="Home">Home<br>
                                                    <input type="checkbox" name="consumer[]" value="Consumer Goods">Consumer Goods<br>
                                                    <input type="checkbox" name="consumer[]" value="Juvenile Products">Juvenile Products<br>
                                                    <input type="checkbox" name="consumer[]" value="Fashion">Fashion<br>
                                                    <input type="checkbox" name="consumer[]" value="Action Recreation">Action / Recreation<br>
                                                    <input type="checkbox" name="consumer[]" value="">Other
                                                </div>
                                            </div>
                                            <div class="col-sm-6" >
                                                <h5 class="ks-header"><span class="req">**</span>Contract / Commercial</h5>
                                                <div id="section4">
                                                    <input type="checkbox" name="contract[]" value="Health Care">Health Care<br>
                                                    <input type="checkbox" name="contract[]" value="Hospitality Entertainment">Hospitality / Entertainment<br>
                                                    <input type="checkbox" name="contract[]" value="Office">Office<br>
                                                    <input type="checkbox" name="contract[]" value="Retail Enviroment">Retail Enviroment<br>
                                                    <input type="checkbox" name="contract[]" value="Institutional Public Space">Institutional / Public Space<br>
                                                    <input type="checkbox" name="contract[]" value="All of the Above">All of the Above<br>
                                                    <input type="checkbox" name="contract[]" value="">Other
                                                </div>
                                            </div>
                                        </div>


                                        <div>
                                            &nbsp; <!--spacing for additional forms REQUIRED -->
                                        </div>

                                        <h4 class="ks-header">Company Representatives<small><b><i> *This first user is the Company Representative</i></b></small></h4>
                                        <div class="companyAdmin">
                                            <div class="form-group row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <span class="req">*</span><label>First Name:</label>
                                                    <input type="text" class="form-control" placeholder="First name" name="firstname1" value="{{ old('firstname1') }}" required>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <span class="req">*</span><label>Last Name:</label>
                                                    <input type="text" class="form-control" placeholder="Last name" name="lastname1" value="{{ old('lastname1') }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <span class="req">*</span><label>Username:</label>
                                                    <input type="text" class="form-control" placeholder="Username" name="username1" value="{{ old('username1') }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <span class="req">*</span><label>Email:</label>
                                                    <input type="text" class="form-control" placeholder="Email" name="email1" value="{{ old('email1') }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <span class="req">*</span><label>Password:</label>
                                                    <input type="password" class="form-control" placeholder="Password" name="password1" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            &nbsp;
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <span class="req">*</span><label>First Name:</label>
                                                <input type="text" class="form-control" placeholder="First name" name="firstname2" value="{{ old('firstname2') }}" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <span class="req">*</span><label>Last Name:</label>
                                                <input type="text" class="form-control" placeholder="Last name" name="lastname2" value="{{ old('lastname2') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <span class="req">*</span><label>Username:</label>
                                                <input type="text" class="form-control" placeholder="Username" name="username2" value="{{ old('username2') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <span class="req">*</span><label>Email:</label>
                                                <input type="text" class="form-control" placeholder="Email" name="email2" value="{{ old('email2') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <span class="req">*</span><label>Password:</label>
                                                <input type="password" class="form-control" placeholder="Password" name="password2" required>
                                            </div>
                                        </div>
                                        <div>

                                            &nbsp; <!--spacing for additional forms REQUIRED -->
                                        </div>

                                        <div class="input_fields_wrap">

                                        </div>
                                        <div class="form-group">
                                            <span class="pull-right">
                                                <a href="#" class="add_field_button">
                                                    <button class="btn btn-info"><span class="fa fa-plus-circle">Add More</span></button>
                                                </a>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            &nbsp;
                                        </div>

                                        <input id="totalReps" type="hidden" name="totalReps">

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Join</button>
                                        </div>
                                        <div class="ks-text-center">
                                            Already have an account? <a href="{{ route('login') }}">Login</a>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="ks-text text-center">
                                            *Company admin will have the rights to add, remove, and change individual memberships
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane @if(Session::has('regType') && Session::get('regType') === 'academic') active @endif" id="tab6" role="tabpanel">
                            <form method="post">
                                <input type="hidden" name="regType" value="academic">
                                {{ csrf_field() }}
                                <div class="card panel panel-default ks-light ks-panel ks-signup">
                                    <div class="card-block">
                                        <h4 class="ks-header">JOIN Color Marketing Group</h4>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label><span class="req">*</span>First Name:</label>
                                                <input type="text" class="form-control" placeholder="First name" name="firstname" value="{{ old('firstname') }}" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label><span class="req">*</span>Last Name:</label>
                                                <input type="text" class="form-control" placeholder="Last name" name="lastname" value="{{ old('lastname') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="req">*</span>Username:</label>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}" required>
                                                <span class="icon-addon">
                                                    <span class="la la-user"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="req">*</span>Academic Institution:</label>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="text" class="form-control" placeholder="Academic Institute" name="company" value="{{ old('company') }}" required>
                                                <span class="icon-addon">
                                                    <span class="la la-building"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="req">*</span>Email:</label>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                                                <span class="icon-addon">
                                                    <span class="la la-at"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="req">*</span>Password:</label>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                                                <span class="icon-addon">
                                                    <span class="la la-key"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="req">*</span>Confirm Password:</label>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                                                <span class="icon-addon">
                                                    <span class="la la-key"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <!--<div class="form-group">
                                            <h4 class="ks-header">Select a region you wish to join.</h4>
                                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                                <input type="checkbox" name="region" value="na" required>North America / Canada<br>
                                                <input type="checkbox" name="region" value="asiapc">Asia Pacific<br>
                                                <input type="checkbox" name="region" value="euro">European<br>
                                                <input type="checkbox" name="region" value="latin">Latin America<br>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label class="input-group-btn">
                                                    <span class="btn btn-primary">
                                                        Browse&hellip; <input type="file" name="file" style="display: none;">
                                                    </span>
                                                </label>
                                                <input type="text" class="form-control" readonly>
                                            </div>
                                        </div>-->
                                        <div>&nbsp;</div>
                                        <div class="text-center">
                                            *Academic Registration requires Administration approval,<br> before payment is accepted.
                                        </div>
                                        <div>&nbsp;</div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Join</button>
                                        </div>
                                        <div class="ks-text-center">
                                            Already have an account? <a href="{{ route('login') }}">Login</a>
                                        </div>
                                        <br>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
