@extends('admin.layout')

@section('styles')
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />

<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-calendar/css/bootstrap_calendar.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")}}" rel="stylesheet" />
@stop
@section('content')


@foreach($konsumen as $rr)


    <h1 class="page-header">Data Pembayaran <small> Cicilan Unit </small></h1>

	<div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Data Konsumen </h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <div class="invoice">
						<!-- begin invoice-company -->
						<div class="invoice-company">
							Nomor Kontrak : {{ $rr->kode }}
						</div>
						<!-- end invoice-company -->
						<!-- begin invoice-header -->
						<div class="invoice-header">
							<div class="invoice-from">
								<small>Konsumen</small>
								<address class="m-t-5 m-b-5">
									<strong class="text-inverse">{{ $rr->nama }}</strong><br />
									Alamat: {{ $rr->alamat }}<br />
									Phone: {{ $rr->telp }}<br />
									NIK: {{ $rr->idcard }}<br />
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
								<small>Marketing</small>
                                <div class="date text-info m-t-5">{{ $rr->nama_marketing }}</div>
                                <hr/>
                                <strong class="text-lime text-lg font-weight-bold m-b-5">Promo</strong><br/>

                                    <small>{{$rr->bonus}}</small>
							</div>
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
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Pembelian Tunai Bertahap</h4>

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
                        <table id="data-table"  class="table table-bordered table-hover width-full"">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-nowrap">Keterangan</th>
                                    <th class="text-nowrap">Tagihan</th>
                                    <th class="text-nowrap">Pembayaran</th>
                                    <th class="text-nowrap">Kurang</th>
                                    <th class="text-nowrap">Status</th>
                                    <th class="text-nowrap">Jatuh Tempo</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>

                            </thead>
                             <tbody>
                        @foreach($data as $r)

                            <tr>
                                <td > Cicilan Ke - {{  $r->urutan }}</td>
                                <td class="text-right" >{{  number_format($r->tagihan) }}</td>
                                <td class="text-right" >{{  number_format($r->bayar) }}</td>
                                <td class="text-right" >{{  number_format($r->tagihan - $r->bayar) }}</td>
                                <td class="text-center">{{  $r->status }}</td>
                                <td class="text-center  text-nowrap">{{  App\Helpers\Tanggal::tgl_indo($r->tgl_jatuhtempo) }}</td>
                                <td class="text-center">
                                    @if($r->tagihan > $r->bayar)
                                        <a href="#modal-dialog" id="{{ $r->id }}" class="text-successed bayar" data-toggle="modal">
                                            <i class="fa fa-money-bill-wave"></i>
                                        </a>
                                    @endif

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


    <!-- #modal-dialog -->
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Pembayaran Pembelian Bertahap</h4>
					<button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="{{ url("cicilan/simpanbayar")}}">
                        @csrf
                        <input type="hidden" name="id_tagihan" id="id_tagihan" value="">
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3">Terima Dari </label>
                            <div class="col-md-6">
                                <input type="text" name="nama"  class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Tanggal Bayar</label>
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
							<label class="col-form-label  col-md-3 font-weight-bold">Cara Bayar</label>
							<div class="col-md-4">
								<select class="form-control  pilih" id="tipe" name="tipe_pembayaran">
									<option value="Cash" selected>Tunai</option>
									<option value="Transfer">Transfer</option>
								</select>
							</div>
						</div>
						<div id="tampil" style="display:none;">
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
								<label class="col-form-label col-md-3">No.Rek Pengirim</label>
								<div class="col-md-5">
									<input type="text" name="norek_pengirim"  id="norek_pengirim" class="form-control text-right">
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-form-label col-md-3 font-weight-bold">Bank PT</label>
								<div class="col-md-6">
									<select class="form-control pilih" name="id_bank" id="id_bank">
										<option value="" selected>Pilih Bank PT</option>
										@foreach($bank_pt as $r)
											<option value="{{$r->id}}">{{$r->nama}} :: {{$r->nomor_rekening}} An {{$r->atas_nama}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>

                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3">Total Bayar</label>
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

                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Lampiran</label>
                            <div class="col-md-9">
                                <input type="file" name="photo"  class="form-control" placeholder="Photo Bukti Bayar">
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
                    <button type="submit" id="simpan" class="btn width-100 btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


	<div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">History Pembayaran</h4>

                </div>
                <div class="panel-body">
                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover width-full">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-nowrap">No</th>
                                    <th class="text-nowrap">Kode</th>
                                    <th class="text-nowrap">Tanggal</th>
                                    <th class="text-nowrap">Nama </th>
                                    <th class="text-nowrap">Tipe</th>
                                    <th class="text-nowrap">Rek. Pengirim</th>
                                    <th class="text-nowrap">Jumlah</th>
                                    <th class="text-nowrap"></th>
                                </tr>

                            </thead>
                             <tbody>
							 @php $no = 1; @endphp
                        @foreach($his as $r)

                            <tr>
                                <td class="text-center text-nowrap">{{ $no }}</td>
                                <td class="text-center text-nowrap">{{ $r->kode }}</td>
                                <td  class="text-center text-nowrap">{{  App\Helpers\Tanggal::tgl_indo($r->tanggal) }}</td>
                                <td  class="text-nowrap">{{  $r->pembayar }}</td>
                                <td class="text-center text-nowrap">{{ $r->tipe_pembayaran }}</td>
                                <td class="text-nowrap" ><a href="#"> {{ $r->nama_rekening_pengirim  }}</a>  <span class="d-block font-size-sm text-muted">{{ $r->bank_pengirim ." - ". $r->norek_pengirim}}</span>  </h6> </td>
                                <td class="text-right" >{{  number_format($r->jumlah) }}</td>
                                <td class="text-center">
                                    <a href="{{ url('cicilan/cetak/'.$r->id) }}" class="text-lime font-weight-bold" target="_blank">
                                        <i class="fa fa-money-bill-wave"></i>  Cetak
                                    </a>
                                </td>
                            </tr>
                            @php $no++; @endphp
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
<script src="{{ asset("plugins/DataTables/media/js/jquery.dataTables.js") }}"></script>
<script src="{{ asset("plugins/DataTables/media/js/dataTables.bootstrap.min.js") }}"></script>
<script src="{{ asset("plugins/DataTables/extensions/Select/js/dataTables.select.min.js") }}"></script>
<script src="{{ asset("js/page-table-manage-select.demo.min.js") }}"></script>
<script src="{{ asset('js/jquery.number.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>


<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script>
<script type="text/javascript">
    $('.nomor').number(true, 0, ',', ' ');
    $('.rupiah').number(true, 0,);
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
				$('#bank_pengirim').val("");
			}else{
				$('#tampil').show();
			}
		});
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        PageDemo.init();
    });
</script>

<script type="text/javascript">
$(document).on('click', '.bayar', function(){
    var id_tagihan = $(this).attr("id");
    //$('#id_tagihan').empty();
    $('#id_tagihan').val(id_tagihan);

});

$(document).on('click', '#simpan', function(){
    $('#simpan').hide();

});
</script>

@stop

