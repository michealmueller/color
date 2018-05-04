@extends('admin.master')

@section('content')
    <div class="ks-content">
        <div class="ks-body">
            <div class="ks-container-fluid">



                <div id="dataTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                    <div class="row">
                        <div class="col-md-12">
                            <!--<div class="col-md-6">
                                <input type="search" placeholder="Search" name>
                            </div>
                            <div class="col-md-6"></div>-->
                            <table class="table table-hover tablesaw tablesaw-columntoggle tablesaw-sortable filter-table dataTable"
                                   data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-mode="columntoggle"
                                   data-tablesaw-minimap data-role="table" data-filter="true" id="ks-dataTable">

                                <thead>
                                <tr>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'></th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>File Name</th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>File Location</th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>Last Modified</th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>Catagory</th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>Remove File</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'></th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>File Name</th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>File Location</th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>Last Modified</th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>Catagory</th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>Remove File</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @if($data['files'] != null && isset($data['files']))
                                    @foreach($data['files'] as $file)
                                        <tr role="row">
                                            <td>
                                                @php
                                                    switch($file->file_type){
                                                        case 'image/png';
                                                            echo '<span class="la la-image la-3x"></span>';
                                                        break;
                                                        case 'image/jpeg';
                                                            echo '<span class="la la-image la-3x"></span>';
                                                        break;
                                                        case 'image/jpg';
                                                            echo '<span class="la la-image la-3x"></span>';
                                                        break;
                                                        case 'image/gif';
                                                            echo '<span class="la la-image la-3x"></span>';
                                                        break;

                                                        case 'text/plain';
                                                            echo '<span class="la la-file-text-o la-3x"></span>';
                                                        break;

                                                        case 'application/pdf';
                                                            echo '<span class="la la-file-pdf-o la-3x"></span>';
                                                        break;
                                                    }
                                                @endphp
                                            </td>
                                            <td>
                                                <a href="download/{{ $file->filename }}" target="_blank">{{ $file->filename }}</a>
                                            </td>
                                            <td>
                                                {{ $file->file_location }}
                                            </td>
                                            <td>
                                                {{ $file->updated_at }}
                                            </td>
                                            <td>
                                                {{ $file->category }}
                                            </td>
                                            <td>
                                                <a href="/admin/files/{{ $file->id }}/remove"><span class="la la-remove la-3x"></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <script>
                                $('table').filterTable({
                                    ignoreColumns: [0,8]
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
        </div>
    </div>

@endsection