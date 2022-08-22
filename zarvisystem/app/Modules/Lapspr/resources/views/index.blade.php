@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Data MOU  <small>Konsumen</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">List All</h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body"> 
                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <table id="data-table"  class="table table-bordered table-hover width-full"">
                            <thead>
                                <tr class="text-center"> 
                                    <th>Kode</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Perumahan</th>
                                    <th>Kavling</th>
                                    <th>Harga Total </th>
                                    <th>Cara Pembayaran</th>
                                    <th> </th>
                                </tr>

                            </thead>
                             <tbody>
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center">{{ $r->kode }}</td>
                                <td class="text-center" >{{  App\Helpers\Tanggal::tgl_indo($r->tgl_transaksi) }}</td>
                                <td > {{ $r->nama_konsumen}}</td>
                                <td  class="text-center">{{  $r->nama_properti }}</td>
                                <td  class="text-center">{{  $r->nama_kav }}</td>
                                <td class="text-right" >{{  number_format($r->gross_total) }}</td>
                                <td  class="text-center">{{  strtoupper($r->cara_bayar_unit) }}</td>
                                <td class="text-center">
                                     <a href="{{ url('lapspr/preview/'.$r->id) }}" class="dropdown-item text-successed">
                                                <i class="fa fa-search text-successed"></i> Preview
                                            </a>                                          
                                        
                                </td> 
                            </tr>

                        @endforeach 

                            </tbody>

                        </table>

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

