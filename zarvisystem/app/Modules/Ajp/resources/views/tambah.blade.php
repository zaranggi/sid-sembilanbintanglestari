@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
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

<div class="row">
    <!-- begin col-6 -->
    <div class="col-lg-12">
       <div class="widget"> 
                    <div class="widget-header p-t-10">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="m-l-15 m-t-10 text-info">Form Jurnal Penyesuaian</h4>   
                                                        
                            </div> 
                        </div>
                    </div> 
           <!-- begin panel --> 
                <form id="simpanjurnal" method="POST" action="javascript:void(0)"> 
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id_properti" value="{{ $id_properti }}">
                    
                        @if ( count( $errors ) > 0 ) 
                            <div class="alert alert-danger"> 
                                <strong>Whoops!</strong> 
                                There were some problems with your input.<br><br> 
                                <ul> 
                                    @foreach ($errors->all() as $error) 
                                        <li>{{ $error }}</li> 
                                    @endforeach 
                                </ul> 
                            </div> 
                        @endif
                    
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-2 ">Tanggal Transaksi</label>
                        <div class="col-md-3"> 
                            <div class="input-group" id="daterange-singledate">
                                <input type="text" name="tanggal" id="tanggal" class="form-control" placeholder="Pilih Tanggal" required/>
                                <span class="input-group-btn">
                                    <i class="fa fa-calendar-alt text-info"></i>
                                </span>
                            </div>                            
                        </div>
                    </div>   
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-2 ">Memo Transaksi</label>
                        <div class="col-md-4"> 
                            <textarea name="keterangan"  class="form-control" rows="2" placeholder="Keterangan" ></textarea> 
                        </div>
                    </div>
                    <div class="form-group row m-l-15">
                        <button type="button" class="btn bg-primary" data-toggle="modal" data-target="#modal_theme_primary">Tambah <i class="icon-add ml-2"></i></button>
                    </div>
                    
                     <br/>
                     <br/>
                    <div class="card"> 
                        <div class=" table-responsive">
                            <table class="table table-bordered" id="listitem">
                                <thead>
                                    <tr class="bg-blue d-flex">
                                        <th class="col-2 text-center">Akun Perkiraan</th>
                                        <th class="col-5 text-center">Nama Perkiraan</th>
                                        <th class="col-2 text-center">Debit</th>
                                        <th class="col-2 text-center">Kredit</th>
                                        <th class="col-1 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>   
                                     
                                </tbody>
                                <tfoot>
                                    <tr class="d-flex">
                                        <th class="col-7 text-center" colspan="2">Grand Total</th> 
                                        <th class="bg-success text-right col-2"><span class="total_d" id="gross_d">0</span></th>
                                        <th class="bg-warning text-right col-2"><span class="total_k" id="gross_k">0</span></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="border-top my-1 m-b-15"></div> 
                    <div class="m-b-15">
                        <button type="submit" id="submit" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-lime btn-block btn-lg">Simpan Jurnal</button>
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
                            <h4 class="modal-title">Penyesuaian</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                         
                            <div class="col-lg-12"> 
                                <div class="row">
                                    <div class="col-md-12"> 
                                        <div class="form-group form-group-feedback form-group-feedback-right">
                                            <select id="id_akun" class="cari form-control" placeholder="Cari / Pilih Akun Perkiraan... " name="kode">
                                                @foreach($akunnya as $r)
                                                <option value="{{ $r->kode }}|{{ $r->nama_akun }}">{{ $r->kode }} - {{ $r->nama_akun }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row m-l-15 align-items-center">
                                    <label class=" col-form-label col-md-3">Posting</label>
                                    <div class="col-md-9">
                                        <div class="form-check form-check-inline">
                                            <input id="posisi" class="form-check-input" type="radio" value="D" name="posisi" id="defaultInlineRadio1"/>
                                            <label class="form-check-label" for="defaultInlineRadio1">Debet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input id="posisi" class="form-check-input" type="radio" value="K" name="posisi" id="defaultInlineRadio2"/>
                                            <label class="form-check-label" for="defaultInlineRadio2">Kredit</label>
                                        </div>
                                    </div>
                                </div>
 
                                <div class="form-group row m-l-15">
                                    <label class="col-form-label col-md-3">Nominal</label>
                                    <div class="col-md-5">      
                                        <input id="gross" type="text" name="gross"  value="0" style="text-align: right;" class="form-control font-weight-semibold rupiah qtynya">
                                        <div class="form-control-feedback form-control-feedback-lg">
                                            
                                        </div>
                                    </div>                                    
                                </div> 
                                <br/>
                                <div class="row">
                                    <div class="col-lg-12"> 
                                        <div class="form-group form-group-feedback form-group-feedback-right">
                                            <textarea  id="keterangan" name="keterangan2" class="form-control mb-3" rows="3" cols="1" placeholder="Keterangan..."></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div> 
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn bg-primary add-row">Tambahkan</button>
                            <button type="button" class="btn btn-link bg-danger" data-dismiss="modal">Close</button>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- /primary modal --> 


@stop
 
@section('scripts')

<script src="{{ asset("plugins/switchery/switchery.min.js")}}"></script>
<script src="{{ asset("js/page-form-slider-switcher.demo.min.js")}}"></script>
<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>  

<script>
    $(document).ready(function() { 
        PageDemo.init();
    });
</script>  
<script src="{{ asset('js/jquery.number.js') }}"></script> 


<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>

<script type="text/javascript"> 
    $('.nomor').number(true, 0, ',', ' ');
    $('.rupiah').number(true, 0,);
</script>

<script>
    $(document).ready(function() {   
        $("#tanggal").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            });
        $('.cari').select2();
    });
