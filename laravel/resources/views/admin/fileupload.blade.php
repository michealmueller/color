@extends('admin.master')

@section('content')
        <div class="ks-content">
            <div class="ks-body">
                <div class="ks-container-fluid">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="ks-header">
                                <section class="ks-title">
                                    <h4>Upload Member Only Files</h4>
                                </section>
                            </div>
                            <form method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card panel panel-default ks-light ks-panel ks-signup">
                                    <div class="form-group">
                                        <label for="fileInput" >File</label>
                                        <input id="fileInput" class="form-control" type="file" name="fileInput" >
                                    </div>
                                    <div class="form-group">
                                        <select id="" class="form-control" name="form">
                                            <option value="members">Import Members</option>
                                            <option value="companies">Import Companies</option>
                                            <option value="company_members">Import Company Members</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary ">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
        </div>
@endsection