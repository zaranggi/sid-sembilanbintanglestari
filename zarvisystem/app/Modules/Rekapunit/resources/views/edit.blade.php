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
 

<h1 class="page-header">Data Tagihan <small>Konsumen</small></h1>

<div class="section-container section-with-top-border p-b-5">  
     @foreach($data as $r)
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-6">
            <!-- begin panel -->
           <div class="panel panel-inverse" data-sortable-id="form-stuff-5">
               <!-- begin panel-heading -->
               <div class="panel-heading">
               <h3 class="panel-title"><span class="label label-success">Data Konsumen</span></h3>
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
					<div class="border-top my-1"></div>  
                            <div class="form-group row m-l-5">
                                <label class="col-form-label col-lg-2">Kode</label>
                                <div class="col-lg-9"> 
                                <input type="text" id="kode" value="{{$r->kode}}" class="form-control" readonly> 
                                </div>
                            </div>  
        
                            <div class="form-group row m-l-5">
                                <label class="col-form-label col-lg-2">Nama Lengkap</label>
                                <div class="col-lg-9"> 
                                    <input type="text"  id="nama" value="{{$r->nama_konsumen}}"  class="form-control" > 
                                </div>
                            </div>  
                            <div class="form-group row m-l-5">
                                <label class="col-form-label col-lg-2">Alamat</label>
                                <div class="col-lg-9"> 
                                    <input type="text"   id="alamat"  value="{{$r->alamat}}"  class="form-control" > 
                                </div>
                            </div>   
                            
                            <div class="form-group row m-l-5">
                                <label class="col-form-label col-lg-2">No. KTP</label>
                                <div class="col-lg-9"> 
                                    <input type="text"  id="idcard" value="{{$r->idcard}}"   class="form-control text-right" > 
                                </div>
                            </div> 
                            <div class="form-group row m-l-5">
                                <label class="col-form-label col-lg-2">HP/TLP</label>
                                <div class="col-lg-9"> 
                                    <input type="text" id="telp" value="{{$r->telp}}"  class="form-control text-right"> 
                                </div>
                            </div>  
		
				</div><!--end widget-->
			</div><!--end widget-->
        </div><!--end widget-->

		</div><!--end Col 6 -->

         <!-- begin col-6 -->
         <div class="col-lg-6">
             <!-- begin panel -->
           <div class="panel panel-inverse" data-sortable-id="form-stuff-5">
               <!-- begin panel-heading -->
               <div class="panel-heading">
               <h3 class="panel-title"><span class="label label-success">Data Unit</span></h3>
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
                        <label class="col-form-label col-lg-3 ">Properti/Perumahan</label>
                        <div class="col-lg-6"> 
                            <input type="text" id="properti" value="{{$r->nama_properti}}" class="form-control text-left" readonly> 
                        </div>
                    </div>  

                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-3 ">Unit/Kavling</label>
                        <div class="col-lg-3"> 
                            <input type="text" id="kavling" value="{{$r->nama_kav}}" class="form-control text-right" readonly> 
                        </div>
                    </div>  

                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-3 ">Tipe Unit</label>
                        <div class="col-lg-3"> 
                            <input type="text" id="tipe" value="{{$r->tipe_unit}}" class="form-control text-right" readonly> 
                        </div>
                    </div>
                     
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-3">Nama Marketing</label>
                        <div class="col-lg-6"> 
                            <input type="text" id="mkt" value="{{$r->nama_marketing}}" class="form-control" readonly> 
                        </div>
                    </div>
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-3">Nilai MOU</label>
                        <div class="col-lg-4"> 
                            <input type="text" id="mou" value="{{$r->nilai_mou}}" class="form-control rupiah text-right" readonly> 
                        </div>
                    </div>
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-3">Tertagih</label>
                        <div class="col-lg-4"> 
                            <input type="text" id="total_tagihan" value="{{$r->total_tagihan}}"  class="form-control rupiah text-right" readonly> 
                        </div>
                    </div>
                   
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-3">Terbayar</label>
                        <div class="col-lg-4"> 
                            <input type="text" id="terbayar" value="{{$r->terbayar}}"  class="form-control rupiah text-right" readonly> 
                        </div>
                    </div>
                    
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-3">Kekurangan Konsumen</label>
                        <div class="col-lg-4"> 
                            <input type="text" id="kekurangan" value="{{$r->kekurangan}}"  class="form-control rupiah text-right" readonly> 
                        </div>
                    </div> 
						
					</div>
				</div>   
		   </div><!--end Row --> 
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
                                <td class="tagihan1 text-right rupiah">{{ number_format($r->tagihan1)}}</td>  
                                <td class="bayar1 text-right rupiah">{{ number_format($r->bayar1)}}</td>
                                <td class="kekurangan1 text-right rupiah">{{ number_format($r->tagihan1 - $r->bayar1)}}</td>    
                            </tr>
                            <tr class="text-nowrap"> 
                                <td>Uang Muka</td>   
                                <td class="tagihan2 text-right rupiah">{{ number_format($r->tagihan2)}}</td>  
                                <td class="bayar2 text-right rupiah">{{ number_format($r->bayar2)}}</td>  
                                <td class="kekurangan2 text-right rupiah">{{ number_format($r->tagihan2 - $r->bayar2)}}</td>  
                            </tr>
                            <tr class="text-nowrap"> 
                                <td>Penambahan Tanah</td>   
                                <td class="tagihan3 text-right rupiah">{{ number_format($r->tagihan3)}}</td>  
                                <td class="bayar3 text-right rupiah">{{ number_format($r->bayar3)}}</td> 
                                <td class="kekurangan3 text-right rupiah">{{ number_format($r->tagihan3 - $r->bayar3)}}</td>   
                            </tr>
                            
                            <tr class="text-nowrap"> 
                                <td>Penambahan Lain-lain</td>  
                                <td class="tagihan4 text-right rupiah">{{ number_format($r->tagihan4)}}</td>  
                                <td class="bayar4 text-right rupiah">{{ number_format($r->bayar4)}}</td>   
                                <td class="kekurangan4 text-right rupiah">{{ number_format($r->tagihan4 - $r->bayar4)}}</td>  
                            </tr>
                            
                            <tr class="text-nowrap"> 
                                <td>Cicilan Unit</td>   
                                <td class="tagihan5 text-right rupiah">{{ number_format($r->tagihan5)}}</td>  
                                <td class="bayar5 text-right rupiah">{{ number_format($r->bayar5)}}</td>  
                                <td class="kekurangan5 text-right rupiah">{{ number_format($r->tagihan5 - $r->bayar5)}}</td>  
                            </tr>
                            
                            <tr class="text-nowrap"> 
                                <td>PPN</td>    
                                <td class="tagihan6 text-right rupiah">{{ number_format($r->tagihan6)}}</td>  
                                <td class="bayar6 text-right rupiah">{{ number_format($r->bayar6)}}</td>  
                                <td class="kekurangan6 text-right rupiah">{{ number_format($r->tagihan6 - $r->bayar6)}}</td>  
                            </tr> 
                        </tbody>
                    </table>

                    </div>
                </div>
            <!-- end table -->   
               </div>     
           </div>     

       </div><!--end Col 6 -->

    </div>

 
</div><!--end Section --> 

    @endforeach
@stop
 
@section('scripts')

<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script> 
<script src="{{ asset('js/jquery.number.js') }}"></script>  

<script type="text/javascript"> 
    $('.nomor').number(true, 0);
    $('.persen').number(true, 2, '.', ',');
    $('.rupiah').number(true, 0);
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
