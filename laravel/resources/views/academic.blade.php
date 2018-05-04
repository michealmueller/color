@extends('members.profile.master')
@section('content')
    <div class="ks-column ks-page">
        <div class="ks-content row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="col-md-12 paddingTop">
                    <div class="card panel panel-default ks-light ks-panel ks-login ">
                        <form method="post" enctype="multipart/form-data">
                            <div class="col-ms-12 row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="card-block">
                                        <input type="hidden" name="regType" value="academic">
                                        {{ csrf_field() }}
                                        <h5 class="ks-header">Upload Academic Proof</h5>

                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <span class="btn btn-primary btn-file">
                                                <span class="fileupload-new">Select file</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" name="fileInput"/></span>
                                                <span class="fileupload-preview">
                                            </span>
                                            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                        </div>



                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="col-ms-12 row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8 form-group">
                                    <button class="btn btn-primary btn-block" type="submit" name="upload">
                                        <span class="la la-upload"></span>Upload</button>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection