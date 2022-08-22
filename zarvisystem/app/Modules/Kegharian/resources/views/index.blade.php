@extends('admin.layout') 

@section('styles') 



<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />

<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />

<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />

<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" /> 





<link href="{{ asset("plugins/bootstrap-calendar/css/bootstrap_calendar.css")}}" rel="stylesheet" />

<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker.css")}}" rel="stylesheet" />

<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")}}" rel="stylesheet" /> 





@stop 

@section('content')

 



<h1 class="page-header">Laporan  <small>Kegiatan Harian Marketing...</small></h1>



<div class="section-container section-with-top-border p-b-5">  

    <div class="row">

         <!-- begin col-6 -->

         <div class="col-lg-6">

            <div class="widget">   

                <!-- begin panel -->

                <div class="form-horizontal">  

                    @if(Session::has('flash_message'))

                    <div class="alert alert-info ">

                        <span class="glyphicon glyphicon-ok">

                        </span><em>  ~  {{ Session::get('flash_message') }}</em>

                    </div>

                    @endif

                         

                    <div class="horizontal-divider m-0 m-b-15"></div> 



                </div> 

            
 

                <div class="border-top my-4"></div>                                                    



                <form method="POST" action="{{ url('/kegharian') }}"> 

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">   

                    <div class="form-group row m-l-10">

                        <label class="col-form-label col-md-3 ">Perumahan</label>

                        <div class="col-md-6"> 
 
                            <select class="default-select2 form-control" name="id_properti" required>

                                <option value="">-- Pilih --</option>                                                         

                                @foreach($properti as $r)

                                     <option value="{{$r->id}}">{{$r->nama}}</option>                                                         

                                @endforeach

                            </select>

                        </div>

                    </div> 



                    <div class="form-group row m-l-10">

                        <label class="col-form-label col-md-3">Nama</label>

                        <div class="col-md-6">  
                            <input type="text" id="nama" name="nama"  class="form-control" required> 
                        </div>
                    </div>  

                    <div class="form-group row m-l-10">

                        <label class="col-form-label col-md-3 ">Alamat</label>

                        <div class="col-md-6">  

                            <input type="text" name="alamat" id="alamat"  class="form-control" required> 

                        </div>

                    </div>    

                    <div class="form-group row m-l-10">

                        <label class="col-form-label col-md-3 ">HP/TLP</label>

                        <div class="col-lg-6">  

                            <input type="text" id="telp" name="phone"   class="form-control text-right" required> 

                        </div>

                    </div>   

                    <div class="form-group row m-l-10">

                        <label class="col-form-label col-lg-3">Tanggal</label>

                        <div class="col-lg-6"> 

                            <div class="input-group" id="daterange-singledate">

                                <input type="text" name="tanggal" id="datepicker-default" class="form-control" placeholder="Pilih Tanggal" required/>

                                <span class="input-group-btn">

                                    <button class="btn btn-primary" type="button"><i class="fa fa-gift"></i></button>

                                </span>

                            </div>                            

                        </div>

                    </div>  

                    



                    <div class="form-group row m-l-10">

                        <label class="col-form-label col-md-3 ">Melalui</label>

                        <div class="col-md-6">  
                            <select class="default-select2 form-control" name="melalui" required>

                                <option value="">-- Pilih --</option>                                                         

                                <option value="Telp">Telepon</option>

                                <option value="Sms / WA / Telegram / Line" >Sms / WA / Telegram / Line</option>

                                <option value="Email" >Email</option>

                                <option value="Ketemu" >Ketemu</option>

                                <option value="Lainnya" >Lainnya</option>

                            </select>

                        </div>

                    </div> 

                     

                    <div class="form-group row m-l-10">

                        <label class="col-form-label col-md-3 ">Keterangan</label>

                        <div class="col-md-6"> 
 
                            <textarea name="keterangan"  class="form-control" rows="3" placeholder="Keterangan" required></textarea> 

                        </div>

                    </div> 

                 



                    <div class="border-top my-1 m-b-15"></div> 

                    <div class="m-b-15">

                        <button type="submit" class="btn btn-lime btn-block btn-lg">Simpan</button>

                    </div>

                </form>

             



        </div><!--end widget-->



    </div><!--end Col 6 -->

 

</div><!--end Section -->

</div><!--end Section -->

  







@stop

 

@section('scripts')



<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>

<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script> 

<script src="{{ asset('js/jquery.number.js') }}"></script> 





<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>



<script type="text/javascript"> 

    $('.nomor').number(true, 0, ',', ' ');

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

        $(".default-select2").select2();

    });

</script>



 

 



@stop

