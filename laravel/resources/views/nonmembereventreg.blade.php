@extends('master')

@section('content')
<div class="ks-page">
    <div class="ks-body">
        <div class="ks-logo" style="padding-top:100px;"><img class="img-responsive" width="250" src="/assets/img/CMG-Logo2.png"></div>
        <div class="tab-pane @if(Session::has('regType') && session('regType') === 'user') active @endif" id="tab4" role="tabpanel">
            @include('errors')
            <form method="post">
                {{ csrf_field() }}
                <input type="hidden" name="regType" value="user">
                <input type="hidden" name="eventid" value="{{ $data['regeventid'] }}">
                <div class="card panel panel-default ks-light ks-panel ks-signup">
                    <div class="card-block">
                        <h4 class="ks-header">Register for {!! html_entity_decode($data['EventName']) !!}</h4>
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
                        <div class="form-group">
                            Is this your First ChromaZone?</label>
                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                <input type="checkbox" value="1" name="firstevent" > Yes
                            </div>
                        </div>
                        <div class="form-group">
                            Check if you are interested in the following.<br><small><b>Choose only 1</b></small></label>
                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                <input type="checkbox" value="1" name="facilitate"> Facilitating the Workshop <br>
                                <input type="checkbox" value="1" name="co_facilitate"> Co Facilitating the Workshop <br>
                                <input type="checkbox" value="1" name="note_taking"> Taking/recording Notes <br>
                            </div>
                        </div>
                        <div class="form-group">
                            Dietary Restrictions</label>
                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                <input type="text" class="form-control" placeholder="Dietary Restrictions" name="diet">
                            </div>
                        </div>
                        <div class="form-group">
                            <label><span class="req">*</span>Emergency Contact</label>
                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                <input type="text" class="form-control" name="contactName" placeholder="Contact Name">
                                <span class="icon-addon">
                                    <span class="la la-user"></span>
                                </span>
                            </div>
                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                <input type="tel" class="form-control" name="contactPhone" placeholder="Contact Phone">
                                <span class="icon-addon">
                                    <span class="la la-phone"></span>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Register for {!!
                            html_entity_decode($data['EventName']) !!}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection