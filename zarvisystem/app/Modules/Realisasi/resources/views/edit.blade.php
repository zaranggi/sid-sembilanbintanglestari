@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" /> 

<link href="{{ asset("plugins/bootstrap-calendar/css/bootstrap_calendar.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")}}" rel="stylesheet" /> 
@stop
@section('content')

@foreach($data as $rr)

    <h1 class="page-header">Data Realisasi <small> KPR </small></h1>
	
	<div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Data Unit </h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">                    
                    <div class="invoice">
						<!-- begin invoice-company -->
						<div class="invoice-company"> 
							MOU Konsumen : {{ $rr->kode }}
						</div>
						<!-- end invoice-company -->
						<!-- begin invoice-header -->
						<div class="invoice-header">
							<div class="invoice-from">
								<small>Konsumen</small>
								<address class="m-t-5 m-b-5">
									<strong class="text-inverse">{{ $rr->nama_konsumen }}</strong><br />
									Alamat: {{ $rr->alamat }}<br /> 
									Phone: {{ $rr->telp }}<br /> 
								</address>
							</div>
							<div class="invoice-to">
								<small>Unit</small>
								<address class="m-t-5 m-b-5">
									<strong class="text-lime">{{ $rr->nama_properti }}</strong><br/>
									Kavling {{ $rr->nama_kav }} / Tipe {{ $rr->tipe_unit }}<br/> 
								</address>
							</div>
							<div class="invoice-date">
								<small>Tanggal MOU</small>
								<div class="date text-info m-t-5">{{App\Helpers\Tanggal::tgl_indo($rr->tgl_transaksi) }}</div>
								<div class="invoice-detail">
									Tanggal SP3K<br />
									<strong class="text-warning">{{App\Helpers\Tanggal::tgl_indo($rr->tanggal_sp3k) }}</strong>
								</div>
							</div>
						</div>
						<!-- begin invoice-content -->
						<div class="invoice-content">
							 
							<!-- begin invoice-price -->
							<div class="invoice-price">
								 
                                <div class="invoice-price-right">
									<small class="text-lime">Harga Jual</small> <span class="f-w-400">{{ number_format($rr->gross_total) }}</span>
								</div>
                                <div class="invoice-price-right">
									<small class="text-lime">Total KPR</small> <span class="f-w-400">{{ number_format($rr->sp3k_nominal) }}</span>
								</div>
                                <div class="invoice-price-right">
									<small class="text-lime">Penerimaan Real</small> <span class="f-w-400">{{ number_format($rr->terbayar) }}</span>
								</div> 
                                <div class="invoice-price-right">
									<small class="text-lime">Dana Ditahan</small> <span class="f-w-400">{{ number_format($rr->dana_ditahan) }}</span>
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
                    <h4 class="panel-title">Data Realisasi </h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">        
                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <a href="#modal-dialog" class="btn btn-lime text-successed bayar" data-toggle="modal">
                            <i class="fa fa-money-bill-wave"></i> Add Realisasi
                        </a>
                        @if(Session::has('flash_message'))
                            <div class="alert alert-info ">
                          <span class="glyphicon glyphicon-ok">
                          </span><em>  ~  {{ Session::get('flash_message') }}</em>
                            </div>
                        @endif
                    
                        <hr/>
                        <div class="table-responsive">
                        <table id="data-table"  class="table table-bordered table-hover width-full">
                            <thead>
                                <tr class="text-center text-nowrap">  
                                    <th>Tanggal</th> 
                                    <th>Bank Real</th> 
                                    <th>Jumlah</th>  
                                    <th>Keterangan</th> 
                                    <th>Admin</th>                                    
                                </tr>

                            </thead>
                            <tbody>
                                @foreach($realisasi as $r)
                                <tr>
                                <td class="text-center text-nowrap">{{ App\Helpers\Tanggal::tgl_indo($r->tanggal_realisasi)}}</td>
                                <td class="text-left text-nowrap">{{$r->bank}}</td>
                                <td class="text-right text-nowrap">Rp {{ number_format($r->nominal)}}</td>
                                <td class="text-left text-nowrap">{{$r->keterangan}}</td>
                                <td class="text-center text-nowrap">{{$r->created_by}}</td>
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
                    <h4 class="panel-title">Pendapatan Diterima Dimuka</h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">        
                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">  
                        <div class="table-responsive">
                        <table id="data-table"  class="table table-bordered table-hover width-full">
                            <thead>
                                <tr class="text-center text-nowrap">  
                                    <th>Keterangan</th> 
                                    <th>Tagihan</th> 
                                    <th>Terbayar</th>  
                                    <th>Status</th>                                     
                                </tr>

                            </thead>
                            <tbody>
                                @foreach($konsumen_bayar as $r)
									@if($r->tagihan1  > 0)
									<tr>
										<td class="text-center text-nowrap">Booking Fee (Tanda Jadi)</td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->tagihan1)}}</td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->bayar1)}}</td>
										<td class="text-left text-nowrap">
											@if($r->bayar1 == $r->tagihan1) 
												Lunas
											@else 
												Belum Lunas
											@endif
											</td>
									</tr>
									@endif
									@if($r->tagihan2  > 0)
									<tr>
										<td class="text-center text-nowrap">Uang Muka</td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->tagihan2)}}</td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->bayar2)}}</td>
										<td class="text-left text-nowrap">
											@if($r->bayar2 == $r->tagihan2) 
												Lunas
											@else 
												Belum Lunas
											@endif
											</td>
									</tr>
									@endif
									@if($r->tagihan3  > 0)
									<tr>
										<td class="text-center text-nowrap">Penambahan Tanah</td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->tagihan3)}}</td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->bayar3)}}</td>
										<td class="text-left text-nowrap">
											@if($r->bayar3 == $r->tagihan3) 
												Lunas
											@else 
												Belum Lunas
											@endif
											</td>
									</tr>
									@endif
									
									@if($r->tagihan4  > 0)
									<tr>
										<td class="text-center text-nowrap">Penambahan Bangunan</td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->tagihan4)}}</td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->bayar4)}}</td>
										<td class="text-left text-nowrap">
											@if($r->bayar4 == $r->tagihan4) 
												Lunas
											@else 
												Belum Lunas
											@endif
											</td>
									</tr>
									@endif
									@if($r->tagihan5 > 0)
									<tr>
										<td class="text-center text-nowrap">Cicilan Unit</td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->tagihan5)}}</td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->bayar5)}}</td>
										<td class="text-left text-nowrap">
											@if($r->bayar5 == $r->tagihan5) 
												Lunas
											@else 
												Belum Lunas
											@endif
											</td>
									</tr>
									@endif
									@if($r->tagihan7 > 0)
									<tr>
										<td class="text-center text-nowrap">Kekurangan Realisasi</td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->tagihan7)}}</td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->bayar7)}}</td>
										<td class="text-center text-nowrap">
											@if($r->bayar7 == $r->tagihan7) 
												Lunas
											@else 
												Belum Lunas
											@endif
											</td>
									</tr>
									@endif
									
                                @endforeach 

                            </tbody>
							<tfoot>
								<tr class="bg-lime font-weight-bold">
									<td colspan="3" class="text-center text-nowrap">Total Pendapatan Diterima Dimuka</td> 
									<td	class="text-right text-nowrap">Rp {{ number_format($r->bayar1 + $r->bayar2 + $r->bayar3 + $r->bayar4 + $r->bayar5 + $r->bayar6 + $r->bayar7)}}</td>									 
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
   
   
   
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Biaya-biaya</h4> 
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">        
                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">  
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover width-full">
                            <thead>
                                <tr class="text-center text-nowrap">  
                                    <th>Keterangan</th>  
                                    <th>Nilai Termin</th>  
                                    <th>Terbayar</th>                                  
                                </tr>
                            </thead>
                            <tbody>
							@php 
								$t = 0;
							@endphp
                                @foreach($bpembangunan as $r) 
									@if($r->nilai_termin > 0)
									<tr>
										<td class="text-center text-nowrap">Biaya Pembangunan Unit</td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->nilai_termin)}}</td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->jumlah_bayar)}}</td> 
									</tr> 
									@endif
									
									@php 
										$t += $r->jumlah_bayar;
									@endphp
                                @endforeach 
                                @foreach($brevisi as $r) 
									@if($r->nilai_termin_rev > 0)
									<tr>
										<td class="text-center text-nowrap">Biaya Revisi Unit</td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->nilai_termin_rev)}}</td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->jumlah_bayar_rev)}}</td> 
									</tr> 
									@endif 									
									@php 
										$t += $r->jumlah_bayar_rev;
									@endphp
                                @endforeach 
								
                                @foreach($bmaterial as $r)  
									@if($r->biaya_material > 0)
									<tr>
										<td class="text-center text-nowrap">Biaya Penggunaan Material</td>
										<td	class="text-right text-nowrap"> - </td>
										<td	class="text-right text-nowrap">Rp {{ number_format($r->biaya_material)}}</td> 
									</tr>  
									@endif							
									@php 
										$t += $r->biaya_material;
									@endphp
                                @endforeach 

                            </tbody>
							<tfoot>
								<tr class="bg-lime font-weight-bold">
									<td colspan="2" class="text-center text-nowrap">Total Biaya</td> 
									<td	class="text-right text-nowrap">Rp {{ number_format($t)}}</td>									 
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
	 
    <!-- #modal-dialog -->
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">                    
                    <h4 class="modal-title">Penerimaan Realisasi</h4>
					<button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="{{ url("realisasi")}}">
                        @csrf  
                    <input type="hidden" name="id_spr" id="id_spr" value="{{$rr->id}}">
                        
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Tanggal</label>
                            <div class="col-md-6"> 
                                <div class="input-group" id="daterange-singledate">
                                    <input type="text" name="tanggal" id="datepicker-default" class="form-control" placeholder="Pilih Tanggal" required/>
                                    <span class="input-group-btn">
                                        <i class="fa fa-calendar-alt text-info"></i>
                                    </span>
                                </div>                            
                            </div>
                        </div> 
						
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 font-weight-bold">Penerima (Bank Perusahaan)</label>
                            <div class="col-md-6"> 
                                <select class="form-control pilih" id="bank_pengirim" name="bank_pt">
                                    <option value="" selected>Pilih Bank Perusahaan</option>                         
                                    @foreach($bank_pt as $r)
                                        <option value="{{$r->acc_kode}}">{{$r->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3">Total Realisasi</label>
                            <div class="col-md-5"> 
                                <input type="text" name="gross"  class="form-control rupiah text-right" required>                            
                            </div>
                        </div>
						
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Keterangan</label>
                            <div class="col-md-8"> 
                                <textarea name="keterangan"  class="form-control" rows="3" placeholder="Keterangan" ></textarea> 
                            </div>
                        </div>  
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a> 
                    <button type="submit" id="simpan" name="simpan" class="btn width-100 btn-primary">Simpan</button> 
                </div>
            </form>  
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

<script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{ asset('plugins/select2/dist/js/select2.min.js')}}"></script> 

<script type="text/javascript"> 
    $('.nomor').number(true, 0, ',', ' ');
    $('.rupiah').number(true, 0,);
</script>

<script>
    $(document).ready(function() { 
        PageDemo.init();
    });
    $(document).on('click', '#simpan', function(){  
    $('#simpan').hide();    
         
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
            
            $(".pilih").select2();
            $('#tipe').change(function(){
                var id = $(this).val();
                if(id == "Cash"){
                    $('#tampil').hide();
                    $('#norek_pengirim').val("");
                    
                    $('#id_bank').val("");
                    $('#norek_pengirim').val("");
                }else{
                    $('#tampil').show();
                }
            });
        });
    </script>
    
@stop


