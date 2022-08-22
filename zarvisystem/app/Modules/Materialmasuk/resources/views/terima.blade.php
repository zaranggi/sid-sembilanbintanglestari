@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />

<link href="{{ asset("plugins/bootstrap-calendar/css/bootstrap_calendar.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")}}" rel="stylesheet" /> 

<style type="text/css">
           
    #wrapper{background: -moz-linear-gradient(top,  darkslategray , azure);
     background:-ms-linear-gradient(top, brown, brown);
     background:-o-linear-gradient(top, brown, brown);
     }
     
     #loader {
           text-align: center;
           display: none;
     }
       
     #loaderCircle {
         text-align: center;
         z-index: 100;
         position: fixed;
         left: 45%;
         top: 50px;
         width: 200px;
         padding: 10px;
         background: #000; 
         opacity: 0.8;
         color: #FFF;
         -webkit-border-radius: 10px;
         -moz-border-radius: 10px;
         border-radius: 10px;
     }

.shape{    
     border-style: solid; border-width: 0 70px 40px 0; float:right; height: 0px; width: 0px;
     -ms-transform:rotate(360deg); /* IE 9 */
     -o-transform: rotate(360deg);  /* Opera 10.5 */
     -webkit-transform:rotate(360deg); /* Safari and Chrome */
     transform:rotate(360deg);
 }
 .offer{
     background:#fff; border:1px solid #ddd; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); margin: 15px 0; overflow:hidden;
 }
 
 .shape {
     border-color: rgba(255,255,255,0) #d9534f rgba(255,255,255,0) rgba(255,255,255,0);
 }
 .offer-radius{
     border-radius:7px;
 }
 .offer-danger {	border-color: #d9534f; }
 .offer-danger .shape{
     border-color: transparent #d9534f transparent transparent;
 }
 .offer-success {	border-color: #5cb85c; }
 .offer-success .shape{
     border-color: transparent #5cb85c transparent transparent;
 }
 .offer-default {	border-color: #999999; }
 .offer-default .shape{
     border-color: transparent #999999 transparent transparent;
 }
 .offer-primary {	border-color: #428bca; }
 .offer-primary .shape{
     border-color: transparent #428bca transparent transparent;
 }
 .offer-info {	border-color: #5bc0de; }
 .offer-info .shape{
     border-color: transparent #5bc0de transparent transparent;
 }
 .offer-warning {	border-color: #f0ad4e; }
 .offer-warning .shape{
     border-color: transparent #f0ad4e transparent transparent;
 }

 .shape-text{
     color:#fff; font-size:12px; font-weight:bold; position:relative; right:-40px; top:2px; white-space: nowrap;
     -ms-transform:rotate(30deg); /* IE 9 */
     -o-transform: rotate(360deg);  /* Opera 10.5 */
     -webkit-transform:rotate(30deg); /* Safari and Chrome */
     transform:rotate(30deg);
 }	
 .offer-content{
     padding:0 20px 10px;
 }
 

</style>

@stop 
@section('content')

<div id="loader">
    <div id="loaderCircle">
        <img alt="Loading ...." src="http://45.127.133.123/survey/asset/images/loader_big.gif" width="15px"  /><span id="loaderText"></span>
    </div>
</div>

<h1 class="page-header">Form <small>Material Masuk </small></h1>
	
<div class="row">
    <!-- begin col-6 -->
    <div class="col-lg-12">
        <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Penerimaan Material </h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
			<div class="panel-body">
				<!-- begin panel --> 
                <form id="simpanmaterial" method="POST" action="javascript:void(0)"> 
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
					@foreach($dd as $rr)
					@endforeach
                    <input type="hidden" name="docno" value="{{ $rr->docno }}">
                    <input type="hidden" name="cb" value="{{ $rr->pembayaran }}">
				 
					<div class="row">
						<div class="col-lg-5">
                            <div class="form-group row m-l-15">
								<label class="col-form-label col-md-4">Terima Dari</label>
								<div class="col-md-6"> 
								<select name="dari" class="default-select2 form-control" placeholder="Pilih Perumahan" readonly>		<option value="{{ $rr->nama_rekanan }}">{{ $rr->nama_rekanan }} :: {{ $rr->alamat }}</option>      
									</select>
								</div>
							</div> 
							<div class="form-group row m-l-15">
								<label class="col-form-label col-md-4 ">Nomor</label>
								<div class="col-md-6"> 
										<input type="text" value="PO-0{{$rr->docno}}" class="form-control" placeholder="Nomor Dokumen" readonly/>
								</div>
							</div>   
							
							
							 
						</div>
						<div class="col-lg-7">
                            <div class="form-group row m-l-15">
								<label class="col-form-label col-md-4">Tanggal PO</label>
								<div class="col-md-6"> 
									<div class="input-group" id="daterange-singledate">
										<input type="text" value="{{$rr->tanggal}}"  class="form-control" placeholder="Pilih Tanggal" readonly/>
										<span class="input-group-btn">
											<i class="fa fa-calendar-alt text-info"></i>
										</span>
									</div>                            
								</div>
							</div>   
							
                            <div class="form-group row m-l-15">
								<label class="col-form-label col-md-4">Tanggal Penerimaan</label>
								<div class="col-md-6"> 
									<div class="input-group" id="daterange-singledate">
										<input type="text" name="tanggal" id="tanggal" class="form-control" placeholder="Pilih Tanggal" required/>
										<span class="input-group-btn">
											<i class="fa fa-calendar-alt text-info"></i>
										</span>
									</div>                            
								</div>
							</div>
                           
							<div class="form-group row m-l-15">
								<label class="col-form-label col-md-4">Keterangan Penerimaan</label>
								<div class="col-md-6"> 
									<textarea name="keterangan"  class="form-control" rows="2" placeholder="Keterangan" ></textarea> 
								</div>
							</div>
						</div>
					</div>

                    
                     <br/>
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover width-full" id="listitem">
                                <thead>
                                    <tr class="bg-lime">
                                        <th class="text-center">PLU</th>
                                        <th class="text-center">Nama Material</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">QTY PO</th>
                                        <th class="text-center">Harga PO</th>
                                        <th class="text-center">Total PO</th>
										
                                        <th class="text-center">QTY</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Total Belanja</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody> 
										@foreach($data as $r)
										<tr>
											<td class="text-center">{{$r->prdcd}}</td>
											<td>{{$r->desc2}}</td>
											<td class="text-center">{{$r->satuan}}</td>
											<td class="text-right">{{ number_format($r->qty)}}</td>
											<td class="text-right" >{{number_format($r->harga)}}</td>
											<td class="text-right">{{number_format($r->total)}}</td>
											
											<td class="text-right"><input type="text" id="qtynya" name="qty_{{$r->prdcd}}" value="{{$r->qty}}" class="form-control rupiah form-control-sm text-right"></td>
											<td class="text-right"><input type="text" id="pricenya" name="price_{{$r->prdcd}}" value="{{$r->harga}}" class="form-control rupiah form-control-sm text-right"></td>
											
											<td class="text-right font-weight-bold text-warning" >
												<input type="text" value="{{$r->total}}" id="hitung" name="t_{{$r->prdcd}}" class="form-control rupiah form-control-sm text-right">
											</td>
											
											<td class="text-right">
												<a href='javascript:void(0);' class='delete-row'>
													<i class='fa fa-trash-alt text-danger'></i>
												</a>
											</td>
										</tr>
										
										@endforeach
										<tr class="font-weight-bold ">
											<td colspan="8" class="text-center text-warning">Total Penerimaan</td>
											
											<td class="text-right text-lg text-warning" id="totalall">
											</td>
										</tr>
                                   
                                </tbody>  
                            </table>
                        </div>
                    </div>

                    <div class="border-top my-1 m-b-15"></div> 
                    <div class="m-b-15">
                        <button type="submit"  id="submit" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-success btn-block btn-lg">Simpan Penerimaan Material</button>
                    </div>
                </form>  
			</div>
	</div>
</div> 
 
@stop
 
@section('scripts')

<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script>
   
<script src="{{ asset('js/jquery.number.js') }}"></script> 

<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript"> 
    $('.nomor').number(true, 0, ',', ' ');
    $('.rupiah').number(true, 0,);
</script>

<script type="text/javascript"> 
    $(document).ready(function() {   
        $("#tanggal").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            });
		$(".default-select2").select2();
		calculateTotal();
    });
</script>
 
<script type="text/javascript"> 
    function tandaPemisahTitik(b){
        var _minus = false;
        if (b<0) _minus = true;
        b = b.toString();
        b=b.replace(",","");
        b=b.replace("-","");
        c = "";
        panjang = b.length;
        j = 0;
        for (i = panjang; i > 0; i--){
            j = j + 1;
            if (((j % 3) == 1) && (j != 1)){
                c = b.substr(i-1,1) + "," + c;
            } else {
                c = b.substr(i-1,1) + c;
            }
        }
        if (_minus) c = "-" + c ;
        return c;
    }

    var intVal = function ( i ) {
        return typeof i === 'string' ?
            i.replace(/[\$,]/g, '')*1 :
            typeof i === 'number' ?
                i : 0;
    };
 
    function calculateTotal(){
        var totalAmount = 0;
        $("[id^='hitung']").each(function() {
            var x = $(this).val(); 
				rp = intVal(x); 
				totalAmount += rp;
				
        });

        $('#totalall').text(tandaPemisahTitik(parseFloat(totalAmount)));
    }

</script>


<script type="text/javascript"> 
    $(document).ready(function(){ 
        // Find and remove selected table rows
        $("#listitem").on('click','.delete-row',function(){
			$(this).parent().parent().remove();
			calculateTotal();
		});
		
		$("[id^='qtynya']").keyup(function(index) {
			var qty  = $(this).val();
			var id = $(this).attr('name'); 
            id = id.replace("qty_",''); 
            var pricex = $('input[name=price_'+id+']').val();
            price = intVal(pricex); 
			var h = intVal(qty) * price; 
			$('input[name=t_'+id+']').val(h);
			calculateTotal();
			
		});
		$("[id^='pricenya']").keyup(function(index) {
			var qty  = $(this).val();
			var id = $(this).attr('name'); 
            id = id.replace("price_",''); 
            var pricex = $('input[name=qty_'+id+']').val();
            price = intVal(pricex); 
			var h = intVal(qty) * price; 
			$('input[name=t_'+id+']').val(h);
			calculateTotal();
			
		});
    });    
</script>


<script type="text/javascript">

$(document).ready(function(){
    $("#simpanmaterial").submit(function(){  
		$('#submit').hide();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ url('materialmasuk/simpan') }}",
            method:"POST",
            data:$('#simpanmaterial').serialize(),
            beforeSend: function(){
                loaderOpen("Loading Prosses");
            },
            success:function(data){
                loaderClose();
                if(data.status == true){
                    Swal.fire({
                    title: "Pesan informasi",
                    text:  data.msg,
                    icon: "success",
                    }).then(function() {
                    window.location = "{{url('materialmasuk')}}";
                });  
                }else{
                    Swal.fire({
                    title: "Pesan informasi",
                    text:  data.msg,
                    icon: "error",
                    }).then(function() {
					$('#submit').show();
					});  
                }
                
            },
            error: function(){
                loaderClose(); 
                Swal.fire({
                    title: "Pesan informasi",
                    text:  data.msg,
                    icon: "error",
                    }).then(function() {
                    window.location = "{{url('materialmasuk')}}";
					$('#submit').show();
                });
                    
                
            }
        });

            
    });

    function loaderOpen(text){
                    $('#loaderText').html(text);
                    $('#loader').show();
                } 
    function loaderClose(){
                    $('#loaderText').html('');
                    $('#loader').hide();
                }

});
</script>
@stop
