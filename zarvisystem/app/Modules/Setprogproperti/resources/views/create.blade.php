@extends('admin.layout') 
@section('styles') 

@stop 
@section('content')
 

<h1 class="page-header">Manage List Progress <small>Add new...</small></h1>

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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/setprogproperti') }}">

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
                                <input type="text" name="nama"  class="form-control" placeholder="Nama Dokumen">
                                <strong style="color:red">{{ $errors->first('nama') }}</strong>
                            </div>
                        </div>  
                        <!--
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Bobot</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" name="bobot"  class="form-control" placeholder="Bobot">
                                <strong style="color:red">{{ $errors->first('bobot') }}</strong>
                            </div>
                        </div>  
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Main Progress</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-portrait"></i></span>
                                <select name="id_main" data-placeholder="Pilih Main Progress" class="form-control" required>
                                        <option value="0" data-icon="users"> Bukan Sub Progress</option>
                                        @foreach($listprogress as $r)
                                            <option value="{{ $r->id }}" data-icon="users"> {{ $r->nama }} </option>
                                        @endforeach
                                  
                                </select>
                                <strong style="color:red">{{ $errors->first('id_main') }}</strong>
                            </div>
                        </div>
                    -->
                        

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
 
@stop
