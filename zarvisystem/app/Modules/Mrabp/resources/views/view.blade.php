@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />

<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" /> 
@stop
@section('content')


    <h1 class="page-header">RAB <small>Proyek </small></h1>
    
    <div class="row">
        <div class="col-xl-6">
            
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-6"> 
                   <!-- begin panel-heading -->
                   <div class="panel-heading">
                    <h4 class="panel-title"><span class="label label-success">RAB Proyek : {{ $data->judul }}</span></h4>
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
                        <label class="col-form-label col-md-4 ">Nama Proyek</label>
                        <div class="col-md-7"> 
                        <input type="text" id="tipe" value="{{$data->judul}}" class="form-control"> 
                        </div>
                    </div> 
    
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-4 ">Kategori</label>
                        <div class="col-md-7"> 
                            <input type="text" id="tipe" value="{{$data->kategori}}"  class="form-control"> 
                        </div>
                    </div> 
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-4 ">Jenis</label>
                        <div class="col-md-7"> 
                            <input type="text"  value="{{$data->jenis}}" class="form-control"> 
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
                <h4 class="panel-title"><span class="label label-success">Data Pengerjaan</span></h4>
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
                        <label class="col-form-label col-md-3">Estimasi</label>
                        <div class="input-group col-md-3"> 
                        <input type="text"value="{{$data->hari }} Hari" class="form-control"> 
                        </div>
                    </div>  
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3">Total Pekerja</label>
                        <div class="input-group col-md-3"> 
                        <input type="text"value="{{$data->pekerja }} Orang" class="form-control"> 
                        </div>
                    </div>  
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3">Volume Proyek</label>
                        <div class="input-group col-md-3"> 
                        <input type="text"value="{{$data->qty }}" class="form-control"> 
                        </div>
                    </div>  
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3">Satuan</label>
                        <div class="input-group col-md-3"> 
                        <input type="text"value="{{$data->satuan }}" class="form-control"> 
                        </div>
                    </div> 
                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3">Nilai Proyek</label>
                        <div class="input-group col-md-3"> 
                        <input type="text"value="{{$data->gross }}" class="form-control rupiah"> 
                        </div>
                    </div>  
                     
                     
                </div>     
            </div>     

        </div><!--end Col 6 --> 
    </div><!--end Row --> 
	
	
	
    <div class="row">
        <div class="col-xl-6">            
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-6"> 
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
							@foreach($setjob as $rx) 
								<tr class="font-weight-bold">
									<td class="text-center ">{{$no}}</td>
									<td class="text-left text-nowrap"> - {{ $rx->nama }}</td>
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

        </div>
		
		<div class="col-xl-6">            
            <!-- begin panel -->
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
							 
									 <tr>
										 <td class="text-center ">1</td>
										 <td class="text-left font-weight-bold text-purple text-nowrap">Termin 1 - {{ $data->t1 }}</td>
										 <td class="text-right text-nowrap">Rp {{ number_format($data->gross * $data->t1/100  ) }}</td>
									 </tr>
									 
									 <tr>
										 <td class="text-center ">2</td>
										 <td class="text-left font-weight-bold text-purple text-nowrap">Termin 2 - {{ $data->t2 }}</td>
										 <td class="text-right text-nowrap">Rp {{ number_format($data->gross * $data->t2/100  ) }}</td>
									 </tr>
									 
									 <tr>
										 <td class="text-center ">3</td>
										 <td class="text-left font-weight-bold text-purple text-nowrap">Termin 3 - {{ $data->t3 }}</td>
										 <td class="text-right text-nowrap">Rp {{ number_format($data->gross * $data->t3/100  ) }}</td>
									 </tr>
									 
									 <tr>
										 <td class="text-center ">4</td>
										 <td class="text-left font-weight-bold text-purple text-nowrap">Termin 4 - {{ $data->t4 }}</td>
										 <td class="text-right text-nowrap">Rp {{ number_format($data->gross * $data->t4/100  ) }}</td>
									 </tr>
									 
									 <tr>
										 <td class="text-center ">5</td>
										 <td class="text-left font-weight-bold text-purple text-nowrap">Termin 5 - {{ $data->t5 }}</td>
										 <td class="text-right text-nowrap">Rp {{ number_format($data->gross * $data->t5/100  ) }}</td>
									 </tr>
									 
									 <tr>
										 <td class="text-center ">6</td>
										 <td class="text-left font-weight-bold text-purple text-nowrap">Retensi- {{ $data->retensi }}</td>
										 <td class="text-right text-nowrap">Rp {{ number_format( $data->gross * $data->retensi/100  ) }}</td>
									 </tr>
								   
								 </tbody> 
		 
							 </table>
	 
						</div>
					</div>   
				</div>   	
            </div>     

        </div>
		
    </div>
	
	 
	
    <div class="row">
        <div class="col-12">            
            <!-- begin panel -->
            <div class="panel panel-inverse" > 
                   <!-- begin panel-heading -->
                   <div class="panel-heading">
               <h4 class="panel-title"><span class="label label-success">RAB Material</span></h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                
                <div class="panel-body">
                    <table class="table table-bordered table-hover ">
                        <thead>
                            <tr class="text-center text-nowrap"> 
                                <th>No</th>  
                                <th>Material</th> 
                                <th>Volume</th> 
                                <th>Satuan</th> 
                                <th>Harga</th> 
                                <th>Total</th> 
                            </tr>

                        </thead>
                         <tbody>
                            @php 
                            $no=1;  
							$gr = 0;
                            @endphp
							@foreach($material as $r) 
								<tr class="font-weight-bold">
									<td class="text-center ">{{$no}}</td>
									<td class="text-left text-nowrap"> {{ $r->prdcd }} - {{ $r->nama }}</td>
									<td class="text-center text-nowrap">  {{ $r->qty }}</td>
									<td class="text-center text-nowrap">  {{ $r->satuan }}</td>
									<td class="text-center text-nowrap">  {{ number_format($r->price) }}</td>
									<td class="text-center text-nowrap">  {{ number_format($r->gross) }}</td>
								</tr>
								 
									@php 
										$no++; 
							$gr += ($r->gross);
									@endphp
								
							@endforeach 
								<tr class="font-weight-bold">
									<td class="text-center" colspan="5">Grand Total</td>
									<td class="text-center text-nowrap">  {{ number_format($gr) }}</td>
								</tr>
                        </tbody>
                    </table>

                </div>     
            </div>     

        </div>
	</div>
		
@stop 
@section('scripts')
<script src="{{ asset("plugins/DataTables/media/js/jquery.dataTables.js") }}"></script>
<script src="{{ asset("plugins/DataTables/media/js/dataTables.bootstrap.min.js") }}"></script>
<script src="{{ asset("plugins/DataTables/extensions/Select/js/dataTables.select.min.js") }}"></script> 
<script src="{{ asset("js/page-table-manage-select.demo.min.js") }}"></script> 
<!-- ================== END PAGE LEVEL JS ================== -->
<script src="{{ asset('js/jquery.number.js') }}"></script>  
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>

<script type="text/javascript"> 
    $('.nomor').number(true, 0, '.', ',');
    $('.rupiah').number(true, 0,);
</script>

<script>
    $(document).ready(function() { 
        PageDemo.init();
    });
</script> 
 

@stop


