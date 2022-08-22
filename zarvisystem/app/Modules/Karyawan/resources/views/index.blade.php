@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Data  <small>Karyawan</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">List All Karyawan</h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <a href="{{ route('karyawan.create') }}" class="btn  btn-primary mb-5">
                        <i class="icon-plus3 "></i> Tambah Data
                    </a>

                    @if(Session::has('flash_message'))
                        <div class="alert alert-info ">
                      <span class="glyphicon glyphicon-ok">
                      </span><em>  ~  {{ Session::get('flash_message') }}</em>
                        </div>
                    @endif

                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                            <table id="data-table"  class="table table-bordered table-hover width-full"">
                                <thead>
                                    <tr class="text-center">
                                        <th  data-sorting="disabled">No.</th>
                                        <th >Nik</th>
                                        <th >Nama</th>
                                        <th >Jabatan</th>
                                        <th >Username</th>
                                        <th >Blocked?</th>
                                        <th > actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; ?>
                                    @foreach($listusers as $r)
                                        <tr>
                                            <td class="text-center">{{ $no }}</td>
                                            <td class="text-center">{{  $r->nik }}</td>
                                            <td>{{ $r->name }}</td>
                                            <td >{{  $r->name_jabatan }}</td>
                                            <td >{{  $r->username }}</td>
                                            <?php
                                            $r->is_blocked ==0 ? $tampil = "<td class=\"text-center\"><i class=\"fa fa-unlock\" style=\"color:#21d617\"></i>"
                                                :
                                                $tampil = "<td  class=\"text-center \"><i class=\"fa fa-lock \" style=\"color:red\"></i>";
                                            echo $tampil." </td>";
                                            ?>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-align-right text-successed"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-158px, 19px, 0px);">
                                                        <a href="{{ route('karyawan.edit', $r->id) }}" class="dropdown-item">
                                                            <i class="fa fa-pen-alt text-successed"></i> Edit
                                                        </a>
                                                        <a href="{{ route('karyawan.destroy', $r->id) }}" data-method="delete" data-confirm="User ini akan di-blok?" rel="nofollow" class="dropdown-item">
                                                            <i class="fa fa-trash-alt text-danger"></i> Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $no++; ?>
                                    @endforeach 
                                    
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <!-- end table-responsive -->
                </div>
                <!-- end panel-body -->
            </div>
        </div>
    </div>
    @stop 
    @section('scripts')
    <script src="{{ asset("plugins/DataTables/media/js/jquery.dataTables.js") }}"></script>
    <script src="{{ asset("plugins/DataTables/media/js/dataTables.bootstrap.min.js") }}"></script>
    <script src="{{ asset("plugins/DataTables/extensions/Select/js/dataTables.select.min.js") }}"></script> 
    <script src="{{ asset("js/page-table-manage-select.demo.min.js") }}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script>
        $(document).ready(function() { 
            PageDemo.init();
        });
    </script>
    
    <script src="{{ asset('js/datadelete.js') }} "></script>
    <script type="text/javascript">
        window.csrfToken = '<?php echo csrf_token(); ?>';
    </script>
    
    @stop
    