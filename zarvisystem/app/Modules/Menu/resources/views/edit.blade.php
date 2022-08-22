@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />

@stop 
@section('content')
 

<h1 class="page-header">Manage Menu <small>Edit menu...</small></h1>

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
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('menu.update', $menu->id) }}">

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
                            <label class="col-lg-2 col-form-label">Name Menu</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" value="{{ $menu->name_menu }}" name="name_menu"  class="form-control" placeholder="Name Menu">
                                <strong style="color:red">{{ $errors->first('name_menu') }}</strong>
                            </div>
                        </div>  
                        
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Link Address</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                <input type="text" value="{{ $menu->link }}" name="link"  class="form-control" placeholder="Link Address">
                                <strong style="color:red">{{ $errors->first('link') }}</strong>
                            </div>
                        </div> 
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Icon</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-screwdriver"></i></span>
                                <input type="text" value="{{ $menu->icon }}" name="icon"  class="form-control" placeholder="fa-icon">
                                <strong style="color:red">{{ $errors->first('icon') }}</strong>
                            </div>
                        </div>  

                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Active ?</label>
                            <div class="input-group col-lg-4"> 
                                <p>
                                    @if($menu->active == "Y")

                                    <input type="checkbox" name="active" data-render="switchery" data-theme="info" checked >

                                @else

                                    <input type="checkbox" name="active" data-render="switchery" data-theme="info">

                                @endif 
                                    
                                </p>
                                
                            </div>
                        </div>

                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Main Menu</label>
                            <div class="input-group col-lg-4"> 
                                <select name="id_main" data-placeholder="Select a Main Menu" class="form-control select-icons" data-fouc>
                                    <optgroup label="Main Menu">
                                        
                                        @foreach($listmenu as $r)
                                            @if($r->id == $menu->id_main)
                                                <option value="{{ $r->id }}" data-icon="{{ $r->icon }}" selected> {{ $r->name_menu }} </option>
                                            @elseif($menu->id_main == 0) 
                                            <option value="0" data-icon="blank" selected> Nothing </option>
                                            @else
                                                <option value="{{ $r->id }}" data-icon="{{ $r->icon }}"> {{ $r->name_menu }} </option>
                                            @endif

                                        @endforeach
                                        <option value="0" data-icon="blank"> Nothing </option>
                                    </optgroup>
                                </select>
                            </div>
                        </div> 

                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Departemen</label>
                            <div class="input-group col-lg-4">  
                                <select name="id_department[]" class="form-control multiple-select2" multiple="multiple" data-fouc>
                                    @foreach($listdepartment as $r_user)

                                    <?php $cek_level = preg_match( '/#'.$r_user->id.'#/' ,$menu->id_dep ) ?>

                                    @if($cek_level == false)

                                        <option value="#{{ $r_user->id }}#" > {{ $r_user->name_department }} </option>

                                    @else

                                        <option value="#{{ $r_user->id }}#" selected> {{ $r_user->name_department }} </option>

                                    @endif

                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Auth Access</label>
                            <div class="input-group col-lg-4">  
                                <select name="auth_access[]" class="form-control multiple-select2" multiple="multiple" data-fouc>
                                    @foreach($listjabatan as $r_user)

                                                <?php $cek_level = preg_match( '/#'.$r_user->id_jabatan.'#/' ,$menu->auth_access ) ?>

                                                @if($cek_level == false)

                                                    <option value="#{{ $r_user->id_jabatan }}#" > {{ $r_user->name_jabatan }} </option>

                                                @else

                                                    <option value="#{{ $r_user->id_jabatan }}#" selected> {{ $r_user->name_jabatan }} </option>

                                                @endif

                                            @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Auth Add</label>
                            <div class="input-group col-lg-4">  
                                <select name="auth_add[]" class="form-control multiple-select2" multiple="multiple" data-fouc>
                                    @foreach($listjabatan as $r_user)

                                        <?php $cek_level = preg_match( '/#'.$r_user->id_jabatan.'#/' ,$menu->auth_add ) ?>

                                        @if($cek_level == false)

                                            <option value="#{{ $r_user->id_jabatan }}#" > {{ $r_user->name_jabatan }} </option>

                                        @else

                                            <option value="#{{ $r_user->id_jabatan }}#" selected> {{ $r_user->name_jabatan }} </option>

                                        @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Auth Update</label>
                            <div class="input-group col-lg-4">  
                                <select name="auth_update[]" class="form-control multiple-select2" multiple="multiple" data-fouc>
                                    @foreach($listjabatan as $r_user)

                                        <?php $cek_level = preg_match( '/#'.$r_user->id_jabatan.'#/' ,$menu->auth_update ) ?>

                                        @if($cek_level == false)

                                            <option value="#{{ $r_user->id_jabatan }}#" > {{ $r_user->name_jabatan }} </option>

                                        @else

                                            <option value="#{{ $r_user->id_jabatan }}#" selected> {{ $r_user->name_jabatan }} </option>

                                        @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Auth Delete</label>
                            <div class="input-group col-lg-4">  
                                <select name="auth_delete[]" class="form-control multiple-select2" multiple="multiple" data-fouc>
                                    @foreach($listjabatan as $r_user)

                                        <?php $cek_level = preg_match( '/#'.$r_user->id_jabatan.'#/' ,$menu->auth_delete ) ?>

                                        @if($cek_level == false)

                                            <option value="#{{ $r_user->id_jabatan }}#" > {{ $r_user->name_jabatan }} </option>

                                        @else

                                            <option value="#{{ $r_user->id_jabatan }}#" selected> {{ $r_user->name_jabatan }} </option>

                                        @endif

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
