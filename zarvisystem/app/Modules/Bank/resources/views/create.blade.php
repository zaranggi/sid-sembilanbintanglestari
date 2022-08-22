@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />

@stop 
@section('content')
 

<h1 class="page-header">Manage BANK PT <small>Add new ...</small></h1>

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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/bank') }}">

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
                            <label class="col-lg-2 col-form-label">Nama Bank Bank</label>
                            <div class="input-group col-lg-4"> 
                                <select name="nama" data-placeholder="Pilih Bank" class="form-control select-icons" data-fouc>                                     
                                        <option value="0" data-icon="blank" selected> Nothing </option>
                                        @foreach($data_bank as $r)
                                            <option value="{{ $r->nama }}"> {{ $r->nama }} </option>
                                        @endforeach                                    
                                </select>
                            </div>
                        </div>  
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">No. Rekening</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" name="nomor_rekening"  class="form-control" placeholder="Nomor Rekening">
                                <strong style="color:red">{{ $errors->first('nomor_rekening') }}</strong>
                            </div>
                        </div>   
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Atas Nama</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" name="atas_nama"  class="form-control" placeholder="Atas Nama">
                                <strong style="color:red">{{ $errors->first('atas_nama') }}</strong>
                            </div>
                        </div>   
						
						
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Relasi Akun pada Akuntansi</label>
                            <div class="input-group col-lg-4"> 
                                <select name="acc_kode" data-placeholder="Pilih Akun" class="form-control select-icons" >                                     
                                        <option value="0" data-icon="blank" selected> Nothing </option>
                                        @foreach($ak as $r)
                                            <option value="{{ $r->kode }}"> {{ $r->kode }} - {{ $r->nama_akun }} </option>
                                        @endforeach                                    
                                </select>
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
<script>
    $(document).ready(function() { 
        PageDemo.init();
    });
</script>
<script>
    $(document).ready(function() {  
        $(".multiple-select2").select2({placeholder:"Select a Department"})
    });
</script>
@stop
