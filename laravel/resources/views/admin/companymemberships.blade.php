@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card panel panel-default ks-widget">
                <div class="card-header">
                    Statistics
                </div>
                <div id="dataTable_wrapper" class="dataTables_wrapper table-responsive table-bordered">
                    <div class="col-md-12 row filter-bg v-center">
                        <div class="col-md-4">&nbsp;</div>
                        <div class="col-md-4">
                            <input type="search" class="form-control " id="filterSearch" name="filterSearch" placeholder="CMG Company Dynamic Search">
                        </div>
                        <div class="col-md-4">&nbsp;</div>
                    </div>
                    <table class="table table-hover tablesaw tablesaw-columntoggle tablesaw-sortable filter-table dataTable"
                           data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-mode="columntoggle"
                           data-tablesaw-minimap data-role="table" data-filter="true" id="ks-dataTable">
                        <thead>
                        <tr>
                            <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='persist'>Company Name</th>
                            <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='persist'>Company Level</th>
                            <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='3'>Address</th>
                            <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='4'>City</th>
                            <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='5'>State</th>
                            <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='5'>Zip</th>
                            <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='5'>Phone</th>
                            <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='5'>Fax</th>
                            <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='5'>Consumer</th>
                            <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='5'>Contract</th>
                            <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='5'>Joined On</th>
                            <th scope="col" data-tablesaw-sortable-col=""  data-tablesaw-priority='5'>Edit</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(count($data['companies']) > 0)
                            @foreach($data['companies'] as $k=>$v)
                                <tr role="row" style="border:2px solid black;">
                                    <td>
                                        {{ $k }}
                                    </td>
                                    <td>{{ $v['company_level'] }}</td>
                                    <td>
                                        {{ $v['company_address'] }}
                                    </td>
                                    <td>
                                        {{ $v['city'] }}
                                    </td>
                                    <td>
                                        {{ $v['state'] }}
                                    </td>
                                    <td>
                                        {{ $v['zip'] }}
                                    </td>
                                    <td>
                                        {{ $v['phone'] }}
                                    </td>
                                    <td>
                                        {{ $v['fax'] }}
                                    </td>
                                    <td>
                                        {{ $v['consumer'] }}
                                    </td>
                                    <td>
                                        {{ $v['contract'] }}
                                    </td>
                                    <td>
                                        {{ $v['created_at'] }}
                                    </td>
                                    <td>
                                        <a href="/admin/companies/edit/{{ $v['id'] }}" data-toggle="tooltip" data-placement="left" title="" data-original-title="Edit">
                                            <span class="la la-edit la-2x"></span></a>
                                        <!--|
                                        <a href="/admin/companies/remove/{ $v['id'] }}"><span class="la la-remove la-2x"></span></a>-->
                                    </td>
                                </tr>

                                @if(isset($v['members']))
                                    <tr>
                                        <td></td>
                                        <th>Company Lead</th>
                                        @if(isset($v['members']['companyAdmin']))
                                            <td colspan="10">{{ $v['members']['companyAdmin']->firstname }} {{ $v['members']['companyAdmin']->lastname }}</td>
                                        @endif
                                    </tr>
                                    @if(isset($v['members']['companyRep']) && $v['members']['companyRep'] != null)
                                        @foreach($v['members']['companyRep'] as $rep)
                                                    <tr>
                                                        <td></td>
                                                        <th><small>Company Rep</small></th>
                                                        <td colspan="10"><small>{{ $rep->firstname }} {{ $rep->lastname }}</small></td>
                                                    </tr>
                                            @endforeach
                                    @endif
                                @else
                                    <tr style="border: 5px solid black;">
                                        <td></td>
                                        <td colspan="10">No Current Members.</td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center"><b>There are currently no companies....</b></td>
                            </tr>
                        @endif
                    </table>
                    <script>
                        $('table').filterTable({
                            inputSelector:'#filterSearch',
                            ignoreColumns: [11]
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection