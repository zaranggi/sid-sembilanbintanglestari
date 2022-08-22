@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
@stop 
@section('content')

<h1 class="page-header">Edit Data  <small>Karyawan...</small></h1>

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
                    <form method="post" class="form-horizontal" role="form" action="{{ route('karyawan.update', $users->id) }}"> 
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
                        <label class="col-lg-2 col-form-label">Name</label>
                        <div class="input-group col-lg-4"> 
                            <span class="input-group-addon"><i class="fa fa-user-tie"></i></span>
                            <input type="text" value="{{ $users->name }}"  name="name"  class="form-control" placeholder="Name">
                            <strong style="color:red">{{ $errors->first('name') }}</strong>
                        </div>
                    </div>
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">NIK</label>
                        <div class="input-group col-lg-4"> 
                            <span class="input-group-addon"><i class="fa fa-id-card-alt"></i></span>
                            <input type="text" value="{{ $users->nik }}"  name="nik"  class="form-control" required>
                            <strong style="color:red">{{ $errors->first('nik') }}</strong>
                        </div>
                    </div>
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">Email</label>
                        <div class="input-group col-lg-4"> 
                            <span class="input-group-addon"><i class="fa fa-at"></i></span>
                            <input type="email" value="{{ $users->email }}"  name="email"  class="form-control " placeholder="email@email.com">
                            <strong style="color:red">{{ $errors->first('email') }}</strong>
                        </div>
                    </div> 
                    
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">Username</label>
                        <div class="input-group col-lg-4"> 
                            <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                            <input type="text" value="{{ $users->username }}"  name="username"  class="form-control " placeholder="Username">
                            <strong style="color:red">{{ $errors->first('username') }}</strong>
                        </div>
                    </div>
                    
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">Password</label>
                        <div class="input-group col-lg-4"> 
                            <span class="input-group-addon"><i class="fa fa-user-lock"></i></span>
                            <input type="text" name="password"  class="form-control " placeholder="Password">
                            <strong style="color:red">{{ $errors->first('password') }}</strong>
                            <code class="m-l-5"> *) Kosongkan jika tidak ada perubahan</code>
                        </div>
                    </div>
 
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">Jabatan</label>
                        <div class="input-group col-lg-4"> 
                            <span class="input-group-addon"><i class="fa fa-portrait"></i></span>
                            <select name="jabatan" data-placeholder="Select a Jabatan" class="form-control" required>
                                
                                @foreach($listjabatan as $r)
                                    @if($users->id_jabatan == $r->id_jabatan)
                                        <option value="{{ $r->id_jabatan }}" data-icon="users" selected> {{ $r->name_jabatan }} </option>
                                    @else 
                                        <option value="{{ $r->id_jabatan }}" data-icon="users"> {{ $r->name_jabatan }} </option>
                                    @endif 
                                @endforeach

                            </select>
                            <strong style="color:red">{{ $errors->first('jabatan') }}</strong>
                        </div>
                    </div>
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">Blocked User?</label>
                        <div class="input-group col-lg-4"> 
                            
                            <p>
                                @if($users->is_blocked== "1")
                                    <input type="checkbox" name="active" data-render="switchery" data-theme="danger" checked data-fouc>
                                @else
                                    <input type="checkbox" name="active" data-render="switchery" data-theme="info"/>
                                @endif
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

