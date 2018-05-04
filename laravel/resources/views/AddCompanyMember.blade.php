@extends('master')

@section('content')
    <div class="ks-header">
        <section class="ks-title text-center">
            <h3>Add Company Member</h3>
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
                                    <h5 class="card-title">Basic</h5>
                                    <form method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="">
                                        <div class="form-group row">
                                            <label for="firstname" class="col-sm-2 form-control-label">First Name:</label>
                                            <div class="col-sm-4">
                                                <input name="firstname" type="text" class="form-control" id="firstname" placeholder="First Name" value="">
                                            </div>
                                            <label for="lastname" class="col-sm-2 form-control-label">Last Name:</label>
                                            <div class="col-sm-4">
                                                <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Last Name" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="username" class="col-sm-2 form-control-label">Username:</label>
                                            <div class="col-sm-10">
                                                <input name="username" type="text" class="form-control" id="username" placeholder="User Name" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 form-control-label">Password:</label>
                                            <div class="col-sm-10">
                                                <input name="password" type="password" class="form-control" id="password" placeholder="Password" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="company" class="col-sm-2 form-control-label">Company:</label>
                                            <div class="col-sm-10">
                                                <input name="company" type="text" class="form-control" id="company" placeholder="Company" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 form-control-label">Email:</label>
                                            <div class="col-sm-10">
                                                <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="country" class="col-sm-2 form-control-label">Country:</label>
                                            <div class="col-sm-4">
                                                {{ Form::select('country',$data['country'],'Select a country.',['class'=>'form-control selectpicker', 'data-width'=>'200']) }}
                                            </div>
                                            <label  for="state" class="col-sm-2 form-control-label">State:</label>
                                            <div class="col-sm-4">
                                                {{ Form::select('state',$data['states'],'Select a state.',['class'=>'form-control selectpicker', 'data-width'=>'200']) }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <button class="btn btn-primary btn-block" type="submit" name="AddCompanyMember">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">&nbsp;</div>
                    </div>
                    <div class="row">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
@endsection