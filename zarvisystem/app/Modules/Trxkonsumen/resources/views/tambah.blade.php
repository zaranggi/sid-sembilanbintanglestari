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

<h1 class="page-header">MOU Konsumen <small>add new...</small></h1>

<div class="section-container section-with-top-border p-b-5">
    @if(Session::has('flash_message'))
    <div class="alert alert-info ">
    <span class="glyphicon glyphicon-ok">
    </span><em>  ~  {{ Session::get('flash_message') }}</em>
        </div>
    @endif
    <form id="spr" class="formku" method="POST" action="javascript:void(0)">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id_marketing" id="id_marketing">
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
                <div class="widget-header p-t-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="m-b-5 m-l-10 text-info">Cari</h4>
                        </div>
                    </div>
                </div>
                <!-- begin panel -->
                  <div class="form-group row m-l-5">
                        <label class="col-form-label col-md-2">Konsumen</label>
                        <div class="col-md-9">
                             <select id="isikankonsumen" name="id_konsumen" class="pilih form-control" placeholder="Pilih Konsumen" required >
                                <option>-- Pilih Konsumen --</option>
								@foreach($konsumen as $r)
                                    <option value="{{ $r->id }}">{{ $r->kode }} - {{ $r->nama }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="horizontal-divider m-0 m-b-15"></div>

                <div class="widget-header p-t-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="m-b-5 m-l-10 text-info">Data Konsumen</h4>
                        </div>
                    </div>
                </div>
                <div class="border-top my-1"></div>

                    <div class="form-group m-b-5">
                        <label class="col-lg-4 col-form-label">Kode</label>
                        <div class="input-group col-lg-9">
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="kode" id="kode"  class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group m-b-5">
                        <label class="col-lg-4 col-form-label">Nama Lengkap</label>
                        <div class="input-group col-lg-9">
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="nama" id="nama"  class="form-control" >
                        </div>
                    </div>
                    <div class="form-group m-b-10">
                        <label class="col-lg-4 col-form-label">Alamat</label>
                        <div class="input-group col-lg-9">
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="alamat" id="alamat"  class="form-control" >
                        </div>
                    </div>

                    <div class="form-group m-b-10">
                        <label class="col-lg-4 col-form-label">No. KTP</label>
                        <div class="input-group col-lg-9">
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="idcard"  id="idcard"  class="form-control nomor2 text-right" >
                        </div>
                    </div>
                    <div class="form-group m-b-10">
                        <label class="col-lg-4 col-form-label">HP/TLP</label>
                        <div class="input-group col-lg-9">
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="telp" id="telp"  class="form-control text-right">
                        </div>
                    </div>


        </div><!--end widget-->

    </div><!--end Col 6 -->

         <!-- begin col-6 -->
         <div class="col-lg-7">
            <!-- begin panel -->
            <div class="widget">
                <div class="widget-header p-t-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="m-b-5 m-l-10 text-info">Data Properti</h4>
                        </div>
                    </div>
                </div>
                <div class="border-top my-1"></div>

                    <div class="form-group m-b-15">
                        <label class="col-lg-3 col-form-label">Properti/Perumahan</label>
                        <div class="input-group col-lg-9">
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <select id="properti" name="id_properti" class="pilih form-control" placeholder="Pilih Perumahan" required >
                                <option>-- Pilih Perumahan --</option>
                                @foreach($listproperti as $r)
                                    <option value="{{ $r->id }}">{{ $r->kode }} - {{ $r->nama }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group m-b-15">
                        <label class="col-lg-3 col-form-label">Unit/Kavling</label>
                        <div class="input-group col-lg-9">
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <select id="listunit" name="id_kav" class="pilih form-control" placeholder="Pilih Unit"  required >

                            </select>
                        </div>
                    </div>

                    <div class="form-group row m-l-10">
                        <label class="col-form-label col-md-3 ">Type</label>
                        <div class="col-md-2">
                            <input type="text" id="tipe"  class="form-control text-right" readonly>
                        </div>
                    </div>
                    <div class="form-group row m-l-10">
                        <label class="col-form-label col-md-3 ">Luas Tanah m<sup>2</sup></label>
                        <div class="col-md-2">
                            <input type="text" id="lt"  class="form-control nomor text-right" readonly>
                        </div>
                    </div>
                    <div class="form-group row m-l-10">
                        <label class="col-form-label col-md-3 ">Luas Bangunan m<sup>2</sup></label>
                        <div class="col-md-2">
                            <input type="text" id="lb"  class="form-control nomor text-right" readonly>
                        </div>
                    </div>
                    <div class="form-group row m-l-10">
                        <label class="col-form-label col-md-3 ">Harga</label>
                        <div class="col-md-3">
                            <input type="text" id="harga"  class="form-control rupiah text-right" readonly>
                        </div>
                    </div>


                    <div class="form-group m-b-15">
                        <label class="col-lg-3 col-form-label">Promo</label>
                        <div class="input-group col-lg-9">
                            <textarea name="bonus"  class="form-control" rows="3" placeholder="Promo" ></textarea>
                        </div>
                    </div>

        </div>
    </div><!--end Row -->
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
                                <input type="text" name="tgl_transaksi" id="tanggal2" class="form-control" placeholder="Pilih Tanggal" required/>
                                <span class="input-group-btn">
                                    <i class="fa fa-calendar-alt text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-b-15">
                        <label class="col-lg-4 col-form-label">Harga Kesepakatan</label>
                        <div class="input-group col-lg-5">
                            <span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span>
                            <input type="text" id="gross_unit" name="gross_unit"  class="form-control rupiah text-right" placeholder="0" required>
                        </div>
                    </div>

               <div class="border-top m-b-15"></div>

               <div class="widget-header p-t-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="m-b-5 m-l-10 text-info">Penambahan</h4>

                        </div>
                    </div>
                </div>
                <div class="border-top my-1"></div>

                    <div class="form-group m-b-15">
                        <label class="col-lg-4 col-form-label">Luas Tanah m<sup>2</sup></label>
                        <div class="input-group col-lg-5">
                            <span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span>
                            <input type="text" id="plt" name="luas_penambahan_tanah"  class="form-control nomor text-right" placeholder="0" >
                        </div>
                    </div>
                    <div class="form-group m-b-15">
                        <label class="col-lg-4 col-form-label">Harga per m<sup>2</sup></label>
                        <div class="input-group col-lg-5">
                            <span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span>
                            <input type="text" id="pht" name="harga_penambahan_tanah"  class="form-control rupiah text-right" placeholder="0" >
                        </div>
                    </div>
                    <div class="form-group m-b-15">
                        <label class="col-lg-4 col-form-label">Total</label>
                        <div class="input-group col-lg-5">
                            <span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span>
                            <input type="text" id="tplt" name="gross_penambahan_tanah"  class="form-control rupiah text-right" placeholder="0" readonly>
                        </div>
                    </div>

                    <div class="border-top my-1"></div>

                    <div class="form-group m-b-15">
                        <label class="col-lg-4 col-form-label">Penambahan Lain<sup>2</sup></label>
                        <div class="input-group col-lg-9">
                            <span class="input-group-addon"><i class="fa fa-pen-square  text-info"></i></span>
                            <textarea name="penambahan_lain"  class="form-control" rows="3" placeholder="Penambahan" ></textarea>
                        </div>
                    </div>
                    <div class="form-group m-b-15">
                        <label class="col-lg-4 col-form-label">Harga Penambahan</label>
                        <div class="input-group col-lg-5">
                            <span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span>
                            <input type="text" id="pll" name="harga_penambahan_lain"  class="form-control rupiah text-right" placeholder="0" >
                        </div>
                    </div>
                    <div class="form-group m-b-15">
                        <label class="col-lg-4 col-form-label">Total</label>
                        <div class="input-group col-lg-5">
                            <span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span>
                            <input type="text" id="tpll" name="gross_penambahan_lain"  class="form-control rupiah text-right" placeholder="0" readonly>
                        </div>
                    </div>
                    <div class="border-top my-10"></div>
                    <div class="form-group m-b-15 ppnnya" style="display:none">
                        <label class="col-lg-4 font-weight-bold text-lime col-form-label">PPN 10%</label>
                        <div class="input-group col-lg-5">
                            <span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span>
                            <input type="text" id="ppn" name="ppn" value="0" class="form-control rupiah text-right" >
                        </div>
                    </div>
                    <div class="form-group m-b-15">
                        <label class="col-lg-6 font-weight-bold text-lime  col-form-label">Total Setelah Penambahan</label>
                        <div class="input-group col-lg-5">
                            <span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span>
                            <input type="text" id="tall" name="gross_total"  class="form-control rupiah text-right" placeholder="0" readonly>
                        </div>
                    </div>
                    <div class="border-top my-1"></div>
                    <div class="form-group m-b-15">
                        <label class="col-lg-4 col-form-label">Tanda Jadi</label>
                        <div class="input-group col-lg-5">
                            <span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span>
                            <input type="text" id="booking" name="gross_booking"  class="form-control rupiah text-right" placeholder="0" required>
                        </div>
                    </div>

                    <div class="border-top my-10"></div>


					 <div class="border-top my-10"></div>

                    <div class="form-group m-b-15">
                        <label class="col-lg-4 font-weight-bold text-info col-form-label">Total Akhir</label>
                        <div class="input-group col-lg-5">
                            <span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span>
                            <input type="text" id="takh" name="gross_akh"  class="form-control rupiah text-right" readonly>
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
                            <h4 class="m-b-5 m-l-10 text-info">Rencana Metode Pembayaran</h4>

                        </div>
                    </div>
                </div>
                <div class="border-top my-1"></div>
                <!-- begin panel -->
                    <div class="form-group m-b-15">
                        <label class="col-lg-5 font-weight-bold col-form-label">Rencana Pembayaran Unit</label>
                        <div class="input-group col-lg-9">
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <select id="cbu" name="cara_bayar_unit"  class="pilih form-control" placeholder="Pembayaran Unit" required >
                                <option value="">-- Pilih Cara Pembayaran --</option>
                                <option value="kpr">KPR Bank</option>
                                <option value="bertahap">Tunai Bertahap</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-b-15"  id="pumx" >
                        <label class="col-lg-5  col-form-label font-weight-bold">Rencana Periode UM/DP</label>
                        <div class="input-group col-lg-6">
                            <select class="pilih form-control" id="pum" placeholder="Pembayaran Unit" name="tahapan_um">
                                <option value="0" selected>Pilih Periode UM</option>
                                @php
                                    for($i = 1; $i<=12; $i++){
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="UAClass">

                    </div>
                    <div class="border-top my-10"></div>
                    <div class="form-group m-b-15">
                        <label class="col-lg-4 font-weight-bold text-lime col-form-label">Rencana Total UM/DP</label>
                        <div class="input-group col-lg-5">
                            <span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span>
                            <input type="text" id="gross_umnya" name="gross_umnya" value="0" class="form-control rupiah text-right" readonly>
                        </div>
                    </div>

                <div class="border-top my-1"></div>
                    <div class="form-group m-b-15"  id="display_cunit" style="display:none">
                        <label class="col-lg-5 font-weight-bold text-lime  col-form-label">Rencana Periode Cicilan Unit</label>
                        <div class="input-group col-lg-5">
                            <select class="form-control" id="t_cunit"  name="tahapan_unit" placeholder="Pembayaran Unit" required >
                                <option value="0" selected>-Pilih Periode-</option>
								@php
                                    for($i = 1; $i<=60; $i++){
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                @endphp
                            </select>
                        </div>
                    </div>

                    <div class="tahapan">

                    </div>

                    <div class="border-top my-1"></div>
                    <div class="form-group m-b-15">
                        <label class="col-lg-6 col-form-label">Rencana Bayar Booking Fee</label>
                        <div class="input-group col-lg-5">
                            <div class="input-group" id="daterange-singledate">
                                <input type="text" name="tanggal_jt_booking" id="tanggal3" class="form-control" placeholder="Pilih Tanggal" required/>
                                <span class="input-group-btn">
                                    <i class="fa fa-calendar-alt text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-b-15">
                        <label class="col-lg-4 col-form-label">Rencana Bayar UM/DP</label>
                        <div class="input-group col-lg-5">
                            <div class="input-group" id="daterange-singledate">
                                <input type="text" name="tanggal_jt_um" id="tanggal4" class="form-control" placeholder="Pilih Tanggal"/>
                                <span class="input-group-btn">
                                    <i class="fa fa-calendar-alt text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-b-15">
                        <label class="col-lg-6 col-form-label">Rencana Bayar Penambahan </label>
                        <div class="input-group col-lg-5">
                            <div class="input-group" id="daterange-singledate">
                                <input type="text" name="tanggal_jt_penambahan" id="tanggal5" class="form-control" placeholder="Pilih Tanggal"/>
                                <span class="input-group-btn">
                                    <i class="fa fa-calendar-alt text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group m-b-15">
                        <label class="col-lg-4 col-form-label">Rencana Mulai Bayar Unit </label>
                        <div class="input-group col-lg-5">
                            <div class="input-group" id="daterange-singledate">
                                <input type="text" name="tanggal_jt_unit" id="tanggal6" class="form-control" placeholder="Pilih Tanggal"/>
                                <span class="input-group-btn">
                                    <i class="fa fa-calendar-alt text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                 <div class="border-top my-1 m-b-15"></div>
                 <div class="m-b-15">
                     <button type="submit"  id="submit" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-success btn-block btn-lg">Simpan MOU</button>
                 </div>
				 </form>
         </div>


    </div><!--end Row -->

</div><!--end Section -->




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
            $("#tanggal3").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            });
            $("#tanggal4").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            });
            $("#tanggal5").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            });
            $("#tanggal6").datepicker(
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
    $(".formku").submit(function(){
        var cbu = $('#cbu').val();
        if(cbu == ''){
                Swal.fire({
                    title: "Pesan kesalahan",
                    text: "Lengkapi pengisian form",
                    icon: "error",
                });

        }else{
            $('#submit').hide();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ url('trxkonsumen') }}",
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
                        window.location = "{{url('trxkonsumen')}}";
                    });
                    }else{
                        Swal.fire({
                        title: "Pesan informasi",
                        text:  data.msg,
                        icon: "error",
                        });
                    }

                },
                error: function(){
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

<script type="text/javascript">

    $(document).ready(function(){

        var intVal = function ( i ) {
                    return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                    i : 0;
                };


        $('#isikankonsumen').change(function(){

            var query = $(this).val();
            var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ url('trxkonsumen/isikan') }}",
                        method:"POST",
                        dataType: 'json',
                        data:{query:query, _token:_token},
                        success:function(data){

                            $('#kode').val(data[0].kode);
                            $('#nama').val(data[0].nama);
                            $('#alamat').val(data[0].alamat);
                            $('#idcard').val(data[0].idcard);
                            $('#telp').val(data[0].telp);
                            $('#id_marketing').val(data[0].id_marketing);
                            $('#id_properti').val(data[0].id_properti);

                        }
                    });

        });
        $('#ppn').keyup(function(){

            var ppn = $(this).val();
            var gross_unit = $('#gross_unit').val();
            var tplt = $('#tplt').val();
            var tpll = $('#tpll').val();
            var booking = $('#booking').val();
            var gross_umnya = $('#gross_umnya').val();
            var cbu = $('#cbu').val();
			var ppn = $('#ppn').val();

            $('#tall').val(intVal(gross_unit) + intVal(tplt) + intVal(tpll) + intVal(ppn));
            $('#takh').val( intVal(gross_unit) + intVal(tplt) + intVal(tpll) + intVal(ppn) - intVal(booking) - intVal(gross_umnya));

        });

        $('#gross_unit').keyup(function(){
            var gross_unit = $(this).val();
            var tplt = $('#tplt').val();
            var tpll = $('#tpll').val();
            var booking = $('#booking').val();
            var gross_umnya = $('#gross_umnya').val();
            var cbu = $('#cbu').val();
			var ppn = $('#ppn').val();

            if(gross_unit.length > 0)
            {
				if(cbu == "bertahap"){
                    $('#tall').val( intVal(gross_unit) + intVal(tplt) + intVal(tpll) + intVal(ppn) );
					$('#takh').val( intVal(gross_unit) + intVal(tplt) + intVal(tpll) + intVal(ppn) - intVal(booking) - intVal(gross_umnya) );
				}else{
					$('#tall').val( intVal(gross_unit) + intVal(tplt) + intVal(tpll) );
					$('#takh').val( intVal(gross_unit) + intVal(tplt) + intVal(tpll) - intVal(booking) - intVal(gross_umnya) );
				}

            }else
            {
                $('#tall').val(0);
                $('#takh').val(0);
            }

        });



        $('#plt').keyup(function(){
                var plt = $(this).val();
                var pht = $('#pht').val();
                var tpll = $('#tpll').val();
                var gross_unit = $('#gross_unit').val();
                var booking = $('#booking').val();
                var gross_umnya = $('#gross_umnya').val();
				var cbu = $('#cbu').val();

                if(plt.length >0)
                {
                    $('#tplt').val( plt * pht );
                    var ta = plt * pht;
					if(cbu == "bertahap"){
						var ppn = $('#ppn').val();
                        $('#tall').val( intVal(tpll) + intVal(ta) + intVal(gross_unit) + intVal(ppn));

						$('#takh').val( intVal(tpll) + intVal(ta) + intVal(gross_unit) + intVal(ppn) - intVal(booking) - intVal(gross_umnya) );
					}else{
						$('#tall').val( intVal(tpll) + intVal(ta) + intVal(gross_unit));
						$('#takh').val( intVal(tpll) + intVal(ta) + intVal(gross_unit) - intVal(booking) - intVal(gross_umnya) );
					}

                }else{
                    $('#tplt').val(0);
                }

        });

        $('#pht').keyup(function(){
                var plt = $('#plt').val();
                var pht = $(this).val();
                var tpll = $('#tpll').val();
                var gross_unit = $('#gross_unit').val();
                var booking = $('#booking').val();
                var gross_umnya = $('#gross_umnya').val();
				var cbu = $('#cbu').val();

                if(pht.length >0)
                {
                    $('#tplt').val( plt * pht );
                    var ta = plt * pht;
					if(cbu == "bertahap"){
						var ppn = $('#ppn').val();
						$('#tall').val( intVal(tpll) + intVal(ta) + intVal(gross_unit) + intVal(ppn) );

						$('#takh').val( intVal(tpll) + intVal(ta) + intVal(gross_unit) + intVal(ppn) - intVal(booking)  - intVal(gross_umnya) );
					}else{
						$('#tall').val( intVal(tpll) + intVal(ta) + intVal(gross_unit));
						$('#takh').val( intVal(tpll) + intVal(ta) + intVal(gross_unit) - intVal(booking)  - intVal(gross_umnya) );
					}


                }else{
                    $('#tplt').val(0);
                }

        });

        $('#pll').keyup(function(){
                var pll = $(this).val();
                var tplt = $('#tplt').val();
                var gross_unit = $('#gross_unit').val();
                var booking = $('#booking').val();
                var gross_umnya = $('#gross_umnya').val();
				var cbu = $('#cbu').val();

                if(pll.length >0)
                {
                    $('#tpll').val( pll );
					if(cbu == "bertahap"){
						var ppn = $('#ppn').val();
						$('#tall').val( intVal(tplt) + intVal(pll) + intVal(gross_unit) + intVal(ppn));
						$('#takh').val( intVal(tplt) + intVal(pll) + intVal(gross_unit) + intVal(ppn) - intVal(booking) - intVal(gross_umnya) );
					}else{
						$('#tall').val( intVal(tplt) + intVal(pll) + intVal(gross_unit));
						$('#takh').val( intVal(tplt) + intVal(pll) + intVal(gross_unit) - intVal(booking) - intVal(gross_umnya) );
					}

                }else{
                    $('#tpll').val(0);
                }

        });


        $('#booking').keyup(function(){
            var booking = $(this).val();
            var tall = $('#tall').val();
			var tpll = $('#tpll').val();
			var tplt = $('#tplt').val();
            var gross_unit = $('#gross_unit').val();
            var gross_umnya = $('#gross_umnya').val();
            var cbu = $('#cbu').val();
            if(cbu == "bertahap"){
				var ppn =  $('#ppn').val();
				$('#takh').val( intVal(tpll) + intVal(tplt) + intVal(gross_unit) + intVal(ppn)  - intVal(booking)  - intVal(gross_umnya));
			}else{
				$('#takh').val( intVal(tpll) + intVal(tplt) + intVal(gross_unit)  - intVal(booking)  - intVal(gross_umnya));
			}


        });

        $("#spr").on('change', '#nilai_um', function () {
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
        $("#spr").on('change', '.onchangeHarga', function () {
            var booking = $(this).val();
            var tall = $('#tall').val();
			var tpll = $('#tpll').val();
			var tplt = $('#tplt').val();
            var gross_unit = $('#gross_unit').val();
            var gross_umnya = $('#gross_umnya').val();
            var cbu = $('#cbu').val();
			//alert(gross_umnya)
			if(cbu == "bertahap"){
				var ppn =  $('#ppn').val();
				$('#takh').val( intVal(tpll) + intVal(tplt) + intVal(gross_unit) + intVal(ppn)  - intVal(booking)  - intVal(gross_umnya));
			}else{
				//alert("detail :"+ intVal(tpll) +" + "+ intVal(tplt) +" + "+ intVal(gross_unit) +" - "+ intVal(gross_umnya) +" - "+ intVal(booking));
				var upd_takh = (intVal(tpll) + intVal(tplt) + intVal(gross_unit)) - intVal(gross_umnya) - intVal(booking);
				//alert(upd_takh);
				$('#takh').val( upd_takh );
			}

        });


		$('#properti').change(function(){
			var id = $(this).val();
			$("#listunit").empty();
			if(id){
				$.ajax({
					type:"GET",
					url:"{{url('trxkonsumen/listunit')}}/"+id,
					success:function(res){
						$("#listunit").empty();
						if(res){

							$("#listunit").append('<option>Pilih Unit</option>');
							$.each(res,function(key,value){

								$("#listunit").append('<option value="'+value['id']+'" data-icon="location3">'+value['nama']+'</option>');

							});
						}

					}

				});

			}else{

				$("#listunit").empty();

			}

		});


		$('#listunit').change(function(){
            var id = $(this).val();

            var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ url('trxkonsumen/unitdetail') }}",
                        method:"POST",
                        dataType: 'json',
                        data:{query:id, _token:_token},
                        success:function(data){

                            $('#tipe').val(data[0].tipe);
                            $('#lt').val(data[0].luas_tanah);
                            $('#lb').val(data[0].luas_bangunan);
                            $('#harga').val(data[0].harga);

                        }
                    });

        });

        $('#cbu').change(function(){
            var cbu = $(this).val();
            //alert(cbu);
			var tall = $("#tall").val();
			var gross_umnya = $("#gross_umnya").val();
            var booking = $("#booking").val();
			var tpll = $('#tpll').val();
			var tplt = $('#tplt').val();
            var gross_unit = $('#gross_unit').val();

            if(cbu == "kpr"){
                $('#display_cunit').hide();
                $('.unit_angsuran').hide();
				$("#t_cunit").hide();
                $("#t_cunit").prop('selectedIndex',0);
				$(".tahapan").empty();
				$(".ppnnya").hide();
				$("#ppn").val("0");
                $('#tall').val( intVal(tpll) + intVal(tplt) + intVal(gross_unit));
				$('#takh').val( intVal(tpll) + intVal(tplt) + intVal(gross_unit) - intVal(gross_umnya) - intVal(booking));
            }else if(cbu == "bertahap"){
                $('#display_cunit').show();
				$("#t_cunit").show();
                $("#t_cunit").prop('selectedIndex',0);
                $('.unit_angsuran').show();
				$(".ppnnya").show();
				$("#ppn").val("0");
				var ppn =   $('#ppn').val();
                $('#tall').val( intVal(tpll) + intVal(tplt) + intVal(gross_unit) + intVal(ppn));
				$('#takh').val( intVal(tpll) + intVal(tplt) + intVal(gross_unit) + intVal(ppn)  - intVal(booking)  - intVal(gross_umnya));

            }

        });

        $('#pum').change(function(e){
            var bln = $("#pum").val();
            $(".UAClass").empty();
			$("#gross_umnya").val("0");
			if(bln > 0){

				var a ='';
				for (var i = 1; i <= parseInt(bln); i++) {

					a += '<div class="form-group m-b-15 pum_angsuran" ><label class="col-lg-4 col-form-label">Rencana Angsuran Um '+ i +'</label><div class="input-group col-lg-5"><span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span><input type="text" id="nilai_um" name="tag_um[]"  class="form-control rupiah text-right onchangeHarga" value="0" required="required"></div></div>';

				}
				$('.rupiah').number(true, 0,);
				$(".UAClass").html(a);
				$('.rupiah').number(true, 0,);
				$(".pum_angsuran").show();
				e.preventDefault();
			}
        });

        $('#t_cunit').change(function(){
            var bln = $("#t_cunit").val();
            $(".tahapan").empty();
            var a ='';
			if(bln > 0){
				for (var i = 1; i <= parseInt(bln); i++) {

					a += '<div class="form-group m-b-15 unit_angsuran"><label class="col-lg-4 col-form-label">Rencana Angsuran Unit '+ i +'</label><div class="input-group col-lg-5"><span class="input-group-addon"><i class="fa fa-handshake text-info"></i></span><input type="text" name="tag_unit[]"  class="form-control rupiah text-right" value="0" required="required"></div></div>';

				}
				$(".tahapan").html(a);
				$('.rupiah').number(true, 0,);
				$(".unit_angsuran").show();
			}

        });

	});



</script>


@stop
