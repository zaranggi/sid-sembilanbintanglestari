@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" /> 


<link href="{{ asset("plugins/bootstrap-calendar/css/bootstrap_calendar.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")}}" rel="stylesheet" /> 


@stop 
@section('content')
 

<h1 class="page-header">Form <small>Pengajuan Cuti Karyawan...</small></h1>

<div class="section-container section-with-top-border p-b-5">  
    <div class="row">


         <!-- begin col-6 -->
         <div class="col-lg-6">
            <!-- begin panel -->
            <div class="widget">   
					@if(Session::has('flash_message'))
                        <div class="alert alert-info ">
                      <span class="glyphicon glyphicon-ok">
                      </span><em>  ~  {{ Session::get('flash_message') }}</em>
                        </div>
                    @endif
                
                <div class="my-3"></div> 
                    
               <form class="form-horizontal" role="form" method="POST" action="{{ url('/cuti') }}">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
					<div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Jenis Cuti</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-home  text-info"></i></span>
                            <select class="default-select2 form-control" name="jenis_cuti" required> 
								<option value="Cuti Tahunan">Cuti Tahunan</option>
								<option value="Cuti Melahirkan">Cuti Melahirkan</option>
                            </select>
                        </div>
                    </div> 
					
                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Tanggal</label>
                        <div class="input-group col-lg-9"> 
                            <div class="row row-space-10">
                                <div class="col-6">
                                    <input type="text" name="tanggal1" class="form-control"  id="datetimepicker3" placeholder="Start Date" required />
                                </div>
                                <div class="col-6">
                                    <input type="text" name="tanggal2" class="form-control" id="datetimepicker4" placeholder="End Date" required/>
                                </div>
                            </div>
                        </div>
                    </div>

					<div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Keterangan Cuti</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-book  text-info"></i></span>
                             <textarea name="keterangan"  class="form-control" rows="3" placeholder="Keterangan Cuti" required></textarea> 
                        </div>
                    </div> 
					

                 
                    <div class="border-top my-1 m-b-15"></div> 
                    <div class="m-b-15">
                        <button type="submit" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-lime btn-block btn-lg">Ajukan Cuti</button>
                    </div>
                </form> 
                
            </div> 
        </div>   
    </div><!--end Row --> 
</div><!--end Section -->
  



@stop
 
@section('scripts')

<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script>   
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>

<script>
    $(document).ready(function() {   
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
       
        
        $(".default-select2").select2();
    });
</script> 

@stop
