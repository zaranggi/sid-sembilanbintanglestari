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


     
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Pembayaran Subkon Pembangunan Unit</h4>
                    
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
                                <tr class="text-center"> 
                                    <th class="text-nowrap">Perumahan</th>
                                    <th class="text-nowrap" >Kavling</th>
                                    <th class="text-nowrap" >Tipe Unit</th>
                                    <th class="text-nowrap">Nama Subkon</th>
                                    <th class="text-nowrap">Tgl App Direksi</th> 
                                    <th class="text-nowrap">Keterangan Direksi</th> 
                                    <th class="text-nowrap">Nominal</th> 
                                    <th class="text-nowrap">Bayar</th> 
                                </tr>

                            </thead>
                             <tbody>
                        @foreach($data as $r)

                            <tr>
                                <td class="text-nowrap">{{ $r->nama_properti }}</td>
                                <td  class="text-center text-nowrap">{{  $r->nama_kav }}</td>
                                <td  class="text-center text-nowrap">{{  $r->tipe_unit }}</td>
                                <td class="text-nowrap">{{ $r->nama_subkon }}</td>
                                <td class="text-center" >{{  App\Helpers\Tanggal::tgl_indo($r->tanggal_app) }}</td>
                                <td class="text-left text-nowrap">{{  $r->keterangan_app }}</td>    
                                <td class="text-right" >Rp {{  number_format($r->bayar) }}</td>                            
                                <td class="text-center">    
								 
										<a href="#modal-dialog" id="{{ $r->id_termin }}-{{ $r->id }}" class="text-successed bayar" data-toggle="modal">
                                                <i class="fa fa-money-bill-wave"></i> 
                                        </a>
                                  
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
                    
                    <h4 class="modal-title">Pembayaran Subkon</h4>
					<button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="{{ url("paysubkon")}}">
                        @csrf  
                        <input type="hidden" name="id_termin" id="id_termin" value="">
                        
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Tanggal Bayar</label>
                            <div class="col-md-6"> 
                                <div class="input-group" id="daterange-singledate">
                                    <input type="text" name="tgl_bayar" id="datepicker-default" class="form-control" placeholder="Pilih Tanggal" required/>
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
								<label class="col-form-label col-md-3 font-weight-bold">Bank Penerima</label>
								<div class="col-md-6"> 
									<select class="form-control pilih" id="bank_penerima" name="bank_penerima">
										<option value="" selected>Pilih Bank Penerima</option>                         
										@foreach($bank as $r)
											<option value="{{$r->nama}}">{{$r->nama}}</option>                         
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-form-label col-md-3">No.Rek Penerima</label>
								<div class="col-md-5"> 
									<input type="text" name="norek_penerima"  id="norek_penerima" class="form-control text-right">                            
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

                    <button type="submit" id="simpan" name="simpan" class="btn width-100 btn-primary">Simpan</button>
            
                </div>
            </form>  
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
				$('#norek_penerima').val("");
				
				$('#id_bank').val("");
				$('#bank_penerima').val("");
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
    var id_termin = $(this).attr("id");   
    //$('#id_tagihan').empty();
    $('#id_termin').val(id_termin);    
         
});  

$(document).on('click', '#simpan', function(){   
    $('#simpan').hide();    
         
}); 
</script>

@stop

