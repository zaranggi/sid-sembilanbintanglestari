@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Histori  <small>Transaksi</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">List All Transaksi</h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">  

                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                        <table id="data-table"  class="table table-bordered table-hover width-full">
                            <thead>
                                <tr class="text-center"> 
                                    <th>No</th> 
                                    <th>Kode Transaksi</th> 
                                    <th>Kode Tagihan</th> 
                                    <th>Unit</th> 
                                    <th>Keterangan</th> 
                                    <th>Tanggal</th> 
                                    <th>Pembayaran</th> 
                                    <th>Bank</th> 
                                    <th>Nominal</th>      
                                    <th>Created At</th>                                     
                                </tr>
								 

                            </thead>
                             <tbody>
                                @php $no=1; @endphp 
                        @foreach($data as $r)
                            @php 
                                if($r->isread == 0){
                                    $style = "bg-lime";
                                }else{
                                    $style = "";
                                }
                            
                            
                            @endphp 
                            <tr class="text-nowrap {{$style}}" >
                                <td class="text-center">{{ $no }}</td> 
                                <td class="text-center">{{ $r->kode }}</td> 
                                <td class="text-center">{{ $r->kode_tagihan }}</td> 
                                <td class="text-center">{{ $r->nama_properti }} - {{ $r->nama_kav }}</td> 
                                <td class="text-left">{{ $r->keterangan }}</td> 
                                <td class="text-center">{{ App\Helpers\Tanggal::tgl_indo($r->tanggal) }}</td> 
                                <td class="text-center">{{ $r->tipe_pembayaran }}</td> 
                                <td class="text-left">{{ $r->bank }}</td> 
                                <td class="text-right">Rp {{ number_format($r->jumlah) }}</td> 
                                <td class="text-center">{{ App\Helpers\Tanggal::indonesian_date($r->created_at) }}</td> 
                            </tr>

                            @php $no++; @endphp 
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

