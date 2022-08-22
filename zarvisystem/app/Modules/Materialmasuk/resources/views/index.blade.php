@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Penerimaan  <small>Pembelian Material </small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Data Penerimaan </h4>
                    
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
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                        <table id="data-table"  class="table table-bordered table-hover width-full">
                            <thead>
                                <tr class="text-center text-nowrap"> 
                                    <th>No PO</th> 
                                    <th>Tgl Pengajuan</th>
                                    <th>Rekanan</th> 
                                    <th>Alamat</th> 
                                    <th>Kontak</th>
                                    <th>Cara Bayar</th> 
                                    <th>Total Pembelian</th> 
                                    <th>Status</th>  
                                    <th></th>  
                                </tr>

                            </thead>
                             <tbody>
                                
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center">PO-0{{ $r->docno }}</td>
                                <td class="text-center  text-nowrap">{{ App\Helpers\Tanggal::tgl_indo($r->tanggal) }}</td> 
                                <td class="text-center text-nowrap">{{ $r->nama_rekanan }}</td> 
                                <td class="text-center text-nowrap">{{ $r->alamat }}</td>  
                                <td class="text-center text-nowrap">{{ $r->kontak }}</td>  
                                <td class="text-center text-nowrap">{{ $r->cara_bayar }}</td>  
                                <td class="text-center text-nowrap">{{ number_format($r->total_bayar) }}</td> 
                                <td class="text-center text-nowrap">
								@if($r->status == 1)
									Pengajuan Baru
								@elseif($r->status == 2)
									Disetujui Manager Produksi
								@elseif($r->status == 4)
									Disetujui Direksi
								@endif
									
								</td> 
                                <td class="text-center text-nowrap">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-align-right text-successed"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-158px, 19px, 0px);">
                                            <a href="{{ url('materialmasuk/terima/'.$r->docno.'/'.$r->cara_bayar) }}" target="_blank" class="dropdown-item text-lime">
                                                <i class="fa fa-edit"></i> Penerimaan
                                            </a>
                                       
                                            
                                        </div>
                                    </div> 

                                </td> 
                            </tr>
                            
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

 

@stop


