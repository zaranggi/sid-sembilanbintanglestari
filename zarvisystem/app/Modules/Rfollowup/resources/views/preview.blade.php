@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Preview  <small>Follow Up</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">List All : Follow Up Konsumen </h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body"> 

                    @if(Session::has('flash_message'))
                        <div class="alert alert-info ">
                      <span class="glyphicon glyphicon-ok">
                      </span><em>  ~  {{ Session::get('flash_message') }}</em>
                        </div>
                    @endif

                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0 table-responsive">
                        
                        <table id="data-table"  class="table table-bordered table-hover width-full"">
                            <thead>
                                <tr class="text-center">
                                    <th  data-sorting="disabled">No.</th>
                                    <th >Nama</th>
                                    <th >Marketing</th>
                                    <th >Tanggal</th>
                                    <th >Progres</th>
                                    <th >Telp/ HP</th>
                                    <th >Melalui</th>
                                    <th > Hasil </th>
                                    <th > Keterangan </th>
                                    <th > Dibuat Oleh </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                @foreach($data as $r)
                                    <tr>
                                        <td class="text-center">{{ $no }}</td>
                                        <td class="text-nowrap">{{ $r->nama_konsumen }}</td>
                                        <td class="text-nowrap">{{ $r->nama_marketing }}</td>
                                        <td class="text-center text-nowrap">{{  App\Helpers\Tanggal::tgl_indo($r->tanggal) }}</td>
                                        <td class="text-center text-nowrap">{{  $r->nama_progres }}</td>
                                        <td class="text-center text-nowrap">{{  $r->telp }}</td>
                                        <td class="text-center text-nowrap">{{  $r->melalui }}</td>
                                        <td class="text-left text-nowrap">{{  $r->hasil }}</td>
                                        <td class="text-left text-nowrap">{{  $r->keterangan }}</td>
                                        <td class="text-center text-nowrap">{{  $r->created_by }}</td>
                                        
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
    