@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />

<link href="{{ asset("plugins/bootstrap-calendar/css/bootstrap_calendar.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")}}" rel="stylesheet" /> 
@stop
@section('content')

@foreach($detailnya as $rr)

    <h1 class="page-header">Data SPK dan Pekerjaan <small> Revisi Unit </small></h1>
	
	<div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Data SPK </h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">                    
                    <div class="invoice">
						<!-- begin invoice-company -->
						<div class="invoice-company">
							 
							Nomor SPK : {{ $rr->kode }}
						</div>
						<!-- end invoice-company -->
						<!-- begin invoice-header -->
						<div class="invoice-header">
							<div class="invoice-from">
								<small>Subkon</small>
								<address class="m-t-5 m-b-5">
									<strong class="text-inverse">{{ $rr->nama_subkon }}</strong><br />
									Alamat: {{ $rr->alamat }}<br /> 
									Phone: {{ $rr->kontak }}<br /> 
								</address>
							</div>
							<div class="invoice-to">
								<small>Unit</small>
								<address class="m-t-5 m-b-5">
									<strong class="text-lime">{{ $rr->nama_properti }}</strong><br/>
									 {{ $rr->judul }}<br/> 
									 {{ $rr->nama_kav }} :: Tipe 
									 {{ $rr->tipe_unit }}<br/> 
								</address>
							</div>
							<div class="invoice-date">
								<small>Termin period</small>
								<div class="date text-info m-t-5">{{App\Helpers\Tanggal::tgl_indo($rr->tanggal_mulai) }}</div>
								<div class="invoice-detail">
									Jadwal BAST<br />
									<strong class="text-warning">{{App\Helpers\Tanggal::tgl_indo($rr->tanggal_bast) }}</strong>
								</div>
							</div>
						</div>
						<!-- begin invoice-content -->
						<div class="invoice-content">
							 
							<!-- begin invoice-price -->
							<div class="invoice-price">
								<div class="invoice-price-left">
									<div class="invoice-price-row"> 
										<div class="sub-price">
											<small>Sudah Terbayar</small>
											<span class="text-inverse">{{ number_format($rr->gross_total - $rr->krgbayar)  }}</span>
										</div> 
										<div class="sub-price">
											<i class="fa fa-plus text-muted"></i>
										</div>
										<div class="sub-price">
											<small>Kurang Bayar</small>
											<span class="text-inverse">{{ number_format($rr->krgbayar) }}</span>
										</div> 
									</div>
								</div>
								<div class="invoice-price-right">
									<small class="text-lime">Total Kontrak</small> <span class="f-w-600">{{ number_format($rr->gross_total) }}</span>
								</div>
							</div>
							<!-- end invoice-price -->
						</div>
					</div>
				</div><!-- end panel-body -->
			</div>
		</div> 
	</div> 
@endforeach
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Data Termin </h4>
                    
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
                                    <th>Termin Ke</th> 
                                    <th>Keterangan</th> 
                                    <th>Kontrak</th> 
                                    <th>Jumlah Bayar</th> 
                                    <th>Tanggal Bayar</th> 
                                    <th>Sisa Bayar/Hutang</th>                  
                                   
                                </tr>

                            </thead>
                             <tbody>
                                
                        @foreach($data as $r)

                            <tr> 
                                <td class="text-center text-nowrap">{{ $r->termin }}</td> 
                                <td class="text-nowrap">{{ $r->ket_termin }}</td> 
                                <td class="text-center text-nowrap">{{ number_format($r->nilai) }}</td> 
                                <td class="text-center text-nowrap">{{ number_format($r->jumlah_bayar) }}</td> 
                                <td class="text-center text-nowrap">{{ App\Helpers\Tanggal::tgl_indo($r->tgl_bayar) }}</td> 
                                <td class="text-center text-nowrap">{{ number_format($r->nilai - $r->jumlah_bayar) }}</td>  
                                 
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
    

    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Progress Proyek </h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    
                    <div class="form-horizontal" role="form"> 
					
                        @if(Session::has('flash_message'))
                        <div class="alert alert-info ">
                            <span class="glyphicon glyphicon-ok">
                            </span><em>  ~  {{ Session::get('flash_message') }}</em>
                        </div>
                        @endif 
						
						<h4 class="panel-title">Detail Pekerjaan</h4>
					
					 <div class="border-top my-3"></div>


                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover ">
                            <thead>
                                <tr class="text-center text-nowrap"> 
                                    <th>No</th>  
                                    <th>List Pekerjaan</th> 
                                    <th>Bobot</th> 
                                    <th>Photo 1</th> 
                                    <th>Photo 2</th> 
                                    <th>Photo 3</th> 
                                    <th>Status</th> 
                                    <th>Tanggal</th>  
                                </tr>

                            </thead>
                             <tbody>
                                @php 
									$no=1;  
								@endphp
                        @foreach($spk as $x) 
						 
                                        <tr>
											<td class="text-center ">{{$no}}</td>
											<td class="text-left text-nowrap">- {{ $x->nama_pekerjaan }}</td> 
											<td class="text-center text-nowrap"> {{ $x->bobot }}%</td> 
											<td class="text-center text-nowrap"> 
											@if($x->photo1 <> "")
												<a href="{{ url('image/project/'.$x->photo1) }}" 
												onclick="window.open(this.href, '_blank', 'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); 
												return false;"><i class="fa fa-camera fa-2x" aria-hidden="true"></i>
												</a>
												@endif
											</td> 
											<td class="text-center text-nowrap"> 
											@if($x->photo2 <> "")
											<a href="{{ url('image/project/'.$x->photo2) }}" 
												onclick="window.open(this.href, '_blank', 'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); 
												return false;"><i class="fa fa-camera fa-2x" aria-hidden="true"></i>
												</a>
												@endif
											</td> 
											
											<td class="text-center text-nowrap"> 
												@if($x->photo3 <> "")
													<a href="{{ url('image/project/'.$x->photo3) }}" 
														onclick="window.open(this.href, '_blank', 'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); 
														return false;"><i class="fa fa-camera fa-2x" aria-hidden="true"></i>
														</a>
												@endif
											</td> 
											<td class="text-center text-nowrap"> 
											@if($x->status == "0")
												<span class="text-warning"> Progress</span>
											@else
												<span class="text-info">Selesai</span>
											@endif</td> 
											
											<td class="text-left text-nowrap text-sm">  {{ App\Helpers\Tanggal::indonesian_date($x->updated_at) }}</td> 
											 
											 
										</tr>
									@php 
										$no++;  
									@endphp
								@endforeach  

                            </tbody>


                        </table>

						</div>
					</div>
				<!-- end table -->
                       
                        <div class="border-top my-3"></div>
						
                     
                </div>
            </div>
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
<script src="{{ asset('js/jquery.number.js') }}"></script> 
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>

<script type="text/javascript"> 
    $('.nomor').number(true, 0, ',', ' ');
    $('.rupiah').number(true, 0,);
</script>

<script>
    $(document).ready(function() { 
        PageDemo.init();
    });
</script>
 
<script type="text/javascript">
    $(document).ready(function() {   
        $("#datepicker-default").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            }); 
        });
</script>

<script type="text/javascript">
    $(document).on('click', '.bayar', function(){  
        var id_termin = $(this).attr("id");   
        
        $('#id_termin').val(id_termin);    
             
    });  
    </script>
    

@stop


