@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />


<link href="{{ asset("plugins/bootstrap-calendar/css/bootstrap_calendar.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")}}" rel="stylesheet" /> 

@stop 
@section('content')
 

<h1 class="page-header">Manage Legalitas <small>Add new ...</small></h1>

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
                    <form class="form-horizontal" enctype="multipart/form-data"  role="form" method="POST" action="{{ url('/legalformal') }}">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id_properti" value="{{ $id_properti }}">
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
                            <label class="col-lg-2 col-form-label">Kategori Dokumen</label>
                            <div class="input-group col-lg-4">  
                                <select name="kategori" class="form-control pilih" required>
                                    <option value="Perusahaan">Perusahaan</option>
                                    <option value="Proyek">Proyek</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Nama Dokumen</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" name="nama"  class="form-control" placeholder="Nama Dokumen" required>
                                <strong style="color:red">{{ $errors->first('nama') }}</strong>
                            </div>
                        </div>
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">File Dokumen</label>
                            <div class="input-group col-lg-4"> 
                                <div class="custom-file">
                                    <input type="file" name="namafile" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
 
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Jenis Dokumen</label>
                            <div class="input-group col-lg-4">  
                                <select name="id_jenis" class="form-control pilih" required>
                                    @foreach($jenis_legalformal as $r_jenis)
                                        <option value="{{ $r_jenis->id }}"> {{ $r_jenis->jenis_legalformal }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Tanggal Terbit</label>
                            <div class="input-group col-lg-4">  
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" name="tgl_terbit" class="form-control"  id="datetimepicker3" placeholder="Tanggal Terbit" required />
                            </div>
                        </div>  
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Tanggal Expired</label>
                            <div class="input-group col-lg-4">  
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" name="tgl_exp" class="form-control"  id="datetimepicker4" placeholder="Tanggal Expired" required />
                            </div>
                        </div>  
                        
    
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Kavling Unit</label>
                            <div class="input-group col-lg-4">  
                                <select name="id_kav" class="form-control pilih">
                                    <option value="" selected> None </option>
                                    @foreach($properti_kav as $r_kav)
                                        <option value="{{ $r_kav->id }}"> {{ $r_kav->nama }} </option>
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
 
<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script>  
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>

<script>
    $(document).ready(function() {   
        $(".pilih").select2();
        $("#datetimepicker3").datepicker( {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            });
        $("#datetimepicker4").datepicker( {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            });
        
    });
</script>

<script>
    $(document).ready(function() { 
        PageDemo.init();
    });
</script>
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>  
@stop
