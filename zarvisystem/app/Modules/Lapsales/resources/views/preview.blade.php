@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Laporan Penjualan  <small>Per Marketing</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Periode : {{ App\Helpers\Tanggal::tgl_indo($tanggal1) }} s/d {{ App\Helpers\Tanggal::tgl_indo($tanggal2) }}</h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">  
				<h4 class="panel-title text-center m-b-15">Laporan Penjualan <br/>
					Periode : {{ App\Helpers\Tanggal::tgl_indo($tanggal1) }} s/d {{ App\Helpers\Tanggal::tgl_indo($tanggal2) }}</h4>
				<br/><br/><br/>
				<!-- begin table-responsive -->
				 <div class="col-lg-6 col-lg-offset-3">
                    <div class="panel pagination-grey clearfix m-b-0 table-responsive">
                        <div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr class="font-weight-bold text-center bg-indigo text-white">  
										<th colspan="2">KPR </th>
										<th colspan="2">Cash Tempo</th>
										<th colspan="2">Total Penjualan</th> 
									</tr>
									<tr class="font-weight-bold text-center bg-indigo text-white">
										<th>Unit</th>
										<th>Rp</th>
										<th>Unit</th>
										<th>Rp</th>
										<th>Unit</th>
										<th>Rp</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1; ?>
									@foreach($data2 as $r)
										<tr> 
											<td class="text-center text-nowrap font-weight-bold text-warning">{{  number_format($r->kpr) }}</td>
											<td class="text-center text-nowrap font-weight-bold text-warning">{{  number_format($r->kpr_rp) }}</td>
											<td class="text-center text-nowrap font-weight-bold text-info">{{  number_format($r->tempo) }}</td>
											<td class="text-center text-nowrap font-weight-bold text-info">{{  number_format($r->tempo_rp) }}</td>
											<td class="text-center text-nowrap font-weight-bold text-lime">{{  number_format($r->kpr + $r->tempo) }}</td>
											<td class="text-center text-nowrap font-weight-bold text-lime">{{  number_format($r->kpr_rp + $r->tempo_rp) }}</td>
										</tr>
										<?php $no++; ?>
									@endforeach 
									 
								</tbody>
							</table> 
						</div>
                    </div>
                    </div>
                    <!-- end table-responsive -->
					<br/>
					<br/>
					<hr/> 
					
                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0 table-responsive">
                        <div class="table-responsive">
							<table id="data-table"  class="table table-bordered table-hover width-full">
								<thead>
									<tr class="text-center">
										<th rowspan="2" data-sorting="disabled" >No.</th>
										<th rowspan="2">Nama Marketing</th>
										<th rowspan="2">Kontak</th>
										<th colspan="2">KPR </th>
										<th colspan="2">Cash Tempo</th>
										<th colspan="2">Total Penjualan</th>
										<th rowspan="2">Detail Penjualan</th>
									</tr>
									<tr class="text-center">
										<th>Unit</th>
										<th>Rp</th>
										<th>Unit</th>
										<th>Rp</th>
										<th>Unit</th>
										<th>Rp</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1; ?>
									@foreach($data as $r)
										<tr>
											<td class="text-center"  data-sorting="disabled">{{ $no }}</td>
											<td class="text-nowrap">{{ $r->nama_marketing }}</td>
											<td class="text-nowrap">{{ $r->telp }}</td>
											<td class="text-right text-nowrap">{{  number_format($r->kpr) }}</td>
											<td class="text-right text-nowrap">{{  number_format($r->kpr_rp) }}</td>
											<td class="text-right text-nowrap">{{  number_format($r->tempo) }}</td>
											<td class="text-right text-nowrap">{{  number_format($r->tempo_rp) }}</td>
											<td class="text-right text-nowrap">{{  number_format($r->kpr + $r->tempo) }}</td>
											<td class="text-right text-nowrap">{{  number_format($r->kpr_rp + $r->tempo_rp) }}</td>
											<td class="text-center text-nowrap"><a href="{{ url('lapsales/spr/'.$r->id_marketing.'/'.$tanggal1.'/'.$tanggal2)}}" class="text-warning"> <i class="fa fa-search"> </i></a></td>
											
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
    