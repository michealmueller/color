@extends('members.profile.master')

@section('content')
    <div class="ks-column ks-page">
        <div class="ks-content">
            <div class="ks-body">
                <div class="ks-container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card panel panel-default">
                                <div class="card-block ">
                                    <img class="rounded mx-auto d-block" src="/assets/img/CMG-Logo2.png">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card panel panel-default">
                                <div class="card-header">DIGITAL FORECASTS & WRITTEN REPORTS FOR CMG's WORLD COLOR FORECAST™</div>
                                <div class="card-block">
                                    <blockquote class="card-blockquote">
                                        <p>
                                        Members of Color Marketing Group are entitled to valuable, proprietary benefits that non members otherwise do not have access to.  The value of these benefits, which include the Color Forecasts, is based on their exclusive distribution to, and use by, CMG Members.  Unauthorized use of these materials by CMG Members or third parties is illegal.  Despite CMG member’s ability to utilize personally the information contained in the copyrighted World Color Forecast™, this license does not extend to copying, reproduction, or distribution.  Consequently, a CMG Member who knowingly allows an unauthorized third party to make use of CMG copyrighted materials, will be found liable for contributing to the infringement.

                                        Furthermore, use of these materials by third parties diminishes their value as well as YOUR membership to CMG.  CMG is YOUR Association, do not allow others to reduce its value as well as your marketability.
                                        </p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card panel panel-default">
                                <div class="card-header">Trade Show Roving Color Reports</div>
                                <div class="card-block">
                                    <blockquote class="card-blockquote">
                                        <p>
                                        Do you want to be a Roving Reporter for Color Marketing Group?  Roving Reporters share
                                        information as they travel to trade shows and markets around the world.  Roving Reporter take
                                        pictures and compile a short report with a brief description of the trade show, together with a
                                        brief description of each trend with corresponding images.  Reports focus on the top ten color
                                        and design trends that you feel would be of interest to the CMG membership.  Share what YOU see
                                        and members will reciprocate!  Contact sgriffis@colormarketing.org to find out more.
                                        </p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dataTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover tablesaw tablesaw-columntoggle tablesaw-sortable filter-table dataTable"
                                       data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-mode="columntoggle"
                                       data-tablesaw-minimap data-role="table" data-filter="true" id="ks-dataTable">
                                    <thead>
                                    <tr>
                                        <th scope="col" data-tablesaw-priority='persist'></th>
                                        <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>File Name</th>
                                        <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='1'>Last Modified</th>
                                        <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='2'>Catagory</th>
                                        <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>Download</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th scope="col" data-tablesaw-priority='persist'></th>
                                        <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>File Name</th>
                                        <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='1'>Last Modified</th>
                                        <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='2'>Catagory</th>
                                        <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority='persist'>Download</th>
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
                                                    {{ $file->updated_at }}
                                                </td>
                                                <td>
                                                    {{ $file->category }}
                                                </td>
                                                <td>
                                                    <a href="download/{{ $file->filename }}" target="_blank"><span class="la la-download la-2x"></span></a>
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
    </div>
@endsection
