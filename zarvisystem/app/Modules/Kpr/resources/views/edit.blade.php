@extends('admin.layout') 
@section('styles')  
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />  
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-calendar/css/bootstrap_calendar.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")}}" rel="stylesheet" /> 
@stop 
@section('content')
 

<h1 class="page-header">Pengajuan KPR<small> Update Data...</small></h1>

<div class="section-container section-with-top-border p-b-10">    
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
				<form enctype="multipart/form-data" method="POST" action="{{ url('kpr/update')}}">
                    @csrf  
                    <input type="hidden" name="id_spr" value="{{$id}}">
                    
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
 
 
					@foreach($data as $data)
                    @endforeach
					<input type="hidden" name="id_kpr" value="{{$data->id}}">
                       <div class="form-group row m-l-15">
                            <label class="col-form-label col-md-3">Tanggal Pengajuan KPR</label>
                            <div class="col-md-4"> 
                                <div class="input-group" id="daterange-singledate">
                                    <input type="text" name="tanggal" value="{{ $data->tanggal}}" id="datepicker-default" class="form-control" placeholder="Pilih Tanggal" required/>
                                    <span class="input-group-btn">
                                        <i class="fa fa-calendar-alt text-info"></i>
                                    </span>
                                </div>      
                            </div>
                        </div>  
                        
                        <div class="form-group row m-l-15">
                            <label class="col-form-label col-md-3">Bank</label>
                            <div class="col-md-4"> 
                                <select name="bank" class="default-select2 form-control" data-fouc required>
								<option value="{{$data->bank}}" selected> {{$data->bank}}</option>
                                    @foreach($bank as $r)
                                        <option value="{{ $r->nama }}"> {{ $r->nama }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row m-l-15">
                            <label class="col-form-label col-md-3">Status KPR</label>
                            <div class="col-md-4"> 
                                <select name="status" class="default-select2 form-control" data-fouc required>
                                    <option value="{{$data->status}}" selected> {{$data->status}}</option>
									<option value="Proses"> Proses </option>
                                    <option value="ACC"> ACC </option> 
                                    <option value="Tolak"> Tolak</option>
                                </select>
                            </div>
                        </div>
						
						<div class="form-group row m-l-15">
                            <label class="col-form-label col-md-3">Nominal Pengajuan</label>
                            <div class="col-md-4"> 
                                <input type="text" name="nominal_pengajuan" value="{{$data->nominal}}" class="form-control rupiah text-right">                                
                            </div>
                        </div>

                       <div class="form-group row m-l-15">
                            <label class="col-form-label col-md-3">Keterangan Pengajuan</label>
                            <div class="col-md-4"> 
                                <textarea name="keterangan"  class="form-control" rows="3" placeholder="Keterangan">{{$data->keterangan}}</textarea> 
                            </div>
                        </div> 						
						
						<hr/>
						
						<div class="form-group row m-l-15">
                            <label class="col-form-label col-md-3">Tanggal SP3K</label>
                            <div class="col-md-4"> 
                                <div class="input-group" id="daterange-singledate">
                                    <input type="text" value="{{$data->tanggal_sp3k}}" name="tanggal_sp3k" id="datepicker-default2" class="form-control" placeholder="Pilih Tanggal" />
                                    <span class="input-group-btn">
                                        <i class="fa fa-calendar-alt text-info"></i>
                                    </span>
                                </div>      
                            </div>
                        </div>
						
						
						<div class="form-group row m-l-15">
                            <label class="col-form-label col-md-3">Nominal SP3K</label>
                            <div class="col-md-4"> 
                                <input type="text" name="nominal_sp3k" value="{{$data->nominal_sp3k}}" class="form-control rupiah text-right">                                
                            </div>
                        </div> 
						 
						<div class="form-group row m-l-15">
                            <label class="col-form-label col-md-3 ">Lampiran SP3K</label>
                            <div class="col-md-4"> 
                                <input type="file" name="photo" class="form-control" placeholder="File SP3K">                            
                            </div>
                        </div>  

                        <div class="form-group row m-l-15">
                            <label class="col-form-label col-md-3">Keterangan</label>
                            <div class="col-md-4"> 
                                <textarea name="keterangan_sp3k"  class="form-control" rows="3" placeholder="Keterangan">{{$data->keterangan_sp3k}}</textarea> 
                            </div>
                        </div> 
                          
                        <div class="border-top my-3"></div>
                        <div class="col-md-6 "> 
                            <div class="text-right"> 
                                <button type="submit" id="simpan" onclick="return confirm('Apakah Anda Yakin?')"  class="btn btn-primary"><i class="fa fa-paper-plane ml-2"></i> Save </button>
    
                                <a href="{{ URL::previous() }}" class="btn btn-warning"><i class="fa fa-redo-alt ml-2"></i> Cancel </a>
    
                            </div> 
    
                    </form>
                </div>
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
<script src="{{ asset('js/jquery.number.js') }}"></script> 
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
			
		$("#datepicker-default2").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            });
            
        $(".default-select2").select2();
    });
</script>
<script>
    $(document).ready(function() { 
        PageDemo.init();
    });
</script>
@stop
