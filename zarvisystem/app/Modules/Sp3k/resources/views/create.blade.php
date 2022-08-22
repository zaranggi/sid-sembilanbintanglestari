@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" /> 


<link href="{{ asset("plugins/bootstrap-calendar/css/bootstrap_calendar.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")}}" rel="stylesheet" /> 


@stop 
@section('content')
 

<h1 class="page-header">SP3K  <small>add new...</small></h1>

<div class="section-container section-with-top-border p-b-5">  
    @if(Session::has('flash_message'))
    <div class="alert alert-info ">
    <span class="glyphicon glyphicon-ok">
    </span><em>  ~  {{ Session::get('flash_message') }}</em>
        </div>
    @endif
    <form id="spr" enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ url("sp3k")}}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        <input type="hidden" name="id_spr" id="id_spr">  
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
                <div class="border-top my-1"></div> 
                <!-- begin panel -->
                <div class="form-horizontal">  
                     
                        <div class="input-group m-b-15">
                            <input type="text" id="cari" class="form-control" placeholder="Enter keywords..." />
                            <div id="tampil">
                            </div>
                            <div class="input-group-append">
                                <i class="fa fa-search"></i>
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

                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Kode</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="kode" id="kode"  class="form-control" > 
                        </div>
                    </div>  

                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Nama Lengkap</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" id="nama"  class="form-control"> 
                        </div>
                    </div>  
                    <div class="form-group m-b-10">
                        <label class="col-lg-3 col-form-label">Alamat</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" id="alamat"  class="form-control" > 
                        </div>
                    </div>   
                    
                    <div class="form-group m-b-10">
                        <label class="col-lg-3 col-form-label">No. KTP</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" id="idcard"  class="form-control text-right" > 
                        </div>
                    </div> 
                    <div class="form-group m-b-10">
                        <label class="col-lg-3 col-form-label">HP/TLP</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" id="telp"  class="form-control text-right" > 
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
                <div class="form-horizontal">
                
                    <div class="form-group m-b-15">
                        <label class="col-lg-3 col-form-label">Properti/Perumahan</label>
                        <div class="input-group col-lg-6"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" id="properti"  class="form-control text-right" readonly> 
                        </div>
                    </div>  

                    <div class="form-group m-b-15">
                        <label class="col-lg-3 col-form-label">Unit/Kavling</label>
                        <div class="input-group col-lg-6"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" id="kavling"  class="form-control text-right" readonly> 
                        </div>
                    </div>  

                    <div class="form-group m-b-15">
                        <label class="col-lg-3 col-form-label">Type</label>
                        <div class="input-group col-lg-3"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" id="tipe"  class="form-control text-right" readonly> 
                        </div>
                    </div>   
                    <div class="form-group m-b-15">
                        <label class="col-lg-3 col-form-label">Nominal KPR</label>
                        <div class="input-group col-lg-4"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" id="gross"  class="form-control rupiah text-right" readonly> 
                        </div>
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
                           <h4 class="m-b-5 m-l-10 text-info">Form SP3K</h4>   
                                                   
                       </div> 
                   </div>
               </div>
               <div class="border-top my-1"></div> 
               <!-- begin panel -->
               <div class="form-horizontal">  

                <div class="form-group m-b-15">
                    <label class="col-lg-3 col-form-label">BANK KPR</label>
                    <div class="input-group col-lg-8"> 
                        <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                        <select name="bank" class="default-select2 form-control" placeholder="Pilih Perumahan" required >
                            <option>-- pilih --</option>       
                            @foreach($bank as $r)                                
                                <option value="{{ $r->nama }}">{{ $r->nama }}</option>      
                            @endforeach

                        </select>
                    </div>
                </div>   

                <div class="form-group m-b-15">
                    <label class="col-lg-4 col-form-label">Tanggal SP3K</label>
                    <div class="input-group col-lg-5"> 
                        <div class="input-group" id="daterange-singledate">
                            <input type="text" name="tanggal_sp3k" id="tanggal1" class="form-control" placeholder="Pilih Tanggal" required/>
                            <span class="input-group-btn">
                                <i class="fa fa-calendar-alt text-info"></i>
                            </span>
                        </div>                            
                    </div>
                </div>   

                <div class="form-group m-b-15">
                    <label class="col-lg-4 col-form-label">Nominal ACC</label>
                    <div class="input-group col-lg-6"> 
                        <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                        <input type="text" name="nominal_acc" class="form-control rupiah text-right"> 
                    </div>
                </div>    
                <div class="form-group m-b-15">
                    <label class="col-lg-4 col-form-label">Jangka Waktu / Tenor(bulan)</label>
                    <div class="input-group col-lg-6"> 
                        <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                        <input type="text" name="jangka_waktu" class="form-control nomor text-right"> 
                    </div>
                </div>     
                <div class="form-group m-b-15">
                    <label class="col-lg-4 col-form-label">Angsuran KPR</label>
                    <div class="input-group col-lg-6"> 
                        <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                        <input type="text" name="angsuran" class="form-control rupiah text-right"> 
                    </div>
                </div>  
                
                <div class="form-group m-b-15">
                    <label class="col-lg-3 col-form-label">Jenis KPR</label>
                    <div class="input-group col-lg-4"> 
                        <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                        <select name="jenis_kredit" class="default-select2 form-control" placeholder="Pilih Perumahan" required >
                            <option>-- pilih --</option>     
                                <option value="Subsidi">Subsidi</option>      
                                <option value="Non Subsidi">Non Subsidi</option>      
                        </select>
                    </div>
                </div>   
                
                <div class="form-group m-b-15">
                    <label class="col-lg-4 col-form-label">Biaya Bank</label>
                    <div class="input-group col-lg-6"> 
                        <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                        <input type="text" name="biaya" class="form-control rupiah text-right"> 
                    </div>
                </div>  
                
                 
                <div class="form-group m-b-10">
                    <label class="col-lg-4 col-form-label">File SP3K </label>
                    <div class="input-group col-lg-6"> 
                        <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                        <input type="file" name="file"  class="form-control">
                        <strong style="color:red">{{ $errors->first('file') }}</strong>
                    </div>
                </div>  


                   
            </div>
            <div class="border-top my-1 m-b-15"></div> 
            <div class="m-b-15">
                <button type="submit" value="1" id="save" class="btn btn-lime btn-block btn-lg">Simpan SP3K</button>
            </div>
        </div>     

    </div><!--end Row --> 

