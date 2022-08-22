@extends('admin.layout')

@section('styles')  
	<link href="{{ asset("plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css") }}" rel="stylesheet" />
	<link href="{{ asset("plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Data Posisi Permutasi  <small>Stock Material </small></h1>
    
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
						<div class="hljs-wrapper">
								<span class="text-lime font-weight-bold">Keterangan Jenis Mutasi</span></br>
							    B = Pembelian </br>
								K = Retur Produksi</br>
								J = Pemakaian Produksi </br>
								D = Retur Pembelian</br>
								X = Adjustment
						</div>
						</br>
						
                        <div class="table-responsive">
                        <table class="table table-striped table-bordered  table-td-valign-middle">
                            <thead>
                                <tr class="text-center bg-lime" >  
                                    <th  class="align-middle" rowspan="3">Kode</th>
                                    <th  class="align-middle" rowspan="3">Nama</th>
                                    <th  class="align-middle" rowspan="3">Satuan</th>
                                    <th colspan="10">Jenis Mutasi</th>
                                    
                                </tr>
								<tr  class="text-center bg-lime">
									<th colspan="2">B</th>
									<th colspan="2">K</th>
									<th colspan="2">J</th>
									<th colspan="2">D</th>
									<th colspan="2">X</th>
								</tr>
								
								<tr  class="text-center bg-lime">
									<th >QTY</th> 
									<th >GROSS</th> 
									<th >QTY</th> 
									<th >GROSS</th> 
									<th >QTY</th> 
									<th >GROSS</th> 
									<th >QTY</th> 
									<th >GROSS</th> 
									<th >QTY</th> 
									<th >GROSS</th> 
								</tr>

                            </thead>
                             <tbody> 
                        @foreach($data as $r) 
							
                            <tr> 
                                <td  class="text-center">{{ $r->prdcd }}</td>
                                <td>{{ $r->nama }}</td> 
                                <td  class="text-center">{{ $r->satuan }}</td> 
								
                                <td class="text-center" >{{  number_format($r->B) }}</td> 
                                <td class="text-center" >{{  number_format($r->B_GROSS) }}</td>  
                                <td class="text-center" >{{  number_format($r->K) }}</td> 
                                <td class="text-center" >{{  number_format($r->K_GROSS) }}</td>  
                                <td class="text-center" >{{  number_format($r->J) }}</td> 
                                <td class="text-center" >{{  number_format($r->J_GROSS) }}</td>  
                                <td class="text-center" >{{  number_format($r->D) }}</td> 
                                <td class="text-center" >{{  number_format($r->D_GROSS) }}</td>  
                                <td class="text-center" >{{  number_format($r->X) }}</td> 
                                <td class="text-center" >{{  number_format($r->X_GROSS) }}</td>  								
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