</script> 

<script type="text/javascript">
    $(document).ready(function(){
		
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
			var totalAmount2 = 0;
			$("[id^='t_d']").each(function() {
				var rp = $(this).val(); 
				rp = intVal(rp); 
				totalAmount += rp; 
			});

			$("[id^='t_k']").each(function() {
				var rp = $(this).val(); 
				rp = intVal(rp); 
				totalAmount2 += rp; 
			}); 

			$('#gross_d').text(tandaPemisahTitik(parseFloat(totalAmount)));
			$('#gross_k').text(tandaPemisahTitik(parseFloat(totalAmount2)));
		}
 

        $(".add-row").click(function(){
            
            var datanya = $("#id_akun").val();
            var s = datanya.split("|");
            var id_akun = s[0];
            var deskripsi = s[1]; 
            
            var posisi = $("input:radio[name=posisi]:checked").val();
            var gross = $("#gross").val();
            var keterangan = $("#keterangan").val();

            var grossv = tandaPemisahTitik(gross); 

            if(posisi == "D"){
                
                var markup = "<tr class='d-flex'>  <td class='col-2 text-center'><input type='hidden' name='id_akun[]' value='" + id_akun + "'>" + id_akun + " </td>  <td class='col-5'>  <h6 class='mb-0'>  <a href='#'>" + deskripsi + "</a>  <span class='d-block font-size-sm text-muted'><input type='hidden' name='keterangan2[]' value='" + keterangan + "'>" + keterangan + "</span>  </h6>  </td>  <td class='col-2 text-right'><input type='hidden' id='t_k' name='gross_k[]' value='0'><input type='hidden' id='t_d' name='gross_d[]' value='" + gross + "'>"+ grossv +"</td>  <td class='col-2 text-right'>0</td><td><a href='javascript:void(0);' class='delete-row'><i class='fa fa-trash-alt text-danger'></i></a></td>  </tr> ";
            }else{
                
                var markup = "<tr class='d-flex'>  <td class='col-2 text-center'><input type='hidden' name='id_akun[]' value='" + id_akun + "'>" + id_akun + " </td>  <td class='col-5'>  <h6 class='mb-0'>  <a href='#'>" + deskripsi + "</a>  <span class='d-block font-size-sm text-muted'><input type='hidden' name='keterangan2[]' value='" + keterangan + "'>" + keterangan + "</span>  </h6>  </td>  <td class='col-2 text-right'>0</td>  <td class='col-2 text-right'> <input type='hidden' id='t_d' name='gross_d[]' value='0'><input type='hidden' id='t_k' name='gross_k[]' value='" + gross + "'>"+ grossv +"</td><td><a href='javascript:void(0);' class='delete-row'><i class='fa fa-trash-alt text-danger'></i></a></td>  </tr> ";            
            }
            
            $("#listitem").append(markup);
			calculateTotal();
            $('#modal_theme_primary').modal('hide');   

        });
        
        // Find and remove selected table rows
        $("#listitem").on('click','.delete-row',function(){
            $(this).parent().parent().remove();
            calculateTotal();
        });
    });    
</script>

<script type="text/javascript"> 
    $(document).ready(function(){
	
    $("#simpanjurnal").submit(function(){  
		$('#submit').hide();
        var a = $(".total_d").text();
        var b = $(".total_k").text();
        if(a == b){
            
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ url('ajp') }}",
                method:"POST",
                data:$('#simpanjurnal').serialize(),
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
                        window.location = "{{url('ajp')}}";
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
                        window.location = "{{url('ajp')}}";
                    });
                }
            }); 
          
        }else{
			$('#submit').show();	
            Swal.fire({
                        title: "Pesan informasi",
                        text:  "Debit dan Kredit Harus Sama!!!",
                        icon: "error",
                        });
						
        }  
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
