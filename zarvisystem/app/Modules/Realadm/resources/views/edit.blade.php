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
									<small class="text-lime">Total KPR</small> <span class="f-w-400">{{ number_format($rr->sp3k_nominal) }}</span>
								</div>
                                <div class="invoice-price-right">
									<small class="text-lime">Realisasi</small> <span class="f-w-400">{{ number_format($rr->terbayar) }}</span>
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
                    <form enctype="multipart/form-data" method="POST" action="{{ url("realadm")}}">
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
                            <label class="col-form-label col-md-3 font-weight-bold">Bank Pengirim</label>
                            <div class="col-md-6"> 
                                <select class="form-control pilih" id="bank_pengirim" name="bank_pengirim">
                                    <option value="" selected>Pilih Bank Pengirim</option>                         
                                    @foreach($bank as $r)
                                        <option value="{{$r->nama}}">{{$r->nama}}</option>                         
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

<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script> 

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


