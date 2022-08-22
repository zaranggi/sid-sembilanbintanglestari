@extends('admin.layout')
@section('styles')

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

<h1 class="page-header">Pembebasan Lahan <small>Detail...</small></h1>

<div class="section-container section-with-top-border p-b-5">
    @if(Session::has('flash_message'))
    <div class="alert alert-info ">
    <span class="glyphicon glyphicon-ok">
    </span><em>  ~  {{ Session::get('flash_message') }}</em>
        </div>
    @endif

    @foreach($data as $xx)



    <form>

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
    <div class="row">
         <!-- begin col-6 -->
         <div class="col-lg-5">
            <div class="widget">
                 <br/>
                <!-- begin panel -->
                  <div class="form-group row m-l-5">
                        <label class="col-form-label col-md-2">Properti</label>
                        <div class="col-md-9">
                             <select name="id_properti" class="pilih form-control" placeholder="Pilih Properti" required >
                                <option>-- Pilih Properti --</option>
								@foreach($properti as $r)
                                    @if($xx->id_properti = $r)
                                    <option value="{{ $r->id }}" selected="selected">{{ $r->nama }}</option>
                                    @else
                                    <option value="{{ $r->id }}">{{ $r->nama }}</option>
                                    @endif

                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="horizontal-divider m-0 m-b-15"></div>

                <div class="widget-header p-t-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="m-b-5 m-l-10 text-info">Data Pemilik</h4>
                        </div>
                    </div>
                </div>
                <div class="border-top my-1"></div>

                    <div class="form-group m-b-5">
                        <label class="col-lg-4 col-form-label">Nama Lengkap</label>
                        <div class="input-group col-lg-9">
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="nama" value= "{{$xx->nama_pemilik}}" id="nama"  class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group m-b-10">
                        <label class="col-lg-4 col-form-label">Alamat</label>
                        <div class="input-group col-lg-9">
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="alamat"  value= "{{$xx->alamat}}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group m-b-10">
                        <label class="col-lg-4 col-form-label">No. KTP</label>
                        <div class="input-group col-lg-9">
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="ktp"  value= "{{$xx->ktp}}" class="form-control nomor2 text-right" required>
                        </div>
                    </div>
                    <div class="form-group m-b-10">
                        <label class="col-lg-4 col-form-label">HP/TLP</label>
                        <div class="input-group col-lg-9">
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="hp" value= "{{$xx->hp}}" class="form-control text-right" required>
                        </div>
                    </div>

                </div>
            </div>

    </div><!--end Row -->

    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-6">
           <div class="widget">
               <div class="widget-header p-t-10">
                   <div class="row">
                       <div class="col-lg-6">
                           <h4 class="m-b-5 m-l-10 text-info">Form MOU</h4>

                       </div>
                   </div>
               </div>
               <div class="border-top my-1"></div>
               <!-- begin panel -->
                    <div class="form-group m-b-15">
                        <label class="col-lg-3 col-form-label">Tanggal</label>
                        <div class="input-group col-lg-5">
                            <div class="input-group" id="daterange-singledate">
                                <input type="text" name="tanggal" value= "{{$xx->tanggal}}" id="tanggal2" class="form-control" placeholder="Pilih Tanggal" required/>
                                <span class="input-group-btn">
                                    <i class="fa fa-calendar-alt text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-b-15">
                        <label class="col-lg-4 col-form-label">Luas Tanah m<sup>2</sup></label>
                        <div class="input-group col-lg-5">
                            <span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span>
                            <input type="text" id="lt" name="luas_tanah"  value= "{{$xx->luas_tanah}}" class="form-control nomor text-right" placeholder="0" required>
                        </div>
                    </div>
                    <div class="form-group m-b-15">
                        <label class="col-lg-4 col-form-label">Harga per m<sup>2</sup></label>
                        <div class="input-group col-lg-5">
                            <span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span>
                            <input type="text" id="plt" name="harga"  value= "{{$xx->harga}}" class="form-control rupiah text-right" placeholder="0" required>
                        </div>
                    </div>
					<div class="border-top my-10"></div>

                    <div class="form-group m-b-15">
                        <label class="col-lg-4 font-weight-bold text-info col-form-label">Total</label>
                        <div class="input-group col-lg-5">
                            <span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span>
                            <input type="text" id="takh" name="gross" value= "{{$xx->gross}}"  class="form-control rupiah text-right" readonly>
                        </div>
                    </div>
            </div>
        </div>


        <!-- begin col-6 -->
        <div class="col-lg-6">
            <div class="widget">
                <div class="widget-header p-t-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="m-b-5 m-l-10 text-info">Rencana Pembayaran</h4>

                        </div>
                    </div>
                </div>
                <div class="border-top my-1"></div>
                <!-- begin panel -->
                <div class="form-group m-b-15">
                    <label class="col-lg-5 col-form-label">Tanggal jatuh Tempo</label>
                    <div class="input-group col-lg-5">
                        <div class="input-group" id="daterange-singledate">
                            <input type="text" name="tanggal_jth_tempo" value= "{{$xx->tanggal_jth_tempo}}" id="tanggal" class="form-control" placeholder="Pilih Tanggal" required/>
                            <span class="input-group-btn">
                                <i class="fa fa-calendar-alt text-info"></i>
                            </span>
                        </div>
                    </div>
                </div>

                    <div class="form-group m-b-15"  id="pumx" >
                        <label class="col-lg-5  col-form-label font-weight-bold">Rencana Periode Pembayaran</label>
                        <div class="input-group col-lg-6">
                            <select class="pilih form-control" id="pum" placeholder="Pembayaran Unit" name="tahapan_um">
                                <option value="0" selected>Pilih Periode Pembayaran</option>
                                @php
                                echo '<option value="'.$xx->status_bayar.'" selected="selected">'.$xx->status_bayar.'</option>';
                                    for($i = 1; $i<=12; $i++){
                                        echo '<option value="'.$i.'">'.$i.'</option>';

                                    }
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="UAClass">
                        @foreach($termin as $r)
                        <div class="form-group m-b-15 pum_angsuran" >
                            <label class="col-lg-6 col-form-label">Rencana Pembayaran {{$r->termin}}</label>
                            <div class="input-group col-lg-5">
                                <span class="input-group-addon">
                                    <i class="fa fa-handshake text-info"></i>
                                </span>
                                <input type="text" id="nilai_um" name="tag_um[]"  class="form-control rupiah text-right onchangeHarga" value="{{$r->nilai}}" required="required">
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="border-top my-10"></div>
                    <div class="form-group m-b-15">
                        <label class="col-lg-6 font-weight-bold text-lime col-form-label">Rencana Total Pembayaran</label>
                        <div class="input-group col-lg-5">
                            <span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span>
                            <input type="text" id="gross_umnya" value="{{$xx->gross}}" class="form-control rupiah text-right" readonly>
                        </div>
                    </div>

                 <div class="border-top my-1 m-b-15"></div>
                 <div class="m-b-15">

                    <a href="{{ url('appbebaslahan/approve/'.$xx->id) }}" data-confirm="Apakah yakin akan Approve RAB?" rel="nofollow" class="btn btn-lime btn-block btn-lg">
                        <i class="fa fa-save"></i> Approve Pengajuan
                    </a>

                    <a href="{{ url('appbebaslahan/reject/'.$xx->id) }}" data-confirm="Apakah yakin akan Reject RAB?" rel="nofollow" class="btn btn-red btn-block btn-lg">
                        <i class="fa fa-save"></i> Tolak Pengajuan
                    </a>
                    <a onclick="history.back()" class="btn btn-orange btn-block btn-lg">Kembali</a>
                 </div>
				 </form>
         </div>


    </div><!--end Row -->

