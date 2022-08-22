@extends('admin.layout')

@section('styles')  
	<link href="{{ asset("plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css") }}" rel="stylesheet" />
	<link href="{{ asset("plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Data Booking  <small>Konsumen </small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading"> 
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
                        <table id="data-table-responsive" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr class="text-center"> 
                                    <th>No</th>
                                    <th>Perumahan</th>
                                    <th>Kavling</th>
                                    <th>Tipe</th>
                                    <th>Konsumen</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Tanda Jadi</th>
                                    <th>Marketing</th> 
                                    <th>Status</th> 
                                </tr>

                            </thead>
                             <tbody>
                                 @php 
                                    $no  = 1;
                                 @endphp
                        @foreach($data as $r)
							@if($r->status == 0)
								@php $style = 'bg-pink' @endphp 
							@else 
								@php $style = '' @endphp 
							@endif
                            <tr class="{{ $style }}">
                                <td class="text-center">{{ $no }}</td>
                                <td class="text-center text-nowrap text-lime font-weight-bold">{{ $r->nama_properti }}</td>
                                <td class="text-center" >{{  $r->nama_kav }}</td>
                                <td class="text-center" >{{  $r->tipe_unit }}</td>
                                <td class="text-info text-nowrap" >{{  $r->nama_konsumen }}</td>
                                <td class="text-center" >{{  App\Helpers\Tanggal::tgl_indo($r->tanggal) }}</td>
                                <td class="text-nowrap" >{{  strtoupper($r->keterangan) }}</td>
                                <td class="text-right text-nowrap" >Rp {{  number_format($r->nominal) }}</td> 
                                <td class="text-center text-nowrap">{{$r->nama_marketing}}</td> 
                                <td class="text-center"> 
									@if($r->status == 0)
										Dibatalkan
									@else 
										Ok
									@endif
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

	<script src="{{ asset("plugins/datatables.net/js/jquery.dataTables.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables.net-responsive/js/dataTables.responsive.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js") }}"></script>
	<script src="{{ asset("js/demo/table-manage-responsive.demo.js") }}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
 
 
@stop

