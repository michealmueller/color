@extends('admin.master')

@section('content')
    <div class="ks-header clear-header">
        <section class="ks-title text-center">
            <h3>Add Member</h3>
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
                                        {{ csrf_field() }}
                                        <input type="hidden" value="">
                                        <div class="form-group row">
                                            <label for="firstname" class="col-sm-2 form-control-label">First Name:</label>
                                            <div class="col-sm-4">
                                                <input name="firstname" type="text" class="form-control" id="firstname" placeholder="First Name" value="{{ old('firstname') }}" required>
                                            </div>
                                            <label for="lastname" class="col-sm-2 form-control-label">Last Name:</label>
                                            <div class="col-sm-4">
                                                <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Last Name" value="{{ old('lastname') }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 form-control-label p-t-0">Admin:</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox">
                                                    <input name="isadmin" type="checkbox" class="">
                                                </label>
                                            </div>
                                            <label class="col-sm-2 form-control-label p-t-0">Activated:</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox">
                                                    <input name="activated" type="checkbox" class="">
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="username" class="col-sm-2 form-control-label">Username:</label>
                                            <div class="col-sm-10">
                                                <input name="username" type="text" class="form-control" id="username" placeholder="User Name" value="{{ old('username') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 form-control-label">Password:</label>
                                            <div class="col-sm-10">
                                                <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_confirmation" class="col-sm-2 form-control-label">Confirm Password:</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="company" class="col-sm-2 form-control-label">Company:</label>
                                            <div class="col-sm-10">
                                                <input name="company" type="text" class="form-control" id="company" placeholder="Company" value="{{ old('company') }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="phone" class="col-sm-2 form-control-label">Phone:</label>
                                            <div class="col-sm-10">
                                                <input name="phone" type="phone" class="form-control" id="phone" placeholder="Phone" value="{{ old('phone') }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 form-control-label">Email:</label>
                                            <div class="col-sm-10">
                                                <input name="email" type="email" class="form-control" id="email" placeholder="Email" value=" {{ old('email') }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="address" class="col-sm-2 form-control-label">Address:</label>
                                            <div class="col-sm-10">
                                                <input name="address" type="text" class="form-control" id="address" placeholder="Address" value=" {{ old('address') }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="country" class="col-sm-2 form-control-label">Country:</label>
                                            <div class="col-sm-4">
                                                {{ Form::select('country',$data['country'],'Select a country.',['class'=>'form-control selectpicker','data-width'=>'190']) }}
                                            </div>
                                            <label  for="state" class="col-sm-2 form-control-label">State:</label>
                                            <div class="col-sm-4">
                                                {{ Form::select('state',$data['states'],'Select a state.',['class'=>'form-control selectpicker','data-width'=>'190']) }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="city" class="col-sm-2 form-control-label">City:</label>
                                            <div class="col-sm-4">
                                                <input name="city" type="text" class="form-control" id="city" placeholder="City" value="{{ old('city') }}" required>
                                            </div>
                                            <label for="zip" class="col-sm-2 form-control-label">Zip:</label>
                                            <div class="col-sm-4">
                                                <input name="zip" type="text" class="form-control" id="zip" placeholder="Zip" value="{{ old('zip') }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="cmg_position" class="col-sm-2 form-control-label">Color Marketing Group Position:</label>
                                            <div class="col-sm-10">
                                                <select name="cmg_position" type="text" class="form-control" id="cmg_position" required>
                                                    <option value="0" selected>Member</option>
                                                    <option value="1">Board Member</option>
                                                    <option value="2">Committee Member</option>
                                                    <option value="3">Executive Committee Member</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="paymentdate" class="col-sm-2 form-control-label">Payment Date:</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="paymentdate" name="lastpayment" value="{{ old('paymentdate') }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="bio" class="col-sm-2 form-control-label">Bio:</label>
                                            <div class="col-sm-10">
                                                    <textarea name="bio" type="text" class="form-control" id="bio" cols="10" rows="5">{{ old('bio') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <button class="btn btn-primary btn-block" type="submit" name="update">Update</button>
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