@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
@stop 
@section('content')

<h1 class="page-header">Manage Users <small>Add new users...</small></h1>

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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/users') }}">

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
                        <label class="col-lg-2 col-form-label">Name</label>
                        <div class="input-group col-lg-4"> 
                            <span class="input-group-addon"><i class="fa fa-user-tie"></i></span>
                            <input type="text" name="name"  class="form-control" placeholder="Name">
                            <strong style="color:red">{{ $errors->first('name') }}</strong>
                        </div>
                    </div>
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">NIK</label>
                        <div class="input-group col-lg-4"> 
                            <span class="input-group-addon"><i class="fa fa-id-card-alt"></i></span>
                            <input type="text" name="nik"  class="form-control " placeholder="Nik">
                            <strong style="color:red">{{ $errors->first('nik') }}</strong>
                        </div>
                    </div>
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">Email</label>
                        <div class="input-group col-lg-4"> 
                            <span class="input-group-addon"><i class="fa fa-at"></i></span>
                            <input type="email" name="email"  class="form-control " placeholder="email@email.com">
                            <strong style="color:red">{{ $errors->first('email') }}</strong>
                        </div>
                    </div> 
                    
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">Username</label>
                        <div class="input-group col-lg-4"> 
                            <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                            <input type="text" name="username"  class="form-control " placeholder="Username">
                            <strong style="color:red">{{ $errors->first('username') }}</strong>
                        </div>
                    </div>
                    
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">Password</label>
                        <div class="input-group col-lg-4"> 
                            <span class="input-group-addon"><i class="fa fa-user-lock"></i></span>
                            <input type="text" name="password"  class="form-control " placeholder="Password">
                            <strong style="color:red">{{ $errors->first('password') }}</strong>
                        </div>
                    </div>

                    
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">Departemen</label>
                        <div class="input-group col-lg-4"> 
                            <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                            <select name="id_department" data-placeholder="Select a Department" class="form-control" required>
                                
                                    @foreach($listdepartment as $r)
                                        <option value="{{ $r->id }}" data-icon="users"> {{ $r->name_department }} </option>
                                    @endforeach
                              
                            </select>
                            <strong style="color:red">{{ $errors->first('id_department') }}</strong>
                        </div>
                    </div>

                    
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">Jabatan</label>
                        <div class="input-group col-lg-4"> 
                            <span class="input-group-addon"><i class="fa fa-portrait"></i></span>
                            <select name="jabatan" data-placeholder="Select a Jabatan" class="form-control" required>
                                
                                    @foreach($listjabatan as $r)
                                        <option value="{{ $r->id_jabatan }}" data-icon="users"> {{ $r->name_jabatan }} </option>
                                    @endforeach
                              
                            </select>
                            <strong style="color:red">{{ $errors->first('jabatan') }}</strong>
                        </div>
                    </div>
                    
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">Blocked User?</label>
                        <div class="input-group col-lg-4"> 
                            <p>
                                <input type="checkbox" name="active" data-render="switchery" data-theme="info" /> 
                                <code class="m-l-5"> *) klik jika users akan di-block</code>
                            </p>
                            
                        </div>
                    </div>
                    

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
<script>
    $(document).ready(function() { 
        PageDemo.init();
    });
</script>
@stop

