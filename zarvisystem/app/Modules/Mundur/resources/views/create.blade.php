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
 

<h1 class="page-header">Pengajuan <small>Konsumen Mundur</small></h1>

<div class="section-container section-with-top-border p-b-5">  
    @if(Session::has('flash_message'))
    <div class="alert alert-info ">
    <span class="glyphicon glyphicon-ok">
    </span><em>  ~  {{ Session::get('flash_message') }}</em>
        </div>
    @endif
    <form id="mundur" enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ url("mundur")}}">

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
               <div class="form-group row m-l-5"> 
                <div class="col-md-11"> 
                     <select id="isikankonsumen" name="id_spr" class="pilih form-control" placeholder="Pilih Konsumen" required >      
                        <option>-- Pilih Konsumen --</option>
                        @foreach($data as $r)                                
                            <option value="{{ $r->id }}">{{ $r->kode }} - <?php echo ucfirst($r->nama) ?></option>      
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
                            <div class="form-group row m-l-5">
                                <label class="col-form-label col-lg-2">Kode</label>
                                <div class="col-lg-9"> 
                                    <input type="text" id="kode"  class="form-control" readonly> 
                                </div>
                            </div>  
        
                            <div class="form-group row m-l-5">
                                <label class="col-form-label col-lg-2">Nama Lengkap</label>
                                <div class="col-lg-9"> 
                                    <input type="text"  id="nama"  class="form-control" > 
                                </div>
                            </div>  
                            <div class="form-group row m-l-5">
                                <label class="col-form-label col-lg-2">Alamat</label>
                                <div class="col-lg-9"> 
                                    <input type="text"   id="alamat"  class="form-control" > 
                                </div>
                            </div>   
                            
                            <div class="form-group row m-l-5">
                                <label class="col-form-label col-lg-2">No. KTP</label>
                                <div class="col-lg-9"> 
                                    <input type="text"  id="idcard"  class="form-control text-right" > 
                                </div>
                            </div> 
                            <div class="form-group row m-l-5">
                                <label class="col-form-label col-lg-2">HP/TLP</label>
                                <div class="col-lg-9"> 
                                    <input type="text" id="telp"  class="form-control text-right"> 
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
                
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-3 ">Properti/Perumahan</label>
                        <div class="col-lg-6"> 
                            <input type="text" id="properti"  class="form-control text-left" readonly> 
                        </div>
                    </div>  

                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-3 ">Unit/Kavling</label>
                        <div class="col-lg-3"> 
                            <input type="text" id="kavling"  class="form-control text-right" readonly> 
                        </div>
                    </div>  

                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-3 ">Tipe Unit</label>
                        <div class="col-lg-3"> 
                            <input type="text" id="tipe" class="form-control text-right" readonly> 
                        </div>
                    </div>
                     
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-3">Nama Marketing</label>
                        <div class="col-lg-6"> 
                            <input type="text" id="mkt" class="form-control" readonly> 
                        </div>
                    </div>
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-3">Nilai MOU</label>
                        <div class="col-lg-4"> 
                            <input type="text" id="mou" class="form-control rupiah text-right" readonly> 
                        </div>
                    </div>
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-3">Tertagih</label>
                        <div class="col-lg-4"> 
                            <input type="text" id="total_tagihan" class="form-control rupiah text-right" readonly> 
                        </div>
                    </div>
                   
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-3">Terbayar</label>
                        <div class="col-lg-4"> 
                            <input type="text" id="terbayar" class="form-control rupiah text-right" readonly> 
                        </div>
                    </div>
                    
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-3">Kekurangan Konsumen</label>
                        <div class="col-lg-4"> 
                            <input type="text" id="kekurangan" class="form-control rupiah text-right" readonly> 
                        </div>
                    </div>
                   
                </div>
            </div>   
       </div><!--end Row --> 
    </div><!--end Row -->   
 
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-xl-6">
           
           <!-- begin panel -->
           <div class="panel panel-inverse" data-sortable-id="form-stuff-5">
               <!-- begin panel-heading -->
               <div class="panel-heading">
               <h3 class="panel-title"><span class="label label-success">History Pembayaran Konsumen</span></h3>
                   <div class="panel-heading-btn">
                       <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                       <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                       <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                       <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                   </div>
               </div>
               <!-- end panel-heading -->
               
               <div class="panel-body">
                <!-- begin table-responsive -->
                <div class="panel pagination-grey clearfix m-b-0">
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover ">
                        <thead>
                            <tr class="text-center text-nowrap"> 
                                <th>Keterangan</th>  
                                <th>Total Tagihan</th>  
                                <th>Total Terbayar</th> 
                                <th>Total Kekurangan</th> 
                            </tr>

                        </thead>
                         <tbody>
                            <tr class="text-nowrap"> 
                                <td>Booking Fee</td>    
                                <td class="tagihan1 text-right rupiah"></td>  
                                <td class="bayar1 text-right rupiah"></td>
                                <td class="kekurangan1 text-right rupiah"></td>    
                            </tr>
                            <tr class="text-nowrap"> 
                                <td>Uang Muka</td>   
                                <td class="tagihan2 text-right rupiah"></td>  
                                <td class="bayar2 text-right rupiah"></td>  
                                <td class="kekurangan2 text-right rupiah"></td>  
                            </tr>
                            <tr class="text-nowrap"> 
                                <td>Penambahan Tanah</td>   
                                <td class="tagihan3 text-right rupiah"></td>  
                                <td class="bayar3 text-right rupiah"></td> 
                                <td class="kekurangan3 text-right rupiah"></td>   
                            </tr>
                            
                            <tr class="text-nowrap"> 
                                <td>Penambahan Lain-lain</td>  
                                <td class="tagihan4 text-right rupiah"></td>  
                                <td class="bayar4 text-right rupiah"></td>   
                                <td class="kekurangan4 text-right rupiah"></td>  
                            </tr>
                            
                            <tr class="text-nowrap"> 
                                <td>Cicilan Unit</td>   
                                <td class="tagihan5 text-right rupiah"></td>  
                                <td class="bayar5 text-right rupiah"></td>  
                                <td class="kekurangan5 text-right rupiah"></td>  
                            </tr>
                            
                            <tr class="text-nowrap"> 
                                <td>PPN</td>    
                                <td class="tagihan6 text-right rupiah"></td>  
                                <td class="bayar6 text-right rupiah"></td>  
                                <td class="kekurangan6 text-right rupiah"></td>  
                            </tr> 
                        </tbody>
                    </table>

                    </div>
                </div>
            <!-- end table -->   
               </div>     
           </div>     

       </div><!--end Col 6 -->

        <!-- begin col-6 -->
        <div class="col-xl-6">
           
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-5">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                <h3 class="panel-title"><span class="label label-success">Pengajuan Konsumen Mundur</span></h3>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                
                <div class="panel-body">
                 <!-- begin table-responsive -->
                 <div class="panel pagination-grey clearfix m-b-0">
                       
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-2">Alasan Mundur</label>
                        <div class="col-lg-9"> 
                            <textarea name="keterangan"  class="form-control" rows="5" placeholder="Alasan Mundur" ></textarea> 
                        </div>
                    </div>
                    <div class="border-top my-1 m-b-15"></div> 
                    <div class="m-b-15">
                        <button type="submit"  id="submit" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-success btn-block btn-lg">Simpan Pengajuan</button>
                    </div>
                    </form>
                    
                 </div>
             <!-- end table -->   
                </div>     
            </div>     
 
        </div><!--end Col 6 -->
    </div>

 
