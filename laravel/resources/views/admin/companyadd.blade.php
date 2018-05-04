@extends('admin.master')
@section('content')
    @include('notification')
    @include('errors')
    <div class="ks-header">
        <section class="ks-title text-center">
            <h3>Add Company</h3>
        </section>
    </div>

    <div class="ks-content">
        <div class="ks-body">
            <div class="ks-nav-body-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">&nbsp;</div>
                        <div class="col-lg-6 ks-panels-column-section">
                            <div class="card">
                                <div class="card-block">
                                    <form method="post">
                                        <input type="hidden" name="regType" value="company">
                                        {{ csrf_field() }}
                                        <div class="card panel panel-default ks-light ks-panel ks-signup">
                                            <div class="card-block">
                                                <div class="form-group">
                                                    <label><span class="req">*</span>Company Name:</label>
                                                    <div class="input-icon icon-left icon-lg icon-color-primary">
                                                        <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="{{ old('company') }}" required>
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
                                                            {{ Form::select('compstate',$data['states'],'Select a state.',['class'=>'form-control selectpicker','data-width'=>'170']) }}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <label><span class="req">*</span>Company Country:</label>
                                                        <div class="input-icon icon-left icon-lg icon-color-primary">
                                                            {{ Form::select('compcountry',$data['country'],'Select a Country.',['class'=>'form-control selectpicker','data-width'=>'170']) }}
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
                                                        <input type="text" class="form-control" placeholder="Products or Services" name="prod" value="{{ old('products_services') }}" required>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <label><span class="req">*</span>Industry:</label>
                                                        <!--<input type="text" class="form-control" placeholder="Industry" name="industry" value=" old('industry') " required>-->
                                                        {{ Form::select('industry',$data['industry'], 'Select an industry', ['class'=>'form-control selectpicker','data-width'=>'200']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <label for="companylevel">Company Level:</label>
                                                        <select id="companylevel" class="form-control" name="companylevel">
                                                            <option value="2">Basic</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                        </select>
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
                                                        <div id="section1">
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
                                                        <div id="section2">
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
                                                <input type="submit" class="btn btn-primary btn-block" value="Add Company" name="addcompany">
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

@endsection