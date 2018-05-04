@extends('admin.master')
@section('content')
    @if(\Session::has('userData'))
        <script>
           $(document).ready(function() {
               var modal = $('#ks-izi-modal-warning').iziModal();
               modal.iziModal('open');
            });

        </script>
    @endif
    <div class="ks-header clear-header">
        <section class="ks-title text-center">
            <h3>Edit Company</h3>
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

                                    @include('errors')
                                    <form method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="form" value="companyupdate">
                                        <div class="form-group row">
                                            <label for="compname" class="col-sm-2 form-control-label">Company Name:</label>
                                            <div class="col-sm-10">
                                                <input name="compname" type="text" class="form-control" id="compname" placeholder="Company Name" value="{{ $data['company']->company_name}}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="company_level" class="col-sm-2 form-control-label">Company Level:</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="company_level" required>
                                                    @if(isset($data['company']->company_level))
                                                        <option value="{{ $data['company']->company_level }}">{{ $data['company']->company_level }}</option>
                                                    @endif
                                                    <option value="Basic">Basic</option>
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

                                        <div class="form-group row">
                                            <label for="compaddress" class="col-sm-2 form-control-label">Address:</label>
                                            <div class="col-sm-4">
                                                <input name="compaddress" type="text" class="form-control" id="compaddress" placeholder="Company Address" value="{{ $data['company']->company_address }}" required>
                                            </div>
                                            <label for="compcity" class="col-sm-2 form-control-label">City:</label>
                                            <div class="col-sm-4">
                                                <input name="compcity" type="text" class="form-control" id="compcity" placeholder="Company City" value="{{ $data['company']->city }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="compphone" class="col-sm-2 form-control-label"> Phone:</label>
                                            <div class="col-sm-4">
                                                <input name="compphone" type="text" class="form-control" id="phone" placeholder="Company Phone" value="{{ $data['company']->phone }}" required>
                                            </div>
                                            <label for="compfax" class="col-sm-2 form-control-label">Fax:</label>
                                            <div class="col-sm-4">
                                                <input name="compfax" type="text" class="form-control" id="compfax" placeholder="Company Fax" value="{{ $data['company']->fax }}">
                                            </div>
                                            <label for="compzip" class="col-sm-2 form-control-label">Zip:</label>
                                            <div class="col-sm-4">
                                                <input name="compzip" type="text" class="form-control" id="compzip" placeholder="Company Zip" value="{{ $data['company']->zip }}" required>
                                            </div>
                                            <label  for="compstate" class="col-sm-2 form-control-label">State:</label>
                                            <div class="col-sm-4">
                                                <select name="compstate" class="form-control selectpicker">
                                                    @if(isset($data['company']->state))
                                                        <option value="{{$data['company']->stateabv}}">{{$data['company']->state}}</option>
                                                    @endif
                                                    @foreach($data['states'] as $k=>$v)
                                                        <option value="{{ $k }}">{{ $v }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label  for="compcountry" class="col-sm-2 form-control-label">Country:</label>
                                            <div class="col-sm-4">
                                                <select name="compcountry" class="form-control selectpicker">
                                                    @if(isset($data['company']->country))
                                                        <option value="{{$data['company']->countryabv}}">{{$data['company']->country}}</option>
                                                    @endif
                                                    @foreach($data['country'] as $k=>$v)
                                                        <option value="{{ $k }}">{{ $v }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row checkbox1">
                                            <div class="col-md-6">
                                                <h6 class="ks-header">Consumer / Residential</h6>
                                                <div id="section1">
                                                    <input type="checkbox" name="consumer[]" value="Transportation" @if($data['company']->consumer!=null) @if(in_array('Transportation', $data['company']->consumer)) checked @endif @endif>Transportation<br>
                                                    <input type="checkbox" name="consumer[]" value="Visual Communications" @if($data['company']->consumer!=null) @if(in_array('Visual Communications', $data['company']->consumer)) checked @endif @endif>Visual Communications<br>
                                                    <input type="checkbox" name="consumer[]" value="Technology" @if($data['company']->consumer!=null) @if(in_array('Technology', $data['company']->consumer)) checked @endif @endif>Technology<br>
                                                    <input type="checkbox" name="consumer[]" value="Home" @if($data['company']->consumer!=null) @if(in_array('Home', $data['company']->consumer)) checked @endif @endif>Home<br>
                                                    <input type="checkbox" name="consumer[]" value="Consumer Goods" @if($data['company']->consumer!=null) @if(in_array('Consumer Goods', $data['company']->consumer)) checked @endif @endif>Consumer Goods<br>
                                                    <input type="checkbox" name="consumer[]" value="Juvenile Products" @if($data['company']->consumer!=null) @if(in_array('Juvenile Products', $data['company']->consumer)) checked @endif @endif>Juvenile Products<br>
                                                    <input type="checkbox" name="consumer[]" value="Fashion" @if($data['company']->consumer!=null) @if(in_array('Fasion', $data['company']->consumer)) checked @endif @endif>Fashion<br>
                                                    <input type="checkbox" name="consumer[]" value="Action Recreation" @if($data['company']->consumer!=null) @if(in_array('Action Recreation', $data['company']->consumer)) checked @endif @endif>Action / Recreation<br>
                                                    <input type="checkbox" name="consumer[]" value="">Other
                                                </div>
                                            </div>
                                            <div class="col-md-6 checkbox2">
                                                <h6 class="ks-header">Contract / Commercial</h6>
                                                <div id="section2">
                                                    <input type="checkbox" name="contract[]" value="Health Care" @if($data['company']->contract!=null) @if(in_array('Health Care', $data['company']->contract)) checked @endif @endif>Health Care<br>
                                                    <input type="checkbox" name="contract[]" value="Hospitality Entertainment" @if($data['company']->contract!=null) @if(in_array('Hospitality Entertainment', $data['company']->contract)) checked @endif @endif>Hospitality / Entertainment<br>
                                                    <input type="checkbox" name="contract[]" value="Office" @if($data['company']->contract!=null) @if(in_array('Office', $data['company']->contract)) checked @endif @endif>Office<br>
                                                    <input type="checkbox" name="contract[]" value="Retail Enviroment" @if($data['company']->contract!=null) @if(in_array('Retail Enviroment', $data['company']->contract)) checked @endif @endif>Retail Enviroment<br>
                                                    <input type="checkbox" name="contract[]" value="Institutional Public Space" @if($data['company']->contract!=null) @if(in_array('Institutional Public Space', $data['company']->contract)) checked @endif @endif>Institutional / Public Space<br>
                                                    <input type="checkbox" name="contract[]" value="All of the Above" @if($data['company']->contract!=null) @if(in_array('All of the Above', $data['company']->contract)) checked @endif @endif>All of the Above<br>
                                                    <input type="checkbox" name="contract[]" value="">Other
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <button class="btn btn-primary btn-block" id="Submit" type="submit" name="update">Update</button>
                                        </div>
                                    </form>
                                    <br>
                                    <hr>
                                    <h4>Search and Add a member to {{ $data['company']->company_name }}<br><small><small>Use either email or username of user to search and add to commpany
                                            </small></small></h4>
                                    <br>
                                    <div class="formgroup row">
                                        <div class="col-md-2">&nbsp;</div>
                                        <div class="col-md-8">
                                            <form method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="form" value="addmember">
                                                <div class="form-group row">
                                                    <label for="username" class="col-sm-2 form-control-label">Username:</label>
                                                    <div class="col-sm-10">
                                                        <input name="username" type="text" class="form-control" id="username" placeholder="User Name" value="{{ old('username') }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-2 form-control-label">Email:</label>
                                                    <div class="col-sm-10">
                                                        <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                        <button class="btn btn-primary btn-block" type="submit" name="AddCompanyMember">Search</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-2">&nbsp;</div>
                                    </div>
                                    <hr>
                                    <h4>Remove members from {{ $data['company']->company_name }}</h4>
                                    <div class="row">
                                        <table class="table table-hover">
                                            @if(isset($data['company']['members']) && count($data['company']['members']) >= 1)
                                                @foreach($data['company']['members'] as $companymember)
                                                    <tr>
                                                        <td>{{ $companymember->firstname }} {{ $companymember->lastname }}</td>
                                                        <td>
                                                            <div class="row">
                                                                @if($companymember->companyAdmin != 1)
                                                                <form method="post" action="/profile/{{ $data['user']->id }}/companymemberupdate">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="memberid" value="{{ $companymember->id }}">
                                                                    <input type="hidden" name="remove" value="remove">
                                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                                        <span class="la la-remove"></span> Remove
                                                                    </button>
                                                                </form>
                                                                &nbsp;
                                                                <form method="post">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="member_id" value="{{ $companymember->id }}">
                                                                    <input type="hidden" name="company_name" value="{{ $data['company']->company_name }}">
                                                                    <input type="hidden" name="form" value="ChangeKeyRep">
                                                                    <button type="submit" class="btn btn-sm btn-info">Make Key Rep</button>
                                                                </form>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </table>
                                    </div>
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