@extends('admin.master')

@section('content')
    <div class="ks-content">
        <div class="ks-body">
            <div class="ks-nav-body-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">&nbsp;</div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped dataTable">
                                        <thead>
                                        <tr>
                                            <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>Image</th>
                                            <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='persist'>Name</th>
                                            <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='persist'>Proof</th>
                                            <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='persist'>Approve</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['users'] as $user)
                                                <tr role="row">
                                                    <td class="tablesaw-cell-persist"><img src="{{ $user->gravatar }}" width="32px" /> </td>
                                                    <td><a href="/admin/profile/{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</a></td>
                                                    @if($user->academic_proof == null)
                                                        <td>Proof Not Uploaded.</td>
                                                        <td></td>
                                                    @else
                                                    <td><a href="{{ $user->academic_proof }}" target="_blank"><button class="btn btn-info">View File</button></a></td>
                                                    <td>
                                                        <a href="/admin/authorize/{{ $user->id }}"><button class="btn btn-primary">Approve</button></a>
                                                    </td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection