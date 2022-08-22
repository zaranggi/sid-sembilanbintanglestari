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
 

<h1 class="page-header">Manage SP3K<small>...</small></h1>

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
                    <form enctype="multipart/form-data" class="form-horizontal" method="POST" role="form" action="{{ route('sp3k.update', $data->id) }}"> 
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
                            <label class="col-lg-3 col-form-label">BANK KPR</label>
                            <div class="input-group col-lg-8"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <select id="properti" name="bank" class="default-select2 form-control" placeholder="Pilih Perumahan" required >
                                    <option value="{{ $data->bank }}" selected> {{$data->bank}} }}</option>       
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
                                <input type="text" value="{{ $data->tanggal_sp3k }}" name="tanggal_sp3k" id="tanggal1" class="form-control" placeholder="Pilih Tanggal" required/>
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
                                <input type="text" value="{{ $data->nominal_acc }}"  name="nominal_acc" class="form-control rupiah text-right"> 
                            </div>
                        </div>    
                        <div class="form-group m-b-15">
                            <label class="col-lg-4 col-form-label">Jangka Waktu / Tenor(bulan)</label>
                            <div class="input-group col-lg-6"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" value="{{ $data->jangka_waktu }}"  name="jangka_waktu" class="form-control nomor text-right"> 
                            </div>
                        </div>     
                        <div class="form-group m-b-15">
                            <label class="col-lg-4 col-form-label">Angsuran KPR</label>
                            <div class="input-group col-lg-6"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" value="{{ $data->angsuran }}" name="angsuran" class="form-control rupiah text-right"> 
                            </div>
                        </div>  
                        
                        <div class="form-group m-b-15">
                            <label class="col-lg-3 col-form-label">Jenis KPR</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <select name="jenis_kredit" class="default-select2 form-control" placeholder="Pilih Perumahan" required >
                                    <option value="{{ $data->jenis_kredit }}" selected>{{ $data->jenis_kredit }}</option>     
                                        <option value="Subsidi">Subsidi</option>      
                                        <option value="Non Subsidi">Non Subsidi</option>      
                                </select>
                            </div>
                        </div>   
                        
                        <div class="form-group m-b-15">
                            <label class="col-lg-4 col-form-label">Biaya Bank</label>
                            <div class="input-group col-lg-6"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text"  value="{{ $data->biaya }}" name="biaya" class="form-control rupiah text-right"> 
                            </div>
                        </div>  
                        
                         
                        <div class="form-group m-b-10">
                            <label class="col-lg-4 col-form-label">File SP3K </label>
                            <div class="input-group col-lg-6"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="file" name="file"  class="form-control">
                                <strong style="color:red">{{ $errors->first('file') }}</strong>
                                <code>*) Kosongkan jika tidak ada perubahan file</code>
                            </div>
                        </div>  
        
                        <div class="border-top my-3"></div>
                        <div class="col-md-6 "> 
                            <div class="text-right"> 
                                <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane ml-2"></i> Save </button>
    
                                <a href="{{ URL::previous() }}" class="btn btn-warning"><i class="fa fa-redo-alt ml-2"></i> Cancel </a>
    
                            </div> 
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
 
@section('scripts')
 
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>
<script src="{{ asset('js/jquery.number.js') }}"></script>  

<script type="text/javascript"> 
    $('.nomor').number(true, 0,);
    $('.persen').number(true, 2, '.', ',');
    $('.rupiah').number(true, 0,);
</script>
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
