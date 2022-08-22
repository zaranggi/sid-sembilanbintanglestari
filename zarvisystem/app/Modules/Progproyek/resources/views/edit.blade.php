@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />

<link href="{{ asset("plugins/bootstrap-calendar/css/bootstrap_calendar.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")}}" rel="stylesheet" /> 

@stop 
@section('content')
 

<h1 class="page-header">Update Progress <small>Proyek ...</small></h1>

<div class="section-container section-with-top-border p-b-10">    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    
                    <div class="form-horizontal" role="form"> 
					
                        @if(Session::has('flash_message'))
                        <div class="alert alert-info ">
                            <span class="glyphicon glyphicon-ok">
                            </span><em>  ~  {{ Session::get('flash_message') }}</em>
                        </div>
                        @endif 
						
						<h4 class="panel-title">Detail Pekerjaan</h4>
					
					 <div class="border-top my-3"></div>


                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover ">
                            <thead>
                                <tr class="text-center text-nowrap"> 
                                    <th>No</th>  
                                    <th>List Pekerjaan</th> 
                                    <th>Bobot</th> 
                                    <th>Photo 1</th> 
                                    <th>Photo 2</th> 
                                    <th>Photo 3</th> 
                                    <th>Status</th> 
                                    <th>Tanggal</th> 
                                    <th></th> 
                                </tr>

                            </thead>
                             <tbody>
                                @php 
									$no=1;  
								@endphp
                        @foreach($data as $x) 
						 
                                        <tr>
											<td class="text-center ">{{$no}}</td>
											<td class="text-left text-nowrap">- {{ $x->nama_pekerjaan }}</td> 
											<td class="text-left text-nowrap"> {{ $x->bobot }}%</td> 
											<td class="text-center text-nowrap"> 
											@if($x->photo1 <> "")
												<a href="{{ url('image/project/'.$x->photo1) }}" 
												onclick="window.open(this.href, '_blank', 'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); 
												return false;"><i class="fa fa-camera fa-2x" aria-hidden="true"></i>
												</a>
												@endif
											</td> 
											<td class="text-center text-nowrap"> 
											@if($x->photo2 <> "")
											<a href="{{ url('image/project/'.$x->photo2) }}" 
												onclick="window.open(this.href, '_blank', 'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); 
												return false;"><i class="fa fa-camera fa-2x" aria-hidden="true"></i>
												</a>
												@endif
											</td> 
											
											<td class="text-center text-nowrap"> 
												@if($x->photo3 <> "")
													<a href="{{ url('image/project/'.$x->photo3) }}" 
														onclick="window.open(this.href, '_blank', 'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); 
														return false;"><i class="fa fa-camera fa-2x" aria-hidden="true"></i>
														</a>
												@endif
											</td> 
											<td class="text-center text-nowrap"> 
											@if($x->status == "0")
												<span class="text-warning"> Progress</span>
											@else
												<span class="text-info">Selesai</span>
											@endif</td> 
											
											<td class="text-left text-nowrap text-sm">  {{ App\Helpers\Tanggal::indonesian_date($x->updated_at) }}</td> 
											<td class="text-center text-nowrap" >       
													<a href="#modal-dialog" id="{{ $x->id }}" class="text-successed progres" data-toggle="modal">
														<i class="fa fa-pen-alt text-warning"></i> 
													</a>                               
												 
											</td>
											 
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
                       
                        <div class="border-top my-3"></div>
						
                     
                </div>
            </div>
        </div>
    </div>
</div>



    <!-- #modal-dialog -->
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Laporan Progres Proyek</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ url("progproyek/simpan")}}">
                        @csrf  
                        <input type="hidden" name="id" id="id_progres" value=""> 
                        
                        <div class="form-group m-b-10">
                            <label class="col-lg-3 col-form-label">Photo 1</label>
                            <div class="input-group col-lg-9"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="file" name="photo1"  class="form-control" placeholder="Photo 1" required>                            
                            </div>
                        </div> 
						
                        <div class="form-group m-b-10">
                            <label class="col-lg-3 col-form-label">Photo 2</label>
                            <div class="input-group col-lg-9"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="file" name="photo2"  class="form-control" placeholder="Photo 3" required>                            
                            </div>
                        </div> 
						
                        <div class="form-group m-b-10">
                            <label class="col-lg-3 col-form-label">Photo 3</label>
                            <div class="input-group col-lg-9"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="file" name="photo3"  class="form-control" placeholder="Photo 3" required>                            
                            </div>
                        </div> 
						
						<div class="form-group m-b-10">
							<label class="col-lg-3 col-form-label">Status</label>
							<div class="input-group col-lg-7"> 
								<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
								<select name="status" class="form-control" required >
										<option value="0">Progress</option>      
										<option value="1">Selesai</option>      
								</select>
							</div>
						</div> 
						
    
                      
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn width-100 btn-primary">Simpan</a>
                    </form>  
                </div>
            </div>
        </div>
    </div>


@stop
 
@section('scripts')

<script src="{{ asset("plugins/switchery/switchery.min.js")}}"></script>
<script src="{{ asset("js/page-form-slider-switcher.demo.min.js")}}"></script>
<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script> 

<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>
 

<script type="text/javascript">
    $(document).ready(function() {   
        $("#datepicker-default").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            }); 
        });
</script>

<script type="text/javascript">
    $(document).on('click', '.progres', function(){  
        var id_progres = $(this).attr("id");  
        $('#id_progres').val(id_progres);    
             
    });  
    </script>
@stop