</div><!--end Section --> 


@stop
 
@section('scripts')

<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script> 
<script src="{{ asset('js/jquery.number.js') }}"></script>  

<script type="text/javascript"> 
    $('.nomor').number(true, 0,);
    $('.persen').number(true, 2, '.', ',');
    $('.rupiah').number(true, 0,);
    function tandaPemisahTitik(b){
        var _minus = false;
        if (b<0) _minus = true;
        b = b.toString();
        b=b.replace(".","");
        b=b.replace("-","");
        c = "";
        panjang = b.length;
        j = 0;
        for (i = panjang; i > 0; i--){
        j = j + 1;
        if (((j % 3) == 1) && (j != 1)){
        c = b.substr(i-1,1) + "." + c;
        } else {
        c = b.substr(i-1,1) + c;
        }
        }
        if (_minus) c = "-" + c ;
        return c;
    }
</script>

<script>
    $(document).ready(function() {    
        
        $(".default-select2").select2();
    });
$(document).on('click', '#submit', function(){  
    $('#submit').hide();    
         
});  
</script>


<script type="text/javascript">

    $(document).ready(function(){
        $(".pilih").select2();
        $('#isikankonsumen').change(function(){
             
             var query = $(this).val();
             var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ url('mundur/isikan') }}",
                method:"POST",
                dataType: 'json',
                data:{query:query, _token:_token},
                success:function(data){

                    $('#kode').val(data[0].kode);  
                    $('#nama').val(data[0].nama_konsumen);  
                    $('#alamat').val(data[0].alamat);  
                    $('#idcard').val(data[0].idcard);  
                    $('#telp').val(data[0].telp);   
                    $('#properti').val(data[0].nama_properti);  
                    $('#kavling').val(data[0].nama_kav);  
                    $('#tipe').val(data[0].tipe_unit);  
                    $('#mkt').val(data[0].nama_marketing);  

                    $('#mkt').val(data[0].nama_marketing);  

                    $('#mou').val(data[0].nilai_mou);  
                    $('#total_tagihan').val(data[0].total_tagihan);  
                    $('#terbayar').val(data[0].terbayar);  
                    $('#kekurangan').val(data[0].kekurangan);  

                    @for($i=1; $i<=6;$i++)
                        $('.tagihan{{$i}}').html(tandaPemisahTitik(data[0].tagihan{{$i}})); 
                        $('.bayar{{$i}}').html(tandaPemisahTitik(data[0].bayar{{$i}}));  
                        
                        $('.kekurangan{{$i}}').html(tandaPemisahTitik(data[0].tagihan{{$i}} - data[0].bayar{{$i}}));  
                    @endfor
                
                }

            });
 
 
        });
    });
 
</script>
 
@stop
