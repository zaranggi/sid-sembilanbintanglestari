@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" /> 
 
@stop 
@section('content')
 
@foreach($data as $r)
@endforeach
<h3 class="m-b-20">SPK Revisi Unit  <small>View</small></h3>


    <div class="row">
        <div class="col-xl-6">
            
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-6"> 
                   <!-- begin panel-heading -->
                   <div class="panel-heading">
                    <h4 class="panel-title"><span class="label label-success">SPK : {{ $r->kode }}</span></h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                
                <div class="panel-body">
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-4 ">Jenis SPK</label>
                        <div class="col-md-7"> 
                        <input type="text" id="tipe" value="{{$r->judul}}" class="form-control"> 
                        </div>
                    </div> 
    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-4 ">Pihak Pertama</label>
                        <div class="col-md-7"> 
                            <input type="text" id="tipe" value="{{$r->nama_pihak1}}"  class="form-control"> 
                        </div>
                    </div> 
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-4 ">Pihak Kedua</label>
                        <div class="col-md-7"> 
                            <input type="text"  value="{{$r->nama_subkon}}" class="form-control"> 
                        </div>
                    </div>  
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-4 ">Tanggal Mulai </label>
                        <div class="col-md-5"> 
                            <input type="text" value="{{ App\Helpers\Tanggal::tgl_indo($r->tanggal_mulai) }}" name="tipe" class="form-control"> 
                        </div>
                    </div>  
                    
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-4 ">Tanggal Selesai</label>
                        <div class="col-md-5"> 
                            <input type="text" value="{{ App\Helpers\Tanggal::tgl_indo($r->tanggal_bast) }}" class="form-control"> 
                        </div>
                    </div>   
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-4 ">Total Borongan </label>
                        <div class="col-md-5"> 
                            <input type="text" value="{{$r->gross_total}}" class="form-control nomor text-right"> 
                        </div>
                    </div> 
                </div>     
            </div>     

        </div><!--end Col 6 -->
        
         <!-- begin col-6 -->
         <div class="col-xl-6">
            
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-5">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                <h4 class="panel-title"><span class="label label-success">Data Proyek</span></h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                
                <div class="panel-body"> 
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3">Perumahan</label>
                        <div class="input-group col-md-5"> 
                        <input type="text"value="{{$r->nama_properti }}" class="form-control"> 
                        </div>
                    </div>    
                </div>   
                <div class="panel-body"> 
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3">Kavling</label>
                        <div class="input-group col-md-5"> 
                        <input type="text"value="{{$r->nama_kav }}" class="form-control"> 
                        </div>
                    </div>    
                </div>   
                <div class="panel-body"> 
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3">Tipe Unit</label>
                        <div class="input-group col-md-5"> 
                        <input type="text"value="{{$r->tipe_unit }}" class="form-control"> 
                        </div>
                    </div>    
                </div>     
            </div>     

        </div><!--end Col 6 -->

       


    </div><!--end Row -->  
 
  

    <div class="row">
        <!-- begin col-6 -->
        <div class="col-xl-6">
           
           <!-- begin panel -->
           <div class="panel panel-inverse" data-sortable-id="form-stuff-5">
               <!-- begin panel-heading -->
               <div class="panel-heading">
               <h4 class="panel-title"><span class="label label-success">Detail Pekerjaan</span></h4>
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
                                <th>No</th>  
                                <th>List Pekerjaan</th> 
                                <th>Bobot Pekerjaan</th> 
                            </tr>

                        </thead>
                         <tbody>
                            @php 
                            $no=1;  
                            @endphp
                    @foreach($job as $rx)
                     
                        <tr class="font-weight-bold">
                            <td class="text-center ">{{$no}}</td>
                            <td class="text-left text-nowrap"> - {{ $rx->nama_pekerjaan }}</td>
                            <td class="text-center text-nowrap">  {{ $rx->bobot }}%</td>
                        </tr>
                         
                            @php 
                                $no++; 
                            @endphp
                        
                    @endforeach 

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
                <h4 class="panel-title"><span class="label label-success">Termin</span></h4>
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
                                 <th>No</th>  
                                 <th>Keterangan</th> 
                                 <th>Nilai</th> 
                             </tr>
 
                         </thead>
                          <tbody>
                             @php 
                             $no=1;  
                             @endphp
                     @foreach($termin as $rx) 
                         <tr>
                             <td class="text-center ">{{$no}}</td>
                             <td class="text-left font-weight-bold text-purple text-nowrap"> - {{ $rx->ket_termin }}</td>
                             <td class="text-right text-nowrap">Rp {{ number_format($rx->nilai) }}</td>
                         </tr>
                          
                             @php 
                                 $no++; 
                             @endphp
                         
                     @endforeach 
 
                         </tbody>
 
 
                     </table>
 
                     </div>
                 </div>
             <!-- end table -->   
                </div>     
            </div>     
 
        </div><!--end Col 6 -->


    </div>


@stop
 
@section('scripts')
 
<script src="{{ asset('js/jquery.number.js') }}"></script> 
 
<script type="text/javascript"> 
    $('.nomor').number(true, 0,);
    $('.persen').number(true, 2, '.', ',');
    $('.rupiah').number(true, 0,);
</script>
  
 
@stop
