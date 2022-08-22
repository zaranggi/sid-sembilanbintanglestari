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
 

<h1 class="page-header">Manage Surat Masuk<small>...</small></h1>
  
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Form Input</h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <form enctype="multipart/form-data" class="form-horizontal" method="POST" role="form" action="{{ route('suratout.update', $data->id) }}"> 
                        @csrf
                        @method('PATCH') 
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
 
						<div class="form-group m-b-15">
                            <label class="col-lg-2 col-form-label">Tanggal</label>
                            <div class="input-group col-lg-4"> 
								<div class="input-group">
									<input type="text" value="{{$data->tanggal}}" name="tanggal" id="tanggal" class="form-control" placeholder="Pilih Tanggal" required/>
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
								</div>        
                                                     
                            </div>
                        </div>   
						
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Nomor Agenda/Thn</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" value="{{$data->kode}}" name="kode"  class="form-control" placeholder="Nomor">
                                <strong style="color:red">{{ $errors->first('kode') }}</strong>
                            </div>
                        </div>  
                         
                      
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Dikirim Ke </label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" name="pengirim" value="{{$data->pengirim}}" class="form-control" placeholder="">
                                <strong style="color:red">{{ $errors->first('pengirim') }}</strong>
                            </div>
                        </div>  
                         
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Perihal </label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" value="{{$data->perihal}}" name="perihal"  class="form-control" placeholder="">
                                <strong style="color:red">{{ $errors->first('perihal') }}</strong>
                            </div>
                        </div>   
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">File Surat </label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="file" name="file"  class="form-control">
                                <strong style="color:red">{{ $errors->first('file') }}</strong>
                            </div>
                        </div>  
                         

                        <div class="border-top my-3"></div>
                        <div class="col-md-6 "> 
                            <div class="text-right"> 
                                <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane ml-2"></i> Save </button>
    
                                <a href="{{ URL::previous() }}" class="btn btn-warning"><i class="fa fa-redo-alt ml-2"></i> Cancel </a>
    
                            </div> 
                        </div>
                                            <div class="my-3"></div>
                    </form>
                </div>
            </div>
        </div>
    </div> 

@stop
 
@section('scripts')
 
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>
 
<script>
    $(document).ready(function() {   
        $("#tanggal").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            }); 
         
    });
</script>
@stop
