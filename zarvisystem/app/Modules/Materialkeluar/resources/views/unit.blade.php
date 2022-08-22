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

<h1 class="page-header">Form <small>Material Keluar </small></h1>
	
<div class="row">
    <!-- begin col-6 -->
    <div class="col-lg-12">
        <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Material Keluar Pembangunan Rumah / Unit</h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
			<div class="panel-body">
				<!-- begin panel --> 
                <form id="simpanmaterial" method="POST" action="javascript:void(0)"> 
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
							
				@if ( count( $errors ) > 0 ) 
					<div class="alert alert-danger"> 
						<strong>Whoops!</strong> 
						There were some problems with your input.<br><br> 
						<ul> 
							@foreach ($errors->all() as $error) 
								<li>{{ $error }}</li> 
							@endforeach 
						</ul> 
		 
                        @endif
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group row m-l-15">
								<label class="col-form-label col-md-4">Properti/Perumahan</label>
								<div class="col-md-6"> 
									<select id="properti" name="id_properti" class="default-select2 form-control" placeholder="Pilih Perumahan" required >
										<option>-- pilih --</option>       
										@foreach($listproperti as $r)                                
											<option value="{{ $r->id }}">{{ $r->nama }}</option>      
										@endforeach
									</select>
								</div>
							</div> 
							<div class="form-group row m-l-15">
								<label class="col-form-label col-md-4">Unit/Kavling</label>
								<div class="col-md-6"> 
									<select id="listunit" name="id_kav" class="default-select2 form-control" placeholder="Pilih Unit"  required >

									</select>
								</div>
							</div>   
							
						</div>
						<div class="col-lg-6"> 
							
							<div class="form-group row m-l-15">
								<label class="col-form-label col-md-4">Tanggal</label>
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
								<label class="col-form-label col-md-4">Keterangan</label>
								<div class="col-md-6"> 
									<textarea name="keterangan"  class="form-control" rows="2" placeholder="Keterangan" ></textarea> 
								</div>
							</div>
						</div>
					</div>

                    <button type="button" class="btn bg-warning m-l-15" data-toggle="modal" data-target="#modal_theme_primary">Input Data <i class="icon-add ml-2"></i></button>
                     <br/>
                     <br/>
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover width-full" id="listitem">
                                <thead>
                                    <tr class="bg-lime">
                                        <th class="col-2 text-center">PLU</th>
                                        <th class="col-5 text-center">Nama Material</th>
                                        <th class="col-2 text-center">Satuan</th>
                                        <th class="col-3 text-center">Volume</th>
                                        <th class="col-3 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>  
                                     
                                </tbody>  
                            </table>
                        </div>
                    </div>

                    <div class="border-top my-1 m-b-15"></div> 
                    <div class="m-b-15">
                        <button type="submit"  id="submit" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-success btn-block btn-lg">Simpan Pengeluaran Material</button>
                    </div>
                </form>  
			</div>
	</div>
</div> 
 

            <!-- Primary modal -->
            <div id="modal_theme_primary" class="modal fade" style="overflow:hidden;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title">Material Keluar</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
							 
							<div class="form-group row m-l-15">
								<label class="col-form-label col-md-3">Material</label>
								<div class="col-md-8">
									<select class="default-select2 form-control datanya" placeholder="Cari / Pilih Material... " name="prdcd">
										@foreach($prodmast as $r)
											<option value="{{$r->prdcd}}|{{$r->nama}}|{{$r->satuan}}">{{ $r->prdcd }} :: {{ $r->nama }} ({{ $r->satuan }})</option>
										@endforeach
									</select>								
								</div>
							</div>

                            <div class="form-group row m-l-15">
								<label class="col-form-label col-md-3">Qty</label>
								<div class="col-md-3">      
									<input type="text" name="qty"  value="0" style="text-align: right;" class="form-control font-weight-semibold rupiah qtynya">
									<div class="form-control-feedback form-control-feedback-lg satuan">
										
									</div>
                                </div>                                    
                            </div> 
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn bg-primary add-row">Tambahkan</button>
                            <button type="button" class="btn bg-danger" data-dismiss="modal">Close</button>
                        </div>
           
                    </div>
                </div>
            </div>
            <!-- /primary modal --> 


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
        $("[id^='currency']").each(function() {
            var id = $(this).attr('id');

            id = id.replace("currency",'');

            var rp = $('#currency'+id).val();
            rp = intVal(rp);

            totalAmount += rp;

        });

        $('#total').val(tandaPemisahTitik(parseFloat(totalAmount)));
    }

</script>


<script type="text/javascript"> 
    $(document).ready(function(){

        $(".add-row").click(function(){
            var datanya = $(".datanya").val();
            var s = datanya.split("|");
            var plu = s[0];
            var deskripsi = s[1];
            var satuan = s[2];
            var qtynya = $(".qtynya").val();
            var qtyv = tandaPemisahTitik(qtynya); 
            var markup = "<tr><td class='text-center'><input type='hidden' name='prdcd[]' value='" + plu + "'>" + plu + "</td><td>" + deskripsi + "</td><td class='text-center'>" + satuan + "</td><td class='text-center'><input type='hidden' name='qty[]' value='" + qtynya + "'>" + qtyv + "</td><td><a href='javascript:void(0);' class='delete-row'><i class='fa fa-trash-alt text-danger'></i></a></td></tr>";
            $("#listitem").append(markup);
            $(".qtynya").val('');
            $('#modal_theme_primary').modal('hide');
        });
        
        // Find and remove selected table rows
        $("#listitem").on('click','.delete-row',function(){
        $(this).parent().parent().remove();
    });
    });    
</script>


<script type="text/javascript">

$(document).ready(function(){
    $("#simpanmaterial").submit(function(){  

        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ url('materialkeluar/unit/simpan') }}",
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
                    window.location = "{{url('materialkeluar/unit')}}";
                });  
                }else{
                    Swal.fire({
                    title: "Pesan informasi",
                    text:  data.msg,
                    icon: "error",
                    }).then(function() {
                   
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
                    window.location = "{{url('materialkeluar/unit')}}";
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


<script type="text/javascript">

    $('#properti').change(function(){
        var id = $(this).val();
        $("#listunit").empty(); 
        if(id){
            $.ajax({
                type:"GET",
                url:"{{url('materialkeluar/listunit')}}/"+id,
                success:function(res){
                    $("#listunit").empty(); 
                    if(res){
                        
                        $("#listunit").append('<option>Pilih Unit</option>');
                        $.each(res,function(key,value){

                            $("#listunit").append('<option value="'+value['id']+'" data-icon="location3">'+value['nama']+' :: Tipe Unit '+value['tipe']+'</option>');

                        });
                    } 

                }

            });

        }else{

            $("#listunit").empty(); 

        }

    }); 
</script>
@stop
