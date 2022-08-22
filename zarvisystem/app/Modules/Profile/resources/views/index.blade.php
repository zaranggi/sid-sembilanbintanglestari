@extends('admin.layout')
@section('styles')

@stop

@section('content')

@foreach($data as $r)
@endforeach
    <div class="row">
        <!-- begin col-4 -->
        <div class="col-lg-3">
            <!-- begin widget -->
            <div class="widget widget-blog">
                <div class="widget-header m-0"> 
                    <h4 class="text-info">My Profile</h4> 
                </div>
                
                <div class="widget-blog-cover" style="padding-top: 185px">
                    <img src="{{ asset("img/bg.jpg") }}" alt="" />
                </div>
                <div class="widget-blog-author">
                    <div class="widget-blog-author-image">
                        <img src="{{ asset("img/user-12.jpg") }}" alt="">
                    </div>
                    <div class="widget-blog-author-info">
                    <h5 class="m-t-0 m-b-1">{{ Auth::user()->name }}</h5>
                        <p class="text-muted m-0 f-s-11">Front End Designer</p>
                    </div>
                </div>
            
            </div>
            <!-- end widget -->
        </div>
        <!-- end col-4 -->

        <div class="col-lg-8">
            <div class="widget">
                <div class="widget-header">
                    <span class="pull-right f-s-12 f-w-600"><i class="fa fa-fw fa-circle text-lime-light f-s-12"></i> realtime</span>
                    <h4 class="text-info">Edit Profile</h4>
                </div>
                
                <div class="border-top my-3"></div>

                <div class="widget-body p-t-15 p-b-15"> 

                    <form action="{{ url('profile/ubah')}}" class="form-horizontal" role="form"  method="post" enctype="multipart/form-data">
                        @csrf
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
                        <div class="input-group col-lg-5"> 
                            <span class="input-group-addon"><i class="fa fa-user-tie"></i></span>
                            <input type="text" value="{{ $r->name }}"  name="name"  class="form-control" placeholder="Name">
                            <strong style="color:red">{{ $errors->first('name') }}</strong>
                        </div>
                    </div>
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">NIK</label>
                        <div class="input-group col-lg-5"> 
                            <span class="input-group-addon"><i class="fa fa-id-card-alt"></i></span>
                            <input type="text" value="{{ $r->nik }}"  name="nik"  class="form-control " placeholder="Nik" disabled>
                            <strong style="color:red">{{ $errors->first('nik') }}</strong>
                        </div>
                    </div>
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">Email</label>
                        <div class="input-group col-lg-5"> 
                            <span class="input-group-addon"><i class="fa fa-at"></i></span>
                            <input type="email" value="{{ $r->email }}"  name="email"  class="form-control " placeholder="email@email.com">
                            <strong style="color:red">{{ $errors->first('email') }}</strong>
                        </div>
                    </div> 
                    
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">Username</label>
                        <div class="input-group col-lg-5"> 
                            <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                            <input type="text" value="{{ $r->username }}"  name="username"  class="form-control " placeholder="Username">
                            <strong style="color:red">{{ $errors->first('username') }}</strong>
                        </div>
                    </div>
                    
                    <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">Password</label>
                        <div class="input-group col-lg-5"> 
                            <span class="input-group-addon"><i class="fa fa-user-lock"></i></span>
                            <input type="text" name="password"  class="form-control " placeholder="Password">
                            <strong style="color:red">{{ $errors->first('password') }}</strong>
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

@stop
@section('scripts')
    
@stop
