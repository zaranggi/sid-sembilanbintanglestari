@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Data Konsumen <small>Mundur</small></h1>
    
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
                    
                    <a href="{{ url('mundur/create') }}" class="btn  btn-primary mb-5">
                        <i class="fa fa-plus "></i> Add New
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
                                    <th >No</th>
                                    <th>Perumahan</th>
                                    <th>Kavling</th>
                                    <th>Konsumen</th>
                                    <th>Marketing</th>
                                    <th>Tanggal</th>
                                    <th>Nilai MOU</th>
                                    <th>Tertagih</th> 
                                    <th>Terbayar</th> 
                                    <th>Pengembalian</th> 
                                    <th>Status</th> 
                                    <th></th>
                                </tr>

                            </thead>
                             <tbody>
                                 @php 
                                    $no = 1;
                                 @endphp
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td class="text-center text-nowrap">{{ $r->nama_properti }}</td>
                                <td  class="text-center text-nowrap">{{ $r->nama_kav." / ".$r->tipe_unit }}</td> 
                                
                                <td class="text-center text-nowrap">{{ $r->nama_konsumen }}</td>                                
                                <td class="text-center text-nowrap">{{ $r->nama_marketing }}</td>                                
                                <td class="text-center text-nowrap">{{ App\Helpers\Tanggal::tgl_indo($r->tanggal_mundur) }}</td>        
                                <td  class="text-right text-nowrap">{{  number_format($r->nilai_mou) }}</td>
                                <td  class="text-right text-nowrap">{{  number_format($r->total_tagihan) }}</td>
                                <td  class="text-right text-nowrap">{{  number_format($r->terbayar) }}</td>
                                <td  class="text-right text-nowrap">{{  number_format($r->pengembalian) }}</td> 
                                <td  class="text-center text-nowrap">
                                    @if($r->status == "1")
                                        <span class="label label-lime">Diajukan</span>
                                    @elseif($r->status == 2)
                                        <span class="label label-lime">Disetujui Direksi</span>
                                    @else 
                                        <span class="label label-lime">Ditolak Direksi</span>
                                    @endif
                                   
                                </td> 
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-align-right text-successed"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-158px, 19px, 0px);">
                                            <a href="{{ route('mundur.edit', $r->id_spr) }}" class="dropdown-item">
                                                <i class="fa fa-pen-alt text-successed"></i> Preview
                                            </a> 
                                        </div>
                                    </div>
                                </td> 
                            </tr>
                            @php 
                                $no++;
                            @endphp
                        @endforeach 

                            </tbody>

                        </table>
                    </div>

                    </div>
                </div>
            <!-- end panel-body -->
            </div>
        </div>
    </div>

    <!-- /basic initialization --> 
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

