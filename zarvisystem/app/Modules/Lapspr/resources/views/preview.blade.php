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
@endforeach

<h1 class="page-header">MOU Konsumen <small>Detail...</small></h1>

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
				
<div class="section-container section-with-top-border p-b-5">  

    
    <div class="row">
         <!-- begin col-6 -->
         <div class="col-lg-5">
            <div class="widget"> 
                <!-- begin panel -->
                <div class="horizontal-divider m-0 m-b-15"></div>  
                <div class="widget-header p-t-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="m-b-5 m-l-10 text-info">Data Konsumen</h4>                            
                        </div> 
                    </div>
                </div>
                <div class="border-top my-1"></div>    

                    <div class="form-group row m-l-10">
                        <label class="col-form-label col-md-3 ">Kode MOU</label>
                        <div class="col-md-6"> 
                            <input type="text" name="kode" value="{{ $r->kode }}" id="kode"  class="form-control" > 
                        </div>
                    </div>  

                    <div class="form-group row m-l-10">
                        <label class="col-form-label col-md-3">Nama Lengkap</label>
                        <div class="col-md-6"> 

                            <input type="text" id="nama" value="{{ $r->nama_konsumen }}" class="form-control"> 
                        </div>
                    </div>  
                    <div class="form-group row m-l-10">
                        <label class="col-form-label col-md-3">Alamat</label>
                        <div class="col-md-6"> 

                            <input type="text" id="alamat" value="{{ $r->alamat }}"  class="form-control" > 
                        </div>
                    </div>   
                    
                    <div class="form-group row m-l-10">
                        <label class="col-form-label col-md-3 ">No. KTP</label>
                        <div class="col-md-6"> 

                            <input type="text" id="idcard" value="{{ $r->idcard }}" class="form-control nomor text-right" > 
                        </div>
                    </div> 
                    <div class="form-group row m-l-10">
                        <label class="col-form-label col-md-3 ">HP/TLP</label>
                        <div class="col-md-6"> 

                            <input type="text" id="telp" value="{{ $r->telp }}" class="form-control text-right" > 
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
                        <label class="col-form-label col-md-3 ">Properti/Perumahan</label>
                        <div class="col-md-6"> 

                            <select id="properti" name="id_properti" class="default-select2 form-control" placeholder="Pilih Perumahan" required >
                            <option> {{ $r->nama_properti }}</option>  

                            </select>
                        </div>
                    </div>  

                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3 ">Unit/Kavling</label>
                        <div class="col-md-6"> 

                            <select id="listunit" name="id_kav" class="default-select2 form-control" placeholder="Pilih Unit"  required >
                                <option> {{ $r->nama_kav }}</option>  

                            </select>
                        </div>
                    </div>  

                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3 ">Type</label>
                        <div class="col-lg-3"> 

                            <input type="text" id="tipe" value="{{ $r->tipe }}"  class="form-control nomor text-right" readonly> 
                        </div>
                    </div>  
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3 ">Luas Tanah m<sup>2</sup></label>
                        <div class="col-lg-3"> 

                            <input type="text" id="lt" value="{{ $r->luas_tanah }}" class="form-control nomor text-right" readonly> 
                        </div>
                    </div>  
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3 ">Luas Bangunan m<sup>2</sup></label>
                        <div class="col-lg-3"> 

                            <input type="text" id="lb" value="{{ $r->luas_bangunan }}" class="form-control nomor text-right" readonly> 
                        </div>
                    </div>  
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3 ">Harga Brosur</label>
                        <div class="col-lg-4"> 

                            <input type="text" id="harga" value="{{ number_format($r->harga) }}" class="form-control rupiah text-right" readonly> 
                        </div>
                    </div>  

                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3 ">Bonus</label>
                        <div class="col-md-6">  
                            <textarea name="bonus"  class="form-control" rows="3" placeholder="Bonus" >{{ $r->bonus }}</textarea> 
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
                           <h4 class="m-b-5 m-l-10 text-info">Form MOU</h4>   
                                                   
                       </div> 
                   </div>
               </div>
               <div class="border-top my-1"></div> 
               <!-- begin panel --> 

                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 ">Tanggal</label>
                        <div class="col-lg-5"> 
                            <div class="input-group" id="daterange-singledate">
                                <input type="text" value="{{ App\Helpers\Tanggal::tgl_indo($r->tgl_transaksi) }}" name="tgl_transaksi" id="tanggal2" class="form-control" placeholder="Pilih Tanggal" required/>
                                <span class="input-group-btn">
                                    <i class="fa fa-calendar-alt text-info"></i>
                                </span>
                            </div>                            
                        </div>
                    </div>   
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 ">Harga Kesepakatan</label>
                        <div class="col-md-5">  
                            <input type="text" id="gross_unit" value="{{ number_format($r->gross_unit) }}" name="gross_unit"  class="form-control rupiah text-right" placeholder="0" required> 
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



                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 ">Luas Tanah m<sup>2</sup></label>
                        <div class=" col-md-6">  
                            <input type="text" id="plt" name="luas_penambahan_tanah" value="{{ number_format($r->luas_penambahan_tanah) }}"  class="form-control nomor text-right" placeholder="0" > 
                        </div>
                    </div>  
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 ">Harga per m<sup>2</sup></label>
                        <div class=" col-md-6">  
                            <input type="text" id="pht" name="harga_penambahan_tanah" value="{{ number_format($r->harga_penambahan_tanah) }}" class="form-control rupiah text-right" placeholder="0" > 
                        </div>
                    </div>  
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 font-weight-bold text-lime">Total</label>
                        <div class=" col-md-6">  
                            <input type="text" id="tplt" name="gross_penambahan_tanah" value="{{ number_format($r->gross_penambahan_tanah) }}" class="form-control rupiah text-right" placeholder="0" > 
                        </div>
                    </div>  
                    
                    <div class="border-top my-1"></div> 

                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 ">Penambahan Lain<sup>2</sup></label>
                        <div class="input-group col-lg-9">  
                        <textarea name="penambahan_lain"  class="form-control" rows="3" placeholder="Penambahan" >{{$r->penambahan_lain}}</textarea> 
                        </div>
                    </div>  
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 ">Harga Penambahan</label>
                        <div class=" col-md-6">  
                            <input type="text" id="pll" name="harga_penambahan_lain" value="{{ number_format($r->harga_penambahan_lain) }}" class="form-control rupiah text-right" placeholder="0" > 
                        </div>
                    </div>  
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 font-weight-bold text-lime ">Total</label>
                        <div class=" col-md-6">  
                            <input type="text" id="tpll" name="gross_penambahan_lain" value="{{ number_format($r->gross_penambahan_lain) }}" class="form-control rupiah text-right" placeholder="0" > 
                        </div>
                    </div>  
                    <div class="border-top my-10"></div> 
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 font-weight-bold text-info">Total Setelah Penambahan</label>
                        <div class=" col-md-6">  
                            <input type="text" id="tall" name="gross_total" value="{{ number_format($r->gross_total) }}" class="form-control font-weight-bold rupiah text-right" placeholder="0" required> 
                        </div>
                    </div>  
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 font-weight-bold text-info">PPN 10%</label>
                        <div class=" col-md-6">  
                            <input type="text" name="ppn" value="{{ number_format($r->ppn) }}" class="form-control rupiah text-right font-weight-bold" placeholder="0" required> 
                        </div>
                    </div>  
                    <div class="border-top my-1"></div> 
					<div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 font-weight-bold text-lime">Total Setelah PPN</label>
                        <div class=" col-md-6">  
                            <input type="text" value="{{ number_format($r->gross_total + $r->ppn) }}" class="form-control rupiah text-right font-weight-bold" placeholder="0" required> 
                        </div>
                    </div>  
					
					<div class="border-top my-1"></div> 
					
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 ">Tanda Jadi</label>
                        <div class=" col-md-6"> 
                            <input type="text" name="gross_booking" value="{{ number_format($r->gross_booking) }}" class="form-control rupiah text-right" placeholder="0" required> 
                        </div>
                    </div> 
                    <div class="border-top my-1"></div> 
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 ">Uang Muka/DP</label>
                        <div class=" col-md-6"> 
                            <input type="text" name="gross_booking" value="{{ number_format($r->gross_um) }}" class="form-control rupiah text-right" placeholder="0" required> 
                        </div>
                    </div>  
                    
                   
            </div>
        </div>   


        <!-- begin col-6 -->
        <div class="col-lg-6">
            <div class="widget"> 
                <div class="widget-header p-t-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="m-b-5 m-l-10 text-info">Metode Pembayaran</h4>   
                                                    
                        </div> 
                    </div>
                </div>
                <div class="border-top my-1"></div> 
                <!-- begin panel -->
                <div class="form-horizontal">   
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3 ">Pembayaran Unit</label>
                        <div class="col-md-4"> 

                            <select id="cbu" name="cara_bayar_unit"  class="default-select2 form-control" placeholder="Pembayaran Unit" required >
                            @if($r->cara_bayar_unit == "bertahap")
								<option > {{ strtoupper($r->cara_bayar_unit)}}</option>       
							@else 
								<option > {{ strtoupper($r->cara_bayar_unit)}}</option>       
							@endif
                            </select>
                        </div>
                    </div>  
					

                    <div class="form-group row m-l-15"  id="pumx" >
                        <label class="col-form-label col-md-3 ">Periode UM/DP</label>
                        <div class="col-md-3"> 

                            <select class="form-control" id="pum" placeholder="Pembayaran Unit" name="tahapan_um" required >
                            <option  selected>{{ $r->tahapan_um }}</option>                                            
                            </select>
                        </div>
                    </div>   
					

                    <div class="form-group row m-l-15"  id="display_cunit">
                        <label class="col-form-label col-md-3 ">Cicilan Unit</label>
                        <div class=" col-md-3"> 
                            <select class="form-control" id="t_cunit"  name="tahapan_unit" placeholder="Pembayaran Unit" required >
                                <option  selected>{{ $r->tahapan_unit }}</option>                       
                            </select>
                        </div>
                    </div>   


                    <div class="border-top my-1"></div> 
                    <div class="border-top my-1"></div> 

                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 ">Jatuh Tempo Booking Fee</label>
                        <div class=" col-md-6"> 
                            <div class="input-group" id="daterange-singledate">
                                <input type="text" name="tanggal_jt_booking" value="{{ App\Helpers\Tanggal::tgl_indo($r->tanggal_jt_booking) }}" id="tanggal3" class="form-control" placeholder="Pilih Tanggal"/>
                                <span class="input-group-btn">
                                    <i class="fa fa-calendar-alt text-info"></i>
                                </span>
                            </div>                            
                        </div>
                    </div> 
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 ">Jatuh Tempo UM/DP</label>
                        <div class=" col-md-6"> 
                            <div class="input-group" id="daterange-singledate">
                                <input type="text" name="tanggal_jt_um" value="{{ App\Helpers\Tanggal::tgl_indo($r->tanggal_jt_um) }}" id="tanggal4" class="form-control" placeholder="Pilih Tanggal"/>
                                <span class="input-group-btn">
                                    <i class="fa fa-calendar-alt text-info"></i>
                                </span>
                            </div>                            
                        </div>
                    </div>   
                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 ">Jatuh Tempo Penambahan </label>
                        <div class=" col-md-6"> 
                            <div class="input-group" id="daterange-singledate">
                                <input type="text" name="tanggal_jt_penambahan" value="{{ App\Helpers\Tanggal::tgl_indo($r->tanggal_jt_penambahan) }}" id="tanggal5" class="form-control" placeholder="Pilih Tanggal"/>
                                <span class="input-group-btn">
                                    <i class="fa fa-calendar-alt text-info"></i>
                                </span>
                            </div>                            
                        </div>
                    </div>    

                    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-5 ">Cicilan Unit Per</label>
                        <div class=" col-md-6"> 
                            <div class="input-group" id="daterange-singledate">
                                <input type="text" name="tanggal_jt_unit" value="{{ App\Helpers\Tanggal::tgl_indo($r->tanggal_jt_unit) }}" class="form-control"/>
                                <span class="input-group-btn">
                                    <i class="fa fa-calendar-alt text-info"></i>
                                </span>
                            </div>                            
                        </div>
                    </div>    

                 </div> 
                 <div class="border-top my-1 m-b-15"></div> 
                 
         </div>   


    </div><!--end Row --> 
	
		<div class="col-lg-8">
            <div class="widget"> 
                <div class="widget-header p-t-10">
                    <div class="row">
                        <div class="col-lg-12">
                           <h4 class="m-b-5 m-l-10 text-info">Detail Tagihan Konsumen</h4>   
                            <table class="table table-bordered">
								<thead>
									<tr class="text-center text-warning">
										<th>NO</th>
										<th>Keterangan</th>
										<th>Pembayaran ke-</th>
										<th>Nominal</th>
									</tr>
								</thead>
								<tbody>
								@php $no = 1; $t = 0; @endphp
								@foreach($tagihan as $r)
									<tr>
										<td class="text-center">{{ $no }}</td>
										<td>{{ $r->nama_tagihan}}</td>
										<td class="text-center">{{ $r->urutan}}</td>
										<td class="text-right">{{ number_format($r->tagihan)}}</td>
									</tr>
									@php $no++; $t += $r->tagihan @endphp
								@endforeach
								</tbody>
								<tfoot>
									<tr class="bg-info font-weight-bold text-center"><th colspan="3">Grand Total</th><th class="text-right">{{ number_format($t)}}</th>
								</tfoot>
							</table>							
                        </div> 
                    </div>
                </div>
			</div>
		</div>
	
	</div>
	</div>
</div>



@stop
 
@section('scripts')
 

@stop
