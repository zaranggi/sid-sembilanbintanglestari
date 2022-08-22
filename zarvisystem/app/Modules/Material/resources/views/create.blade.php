@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />

@stop 
@section('content')
 

<h1 class="page-header">Manage Material <small>Add new ...</small></h1>

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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/material') }}">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
 
 
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Nama</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" name="nama"  class="form-control" placeholder="Nama Material">
                                <strong style="color:red">{{ $errors->first('nama') }}</strong>
                            </div>
                        </div>  
                         
                        
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Satuan</label>
                            <div class="input-group col-lg-4">  
                               <select name="satuan" class="form-control select2">
								<option>Pilih Satuan</option>
								<option value='Biji'>Biji</option>
								<option value='Batang'>Batang</option>
								<option value='Sak'>Sak</option>
								<option value='Rit'>Rit</option>
								<option value='Meter Kubik'>Meter Kubik</option>
								<option value='Buah'>Buah</option>
								<option value='Box'>Box</option>
								<option value='Meter Persegi'>Meter Persegi</option>
								<option value='Kilogram'>Kilogram</option>
								<option value='Liter'>Liter</option>
								<option value='set'>set</option>
								<option value='meter'>meter</option>
								<option value='hari'>hari</option>
								<option value='unit'>unit</option>
								</select> 
                            </div>
                        </div>  
						<div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Rekanan</label>
                            <div class="input-group col-lg-4">  
                               <select name="id_vendor" class="form-control select2">
								@foreach($data as $r)  
									<option value="{{$r->id}}">{{$r->nama}} - {{$r->alamat}}</option> 
								@endforeach
								</select> 
                            </div>
                        </div>  
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Harga Cash</label>
                            <div class="input-group col-lg-3"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" name="price"  class="form-control rupiah text-right">
                                <strong style="color:red">{{ $errors->first('price') }}</strong>
                            </div>
                        </div>   
						
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Harga Tempo</label>
                            <div class="input-group col-lg-3"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" name="tempo"  class="form-control rupiah text-right">
                                <strong style="color:red">{{ $errors->first('price') }}</strong>
                            </div>
                        </div>   
						
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Saldo Awal</label>
                            <div class="input-group col-lg-3"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" name="begbal"  class="form-control nomor text-right">
                                <strong style="color:red">{{ $errors->first('begbal') }}</strong>
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

<script src="{{ asset("plugins/switchery/switchery.min.js")}}"></script>
<script src="{{ asset("js/page-form-slider-switcher.demo.min.js")}}"></script>
<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script>  
<script src="{{ asset('js/jquery.number.js') }}"></script> 

<script type="text/javascript"> 
    $(document).ready(function() { 
        PageDemo.init();
    });
</script> 

<script type="text/javascript"> 
    $('.nomor').number(true, 0, ',', ' ');
    $('.rupiah').number(true, 0,);
	$('.select2').select2();
</script>

@stop
