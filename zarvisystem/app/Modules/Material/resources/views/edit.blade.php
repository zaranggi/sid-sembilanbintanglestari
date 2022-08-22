@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />

@stop 
@section('content')
 

<h1 class="page-header">Manage Material <small>Edit ...</small></h1>

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
                @foreach($data as $data)
                @endforeach
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('material.update', $data->prdcd) }}">

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
  
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Nama</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" name="nama"  value="{{ $data->nama }}" class="form-control" placeholder="Nama Material">
                                <strong style="color:red">{{ $errors->first('nama') }}</strong>
                            </div>
                        </div>  
                       
                        
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Satuan</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" name="satuan"  value="{{ $data->satuan }}" class="form-control" placeholder="Satuan">
                                <strong style="color:red">{{ $errors->first('satuan') }}</strong>
                            </div>
                        </div>  
						<div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Rekanan</label>
                            <div class="input-group col-lg-4">  
                               <select name="id_vendor" class="form-control select2">
								@foreach($vendor as $r)  
									@if($data->id_vendor == $r->id)
										<option value="{{$r->id}}" selected>{{$r->nama}} - {{$r->alamat}}</option> 
									@else
										<option value="{{$r->id}}" >{{$r->nama}} - {{$r->alamat}}</option> 
									@endif
								@endforeach
								</select> 
                            </div>
                        </div>  
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Harga Cash</label>
                            <div class="input-group col-lg-2"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" name="price"  value="{{ $data->price }}" class="form-control rupiah text-right">
                                <strong style="color:red">{{ $errors->first('price') }}</strong>
                            </div>
                        </div> 
						 <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Harga Tempo</label>
                            <div class="input-group col-lg-2"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" name="tempo"  value="{{ $data->tempo }}" class="form-control rupiah text-right">
                                <strong style="color:red">{{ $errors->first('price') }}</strong>
                            </div>
                        </div>   
						
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Saldo Awal</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" name="begbal"  value="{{ $data->begbal }}" class="form-control nomor text-rightright>
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
</script>
@stop
