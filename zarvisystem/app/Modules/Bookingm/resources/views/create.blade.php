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
 

<h1 class="page-header">Booking Unit<small>...</small></h1>

<div class="section-container section-with-top-border p-b-5">  
    <div class="row">
         <!-- begin col-6 -->
         <div class="col-lg-5">
            <div class="widget"> 
                <div class="widget-header p-t-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="m-b-5 m-l-10 text-info">Form Pencarian</h4>   
                                                    
                        </div> 
                    </div>
                </div>
                <div class="border-top my-1"></div> 
                <!-- begin panel -->
                <div class="form-horizontal">  
                    @if(Session::has('flash_message'))
                    <div class="alert alert-info ">
                  <span class="glyphicon glyphicon-ok">
                  </span><em>  ~  {{ Session::get('flash_message') }}</em>
                    </div>
                @endif
                        <div class="input-group m-b-15">
                            <input type="text" id="cari" class="form-control" placeholder="Enter keywords..." />
                            <div id="tampil">
                            </div> 
                        </div> 
                    <div class="horizontal-divider m-0 m-b-15"></div>  
                </div> 
            
                <div class="widget-header p-t-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="m-b-5 m-l-10 text-info">Data Konsumen</h4>                            
                        </div> 
                    </div>
                </div>
                <div class="border-top my-1"></div>                                                    

                <form method="POST" action="{{ url('/bookingm/fu') }}">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
 
                    <input type="hidden" name="kode" id="kode"  class="form-control" >  

                    
                    
                    <div class="form-group row  m-l-10">
                        <label class="col-form-label col-md-3 ">Nama Lengkap</label>
                        <div class="col-md-6"> 
                          
                            <input type="text" id="nama" name="nama" class="form-control" required> 
                        </div>
                    </div>  
                    <div class="form-group row m-l-10">
                        <label class="col-form-label col-md-3">Alamat</label>
                        <div class=" col-md-6">  
                            <input type="text" id="alamat" name="alamat" class="form-control" required> 
                        </div>
                    </div>   
                    
                    <div class="form-group row m-l-10">
                        <label class="col-form-label col-md-3 ">No. KTP</label>
                        <div class="col-md-6">  
                            <input type="text" id="idcard" name="idcard" class="form-control nomor text-right"  required> 
                        </div>
                    </div> 
                    <div class="form-group row m-l-10">
                        <label class="col-form-label col-md-3 ">HP/TLP</label>
                        <div class="col-md-6"> 
                            <input type="text" id="telp" name="telp" class="form-control text-right" required> 
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
                            <h4 class="m-b-5 m-l-10 text-info">Input Data Booking</h4>                            
                        </div> 
                    </div>
                </div>
                <div class="border-top my-1"></div> 
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
                <div class="form-horizontal ">
                    <div class="form-group row m-l-10">

                        <label class="col-form-label col-md-3 ">Perumahan</label>

                        <div class="col-md-8"> 
 
                            <select class="default-select2 form-control" id="properti" name="id_properti" required>

                                <option value="">-- Pilih --</option>                                                         

                                @foreach($properti as $r)

                                     <option value="{{$r->id}}">{{$r->nama_properti}}</option>                                                         

                                @endforeach

                            </select>

                        </div>

                    </div>  
                    <div class="form-group row m-l-10">

                        <label class="col-form-label col-md-3 ">Kavling / Unit</label>

                        <div class="col-md-8"> 
 
                            <select id="listunit" name="id_kav" class="default-select2 form-control" placeholder="Pilih Unit"  required >

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

                    <div class="form-group row m-l-10">
                        <label class="col-form-label col-md-3">Tanggal Booking </label>
                        <div class="col-md-4"> 
                            <div class="input-group" id="daterange-singledate">
                                <input type="text" name="tanggal" id="datepicker-default" class="form-control" placeholder="Pilih Tanggal" required/>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button"><i class="fa fa-gift"></i></button>
                                </span>
                            </div>                            
                        </div>
                    </div>  
                    <div class="form-group row m-l-10">
                        <label class="col-form-label col-md-3 ">Nominal Booking</label>
                        <div class="col-md-3">  
                            <input type="text"  name="nominal" class="form-control rupiah text-right" required> 
                        </div>
                    </div>   
                    
                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Keterangan</label>
                        <div class="input-group col-lg-9"> 
                            <textarea name="keterangan"  class="form-control" rows="2" placeholder="Keterangan" required></textarea> 
                        </div>
                    </div> 
                    

                    <div class="border-top my-1 m-b-15"></div> 
                    <div class="m-b-15">
                        <button type="submit" class="btn btn-lime btn-block btn-lg">Simpan Booking</button>
                    </div>
                </form>
            </div>
        </div>   
    </div><!--end Row --> 
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


<script type="text/javascript">

    $(document).ready(function(){

        $('#cari').keyup(function(){ 
                var query = $(this).val();
                if(query.length >=3)
                {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ url('bookingm/autocomplete') }}",
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){
                            $('#tampil').fadeIn();  
                            $('#tampil').html(data); 
                        }
                    });
                }
        });

        $(document).on('click', 'li', function(){  
            
            $('#cari').val($(this).text()); 

            $('#tampil').fadeOut();  
            var query = $(this).text();
            var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ url('bookingm/isikan') }}",
                        method:"POST",
                        dataType: 'json',
                        data:{query:query, _token:_token},
                        success:function(data){

                            $('#kode').val(data[0].kode);  
                            $('#id_konsumen').val(data[0].id);  
                            $('#nama').val(data[0].nama);  
                            $('#alamat').val(data[0].alamat);  
                            $('#idcard').val(data[0].idcard);  
                            $('#telp').val(data[0].telp);   

                        }
                    });

        });  

    });
 
</script>
<script type="text/javascript">

    $('#properti').change(function(){
        var id = $(this).val();
        $("#listunit").empty(); 
        if(id){
            $.ajax({
                type:"GET",
                url:"{{url('bookingm/listunit')}}/"+id,
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
                        url:"{{ url('bookingm/unitdetail') }}",
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

    </script>
 

@stop