</div><!--end Section --> 
</form>



@stop
 
@section('scripts')

<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script> 
<script src="{{ asset('js/jquery.number.js') }}"></script> 


<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>

<script type="text/javascript"> 
    $('.nomor').number(true, 0,);
    $('.persen').number(true, 2, '.', ',');
    $('.rupiah').number(true, 0,);
</script>

<script>
    $(document).ready(function() {   
        
            $("#tanggal1").datepicker(
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
        
        $(".default-select2").select2();
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

        $('#cari').keyup(function(){ 
                var query = $(this).val();
                if(query.length >=3)
                {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ url('sp3k/autocomplete') }}",
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
                        url:"{{ url('sp3k/isikan') }}",
                        method:"POST",
                        dataType: 'json',
                        data:{query:query, _token:_token},
                        success:function(data){

                            $('#kode').val(data[0].kode);   
                            $('#nama').val(data[0].nama);  
                            $('#alamat').val(data[0].alamat);  
                            $('#idcard').val(data[0].idcard);  
                            $('#telp').val(data[0].telp);    
                            $('#tipe').val(data[0].tipe);  
                            $('#properti').val(data[0].nama_properti);  
                            $('#kavling').val(data[0].nama_kav);
                            $('#gross').val(data[0].gross);  
                            $('#id_spr').val(data[0].id_spr);  

                        }
                    });

        }); 
    });
 
</script>
 
@stop