</div><!--end Section -->


@endforeach


@stop

@section('scripts')

<script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{ asset('plugins/select2/dist/js/select2.min.js')}}"></script>
<script src="{{ asset('js/jquery.number.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>

<script type="text/javascript">
    $('.nomor').number(true, 2, '.', ',');
    $('.nomor2').number(true, 0, '.', ' ');
    $('.rupiah').number(true, 0,);
</script>

<script>
    $(document).ready(function() {
        $("#datepicker-default").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            });

            $("#tanggal2").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            });

			$(".pilih").select2();
    });
</script>

<script type="text/javascript">

    $(document).ready(function(){


        var intVal = function ( i ) {
                    return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                    i : 0;
                };



        $('#lt').keyup(function(){
            var lt = $(this).val();
            var plt = $('#plt').val();

            if(lt > 0)
            {
                $('#takh').val( intVal(plt) * intVal(lt));
            }else
            {
                $('#takh').val(0);
            }

        });


        $('#plt').keyup(function(){
            var plt = $(this).val();
            var lt = $('#lt').val();

            if(lt > 0)
            {
                $('#takh').val( intVal(plt) * intVal(lt));
            }else
            {
                $('#takh').val(0);
            }

        });

        $("#bebaslahan").on('change', '#nilai_um', function () {
            var temp = 0;
            var nilai = 0;
            $('input[name^="tag_um"]').each(function () {
                if ($(this).val() != "") {
                    nilai = $(this).val();
                } else {
                    nilai = 0;
                }
                temp = parseInt(temp) + parseInt(nilai);

            });
            //alert(temp);

            $("#gross_umnya").val(temp);

        });

        $('#pum').change(function(e){
            var bln = $("#pum").val();
            $(".UAClass").empty();
			$("#gross_umnya").val("0");
			if(bln > 0){

				var a ='';
				for (var i = 1; i <= parseInt(bln); i++) {

					a += '<div class="form-group m-b-15 pum_angsuran" ><label class="col-lg-4 col-form-label">Rencana Pembayaran '+ i +'</label><div class="input-group col-lg-5"><span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span><input type="text" id="nilai_um" name="tag_um[]"  class="form-control rupiah text-right onchangeHarga" value="0" required="required"></div></div>';

				}
				$('.rupiah').number(true, 0,);
				$(".UAClass").html(a);
				$('.rupiah').number(true, 0,);
				$(".pum_angsuran").show();
				e.preventDefault();
			}
        });

        $(".formku").submit(function(){
            var gross_umnya = $('#gross_umnya').val();
            var takh = $('#takh').val();
            if(takh != gross_umnya || takh === 0 || gross_umnya === 0){
                    Swal.fire({
                        title: "Pesan kesalahan",
                        text: "Total Pembayaran Harus Sama dan harus lebih dari 0",
                        icon: "error",
                    });
                    $('#submit').show();

            }else{
                $('#submit').hide();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ url('bebaslahan/update') }}",
                    method:"POST",
                    data:$('.formku').serialize(),
                    beforeSend: function(){
                        $('#submit').hide();
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
                                loaderOpen("Loading Prosses");
                            window.location = "{{url('bebaslahan')}}";
                        });
                        }else{
                            Swal.fire({
                            title: "Pesan informasi",
                            text:  data.msg,
                            icon: "error",
                            });
                            $('#submit').show();
                        }

                    },
                    error: function(data){
                        loaderClose();
                        Swal.fire({
                            title: "Pesan informasi",
                            text:  data.msg,
                            icon: "error",
                            });
                            $('#submit').show();
                    }
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
