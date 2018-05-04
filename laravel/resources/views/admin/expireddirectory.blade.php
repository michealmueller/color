@extends('admin.master')

@section('content')
    <div id="dataTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
        <div class="row">
            <div class="col-md-12">
                <div class="row filter-bg v-center" style="position: relative;z-index: 0">
                    <div class="col-md-4">&nbsp;</div>
                    <div class="col-md-4">
                        <input type="search" class="form-control " id="filterSearch" name="filterSearch" placeholder="CMG Member Dynamic Search">
                    </div>
                    <div class="col-md-4">&nbsp;</div>
                </div>
                <table class="table table-hover tablesaw tablesaw-columntoggle tablesaw-sortable filter-table dataTable"
                       data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-mode="columntoggle"
                       data-tablesaw-minimap data-role="table" data-filter="true" id="ks-dataTable">
                    <thead>
                    <tr>
                        <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>Image</th>
                        <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='persist'>Name</th>
                        <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='persist'>Company</th>
                        <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='3'>Position</th>
                        <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='4'>Member Since</th>
                        <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='5'>Membership Expiration</th>
                        <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='6'>Speaker / Presenter</th>
                        <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='persist'>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['expiredUsers'] as $user)
                        <tr role="row">
                            <td class="tablesaw-cell-persist"><img src="{{ $user->gravatar }}" width="32px" /> </td>
                            <td><a href="/admin/profile/{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</a></td>
                            <td>{{ $user->company }}</td>
                            <td>
                                @php
                                    switch($user->cmg_position){
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
                                    }
                                @endphp
                            </td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td style="color: #b21830;">
                                @php
                                    $endingDate = strtotime(date('Y-m-d', strtotime('+1 year', strtotime($user->lastpayment))));
                                    $today = strtotime(date('Y-m-d'));
                                    $daysLeft = $endingDate - $today;
                                    $remaining = round((($daysLeft / 24) / 60) / 60);
                                    if($remaining <= 0){
                                        echo \Carbon\Carbon::createFromTimestamp($endingDate)->format('Y-m-d') .' - <b>Expired</b>';
                                    }else{
                                        echo $remaining.' Days';
                                    }
                                @endphp</td>
                            <td>
                                @if($user->speaker_presenter == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                            <td>
                                <a href="/admin/{{ $user->id }}/edit" data-toggle="tooltip" data-placement="left" title="" data-original-title="Edit">
                                    <span class="la la-edit la-2x"></span></a>
                                |
                                <a href="/admin/{{ $user->id }}/remove" data-toggle="tooltip" data-placement="left" title="" data-original-title="Remove">
                                    <span class="la la-remove la-2x"></span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <script>
                    $('table').filterTable({
                        inputSelector:'#filterSearch',
                        ignoreColumns: [0,7]
                    });
                </script>
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <div class="dataTables_paginate paging_simple_numbers" id="ks-datatable_paginate">
                            <ul class="pagination pagination-sm inline">
                                <li class="">

                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection