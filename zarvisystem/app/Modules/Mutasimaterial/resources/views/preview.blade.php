@extends('admin.layout')

@section('styles')  
	<link href="{{ asset("plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css") }}" rel="stylesheet" />
	<link href="{{ asset("plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Data mutasi  <small>Stock Material </small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" >
                <!-- begin panel-heading -->
                <div class="panel-heading"> 
				Periode : {{ App\Helpers\Tanggal::tgl_indo($tanggal1) }} - {{ App\Helpers\Tanggal::tgl_indo($tanggal2) }}
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                   
                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                        <table id="data-table-responsive" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr class="text-center"> 
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Kode</th>
                                    <th>Nama </th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Harga</th> 
                                    <th>Total</th>
                                    <th>Keterangan</th>
                                </tr>

                            </thead>
                             <tbody>
                                 @php 
                                    $no  = 1;
                                    $total  = 0;
                                 @endphp
                        @foreach($data as $r)
							
							@php 
								if($r->rtype == 'B'){
									$rtype = "Pembelian";
								}elseif($r->rtype == 'K'){
									$rtype = "Retur Produksi";
								}elseif($r->rtype == 'J'){
									$rtype = "Produksi";
								}elseif($r->rtype == 'D'){
									$rtype = "Retur Pembelian";
								}elseif($r->rtype == 'x'){
									$rtype = "Adjustment SO";
								}else{
									$rtype ="";
								}
								
								if($r->rtype  == 'J'){
									$keterangan = $r->nama_properti." : Kav ".$r->nama_kav." : Tipe Unit ".$r->tipe_unit;
								}else{
									$keterangan = $r->keterangan;
								}
								 
							@endphp
							
                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td  class="text-center">{{ $r->tanggal }}</td>
                                <td  class="text-center">{{ $rtype }}</td>
                                <td  class="text-center">{{ $r->prdcd }}</td>
                                <td>{{ $r->nama }}</td> 
                                <td class="text-center" >{{  number_format($r->qty) }}</td> 
                                <td class="text-center" >{{  $r->satuan }}</td> 
                                <td class="text-center" >{{  number_format($r->price) }}</td> 
                                <td class="text-center" >{{  number_format($r->qty * $r->price) }}</td>  
                                <td>{{ $keterangan }}</td> 
                            </tr>
                            @php 
                            $no++;
							
                                    $total  += ($r->qty * $r->price);
                         @endphp
						  
                        @endforeach  

                            </tbody>
							<tfoot>
							  <tr class="bg-lime">
                                <th class="text-center" colspan="8">Grand Total</th> 
                                <th class="text-center" >{{  number_format($total) }}</th> 
								<th></th>
                            </tr>
							</tfoot>

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

	<script src="{{ asset("plugins/datatables.net/js/jquery.dataTables.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables.net-responsive/js/dataTables.responsive.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js") }}"></script>
	<script src="{{ asset("js/demo/table-manage-responsive.demo.js") }}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
 
 
@stop

