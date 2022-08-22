@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
 
@stop
@section('content') 
    <h1 class="page-header">Laporan <small>Buku Besar</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" >
                <!-- begin panel-heading -->
                <div class="panel-heading">
                <h4 class="panel-title">Periode : {{ App\Helpers\Tanggal::tgl_indo($tanggal1) }} - {{ App\Helpers\Tanggal::tgl_indo($tanggal2) }}</h4>
                    
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
                                        <th class="col-1">Kode</th>
                                        <th class="col-4">Nama Akun</th>
                                        <th class="col-2">Debit</th>
                                        <th class="col-2">Kredit</th>
                                        <th class="col-2">Saldo Akhir</th>
                                        <th class="col-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; ?>
                                    @foreach($listakun as $r)
                                        <tr>
                                            <td class="text-center text-warning font-weight-bold">{{  $r->kode }}</td>
                                            <td class="font-weight-bold">{{  $r->nama_akun }}</td>
                                            <td class="text-right">{{ number_format($nilai_d[$r->kode]) }}</td>
                                            <td class="text-right">{{ number_format($nilai_k[$r->kode]) }}</td>
                                            <td class="text-right">{{ number_format($nilai[$r->kode]) }}</td> 
                                            <td class="text-center">
                                                   <a href="{{ url('gl/preview2/'.$id_properti.'/'.$r->kode.'/'.$tanggal1.'/'.$tanggal2) }}" target="_blank">
                                                            <i class="fa fa-eye text-info"></i> View
                                                   </a> 
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
   
       <script>
        $(document).ready(function() { 
            PageDemo.init(); 
        });
    </script>
     
    @stop
    