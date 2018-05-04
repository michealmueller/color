@extends('admin.master')

@section('content')
        <div class="ks-header">
            <section class="ks-title text-center">
                <h3>Edit Member</h3>
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
                                            <input type="hidden" value="{{ $data['member']->id }}">
                                            <div class="form-group row">
                                                <label for="firstname" class="col-sm-2 form-control-label">First Name:</label>
                                                <div class="col-sm-4">
                                                    <input name="firstname" type="text" class="form-control" id="firstname" placeholder="First Name" value="{{ $data['member']->firstname }}">
                                                </div>
                                                <label for="lastname" class="col-sm-2 form-control-label">Last Name:</label>
                                                <div class="col-sm-4">
                                                    <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Last Name" value="{{ $data['member']->lastname }}">
                                                </div>
                                            </div>
                                            @if(isset($data['member']['member_level']))
                                            <div class="form-group row">
                                                <label class="col-sm-2 form-control-label p-t-0">Member Level:</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="member_level" >
                                                        <option value="{{ $data['member']['member_level'] }}" selected>{{ $data['member']['member_level'] }}</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="form-group row">
                                                <label class="col-sm-2 form-control-label p-t-0">Admin:</label>
                                                <div class="col-sm-4">
                                                    <label class="custom-control custom-checkbox">
                                                        <input name="isadmin" type="checkbox" class="custom-control-input"
                                                        @if($data['member']->isAdmin == true)
                                                            checked
                                                        @endif
                                                        >
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description"></span>
                                                    </label>
                                                </div>
                                                <label class="col-sm-2 form-control-label p-t-0">Activated:</label>
                                                <div class="col-sm-4">
                                                    <label class="custom-control custom-checkbox">
                                                        <input name="activated" type="checkbox" class="custom-control-input"
                                                               @if($data['member']->activated == true)
                                                               checked
                                                                @endif
                                                        >
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="expiration" class="col-sm-2 form-control-label">Expiration Date:</label>
                                                <div class="col-sm-10">
                                                    <input name="expiration" type="date" class="form-control" id="expiration" value="{{ $data['member']['exp'] }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="username" class="col-sm-2 form-control-label">Username:</label>
                                                <div class="col-sm-10">
                                                    <input name="username" type="text" class="form-control" id="username" placeholder="User Name" value="{{ $data['member']->username }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-sm-2 form-control-label">Password:</label>
                                                <div class="col-sm-10">
                                                    <input name="password" type="text" class="form-control" id="password" placeholder="Change Users Password">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="skills" class="col-sm-2 form-control-label">Skills:</label>
                                                <div class="col-sm-10">
                                                    <input name="skills" type="text" class="form-control" id="skills" placeholder="Skills" value="{{ $data['member']->skills }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="company" class="col-sm-2 form-control-label">Company:</label>
                                                <div class="col-sm-10">
                                                    <input name="company" type="text" class="form-control" id="company" placeholder="Company" value="{{ $data['member']->company }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-2 form-control-label">Phone:</label>
                                                <div class="col-sm-10">
                                                    <input name="phone" type="phone" class="form-control" id="phone" placeholder="Phone" value="{{ $data['member']->phone }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-sm-2 form-control-label">Email:</label>
                                                <div class="col-sm-10">
                                                    <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="{{ $data['member']->email }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="address" class="col-sm-2 form-control-label">Address:</label>
                                                <div class="col-sm-10">
                                                    <input name="address" type="text" class="form-control" id="address" placeholder="Address" value="{{ $data['member']->address }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="country" class="col-sm-2 form-control-label">Country:</label>
                                                <div class="col-sm-4">
                                                    {{ Form::select('country',$data['country'],$data['member']->country,['class'=>'form-control selectpicker']) }}
                                                </div>
                                                <label  for="state" class="col-sm-2 form-control-label">State:</label>
                                                <div class="col-sm-4">
                                                    {{ Form::select('state',$data['states'],$data['member']->state,['class'=>'form-control selectpicker']) }}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="city" class="col-sm-2 form-control-label">City:</label>
                                                <div class="col-sm-4">
                                                    <input name="city" type="text" class="form-control" id="city" placeholder="City" value="{{ $data['member']->city }}">
                                                </div>
                                                <label for="zip" class="col-sm-2 form-control-label">Zip:</label>
                                                <div class="col-sm-4">
                                                    <input name="zip" type="text" class="form-control" id="zip" placeholder="Zip" value="{{ $data['member']->zip }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="cmg_position" class="col-sm-2 form-control-label">Color Marketing Group Position:</label>
                                                <div class="col-sm-10">
                                                    <select name="cmg_position" type="text" class="form-control" id="cmg_position">
                                                        @if($data['member']->state != null)
                                                            <option selected value="{{ $data['member']->cmg_position }}">
                                                                @php
                                                                    switch($data['member']->cmg_position){
                                                                        case 0:
                                                                            echo 'Member';
                                                                            break;
                                                                        case 1:
                                                                            echo 'Board Member';
                                                                            break;
                                                                        case 2:
                                                                            echo 'Committee Member';
                                                                            break;
                                                                        case 3:
                                                                            echo 'Executive Committee Member';
                                                                            break;
                                                                        case 4;
                                                                            echo 'Emeritus Member';
                                                                            break;
                                                                    }
                                                                @endphp
                                                            </option>
                                                        @endif
                                                        <option value="0">Member</option>
                                                        <option value="1">Board Member</option>
                                                        <option value="2">Committee Member</option>
                                                        <option value="3">Executive Committee Member</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="bio" class="col-sm-2 form-control-label">Bio:</label>
                                                <div class="col-sm-10">
                                                    <textarea name="bio" type="text" class="form-control" id="skills" cols="10" rows="15">
                                                         {{ $data['member']->bio }}
                                                    </textarea>
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