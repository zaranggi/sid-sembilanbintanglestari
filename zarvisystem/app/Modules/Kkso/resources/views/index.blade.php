@extends('admin.layout')

@section('styles')  
	<link href="{{ asset("plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css") }}" rel="stylesheet" />
	<link href="{{ asset("plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Data KKSO  <small>Stock Material </small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" >
                <!-- begin panel-heading -->
                <div class="panel-heading"> 
				Data Stok Terkini
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
                                    <th>Kode</th>
                                    <th>Nama </th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>

                            </thead>
                             <tbody>
                                 @php 
                                    $no  = 1;
                                    $total  = 0;
                                 @endphp
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td  class="text-center">{{ $r->prdcd }}</td>
                                <td>{{ $r->nama }}</td> 
                                <td class="text-center" >{{  number_format($r->qty) }}</td> 
                                <td class="text-center" >{{  $r->satuan }}</td> 
                                <td class="text-center" >{{  number_format($r->price) }}</td> 
                                <td class="text-center" >{{  number_format($r->qty * $r->acost) }}</td>  
                            </tr>
                            @php 
                            $no++;
							
                                    $total  += ($r->qty * $r->price);
                         @endphp
						  
                        @endforeach  

                            </tbody>
							<tfoot>
							  <tr class="bg-lime">
                                <th class="text-center" colspan="6">Grand Total</th> 
                                <th class="text-center" >{{  number_format($total) }}</th> 
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

