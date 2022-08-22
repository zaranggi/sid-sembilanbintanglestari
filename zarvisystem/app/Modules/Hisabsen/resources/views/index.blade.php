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
 

<h1 class="page-header">Laporan <small>Absensi Karyawan...</small></h1>

<div class="section-container section-with-top-border p-b-5">  
    <div class="row">


         <!-- begin col-6 -->
         <div class="col-lg-6">
            <!-- begin panel -->
            <div class="widget"> 
                
                <div class="my-3"></div> 
                @if(Session::has('flash_message'))
                    <div class="alert alert-info ">
                <span class="glyphicon glyphicon-ok">
                </span><em>  ~  {{ Session::get('flash_message') }}</em>
                    </div>
                @endif
               <form class="form-horizontal" role="form" method="POST" action="{{ url('/hisabsen/preview') }}">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Tanggal</label>
                        <div class="input-group col-lg-9"> 
                            <div class="row row-space-10">
                                <div class="col-6">
                                    <input type="text" name="tanggal1" class="form-control"  id="datetimepicker3" placeholder="Min Date" required />
                                </div>
                                <div class="col-6">
                                    <input type="text" name="tanggal2" class="form-control" id="datetimepicker4" placeholder="Max Date" required/>
                                </div>
                            </div>
                        </div>
                    </div>   

                    <div class="border-top my-1 m-b-15"></div> 
                    <div class="m-b-15">
                        <button type="submit" class="btn btn-lime btn-block btn-lg">Preview</button>
                    </div>
                </form> 
                
            </div> 
        </div>   
    </div><!--end Row --> 


    <div class="row"> 
        <!-- begin col-6 -->
        <div class="col-lg-6">
           <!-- begin panel -->
           <div class="widget"> 
               
               <div class="my-3"></div> 
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
              <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/hisabsen') }}">

                   <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                   <div class="form-group m-b-5">
                       <label class="col-lg-3 col-form-label">File Upload</label>
                       <div class="input-group col-lg-9"> 
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                       </div>
                   </div>   

                   <div class="border-top my-1 m-b-15"></div> 
                   <div class="m-b-15">
                       <button type="submit" class="btn btn-warning btn-block btn-lg">Upload File </button>
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
<script src="{{ asset('js/jquery.number.js') }}"></script> 


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

 
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script> 

 

@stop
