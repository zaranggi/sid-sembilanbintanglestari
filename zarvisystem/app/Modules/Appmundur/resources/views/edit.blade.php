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

@foreach($data as $r)

<h1 class="page-header">Pengajuan <small>Konsumen Mundur</small></h1>

<div class="section-container section-with-top-border p-b-5">  
    @if(Session::has('flash_message'))
    <div class="alert alert-info ">
    <span class="glyphicon glyphicon-ok">
    </span><em>  ~  {{ Session::get('flash_message') }}</em>
        </div>
    @endif
    <form id="mundur" enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ url("appmundur")}}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        <input type="hidden" name="id_spr" value="{{$id_spr}}" id="id_spr">  
        <input type="hidden" name="id_mundur" value="{{$r->id_mundur}}" id="id_mundur">  
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
                        </div>  

                </div><!--end widget-->

            </div><!--end Col 6 -->
        </div><!--end Col 6 -->

         <!-- begin col-6 -->
         <div class="col-lg-7">
            <!-- begin panel --> 
            <div class="panel panel-inverse" data-sortable-id="form-stuff-5">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                <h3 class="panel-title"><span class="label label-success">Data Properti</span></h3>
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
                                <td class="tagihan1 text-right ">{{ number_format($r->tagihan1)}}</td>  
                                <td class="bayar1 text-right ">{{ number_format($r->bayar1)}}</td>
                                <td class="kekurangan1 text-right ">{{ number_format($r->tagihan1 - $r->bayar1)}}</td>    
                            </tr>
                            <tr class="text-nowrap"> 
                                <td>Uang Muka</td>   
                                <td class="tagihan2 text-right ">{{ number_format($r->tagihan2)}}</td>  
                                <td class="bayar2 text-right ">{{ number_format($r->bayar2)}}</td>  
                                <td class="kekurangan2 text-right ">{{ number_format($r->tagihan2 - $r->bayar2)}}</td>  
                            </tr>
                            <tr class="text-nowrap"> 
                                <td>Penambahan Tanah</td>   
                                <td class="tagihan3 text-right ">{{ number_format($r->tagihan3)}}</td>  
                                <td class="bayar3 text-right ">{{ number_format($r->bayar3)}}</td> 
                                <td class="kekurangan3 text-right ">{{ number_format($r->tagihan3 - $r->bayar3)}}</td>   
                            </tr>
                            
                            <tr class="text-nowrap"> 
                                <td>Penambahan Lain-lain</td>  
                                <td class="tagihan4 text-right ">{{ number_format($r->tagihan4)}}</td>  
                                <td class="bayar4 text-right ">{{ number_format($r->bayar4)}}</td>   
                                <td class="kekurangan4 text-right ">{{ number_format($r->tagihan4 - $r->bayar4)}}</td>  
                            </tr>
                            
                            <tr class="text-nowrap"> 
                                <td>Cicilan Unit</td>   
                                <td class="tagihan5 text-right">{{ number_format($r->tagihan5)}}</td>  
                                <td class="bayar5 text-right ">{{ number_format($r->bayar5)}}</td>  
                                <td class="kekurangan5 text-right">{{ number_format($r->tagihan5 - $r->bayar5)}}</td>  
                            </tr>
                            
                            <tr class="text-nowrap"> 
                                <td>PPN</td>    
                                <td class="tagihan6 text-right ">{{ number_format($r->tagihan6)}}</td>  
                                <td class="bayar6 text-right ">{{ number_format($r->bayar6)}}</td>  
                                <td class="kekurangan6 text-right">{{ number_format($r->tagihan6 - $r->bayar6)}}</td>  
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
                        <label class="col-form-label col-lg-3">Alasan Mundur</label>
                        <div class="col-lg-9"> 
                        <textarea name="keterangan"  class="form-control" rows="5" placeholder="Alasan Mundur" readonly>{{$r->keterangan}}</textarea> 
                        </div>
                    </div>
                    <div class="border-top my-1 m-b-5"></div> 
                    <div class="border-top my-1 m-b-15"></div> 

                    <h3 class="panel-title"><span class="label label-warning">Approval Direksi</span></h3>
                       
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-lg-6 font-weight-bold text-success">Pengembalian PT Kepada Konsumen</label>
                        <div class="col-lg-4"> 
                            <input type="text" name="pengembalian" value="{{$r->pengembalian}}" class="form-control rupiah text-right" required> 
                        </div>
                    </div>

                    <div class="border-top my-1 m-b-15"></div> 
					@if($r->status == 1)
                    <div class="row">
                        <div class="col-lg-6"> 
                            <button type="submit"  id="submit" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-lime btn-block btn-md">Setujui Pengajuan</button>
                        </div>
                        <div class="col-lg-6"> 
                            <a id="submit" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-danger btn-block btn-md">Tolak Pengajuan</a>
                        </div>
                    </div>
					@endif
                    </form>
                    
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
    $('.nomor').number(true, 0,);
    $('.persen').number(true, 2, '.', ',');
    $('.rupiah').number(true, 0);
    
    $('#submit').click(function(){
        $('#submit').hide();
    });
</script>
 
@stop
