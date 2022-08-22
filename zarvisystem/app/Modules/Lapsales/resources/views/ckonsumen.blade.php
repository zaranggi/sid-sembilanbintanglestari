@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Laporan Calon Konsumen  <small> Marketing</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">List All </h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">  

                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0 table-responsive">
                        
                        <table id="data-table"  class="table table-bordered table-hover width-full"">
                            <thead>
                                <tr class="text-center">
                                    <th  data-sorting="disabled">Kode</th>
                                    <th >Nama</th>
                                    <th >IDCARD</th>
                                    <th >Alamat</th>
                                    <th >Kontak</th>
                                    <th >Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                @foreach($data as $r)
                                    <tr>
                                        <td class="text-center">{{ $r->kode }}</td>
                                        <td class="text-nowrap">{{ $r->nama }}</td>
                                        <td class="text-nowrap">{{ $r->idcard }}</td>
                                        <td class="text-nowrap">{{ $r->alamat }}</td>
                                        <td class="text-nowrap">{{ $r->kontak }}</td>
                                        <td class="text-nowrap">{{ $r->email }}</td>
                                        
                                    </tr>
                                    <?php $no++; ?>
                                @endforeach 
                                 
                            </tbody>
                        </table> 
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
    