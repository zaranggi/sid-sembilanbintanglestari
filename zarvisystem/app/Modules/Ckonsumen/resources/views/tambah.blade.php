@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" /> 

@stop 
@section('content')
 

<h1 class="page-header">Manage Calon Konsumen <small>Add new...</small></h1>

<div class="section-container section-with-top-border p-b-5">  
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-6">
            <!-- begin panel -->
            <div class="widget"> 
                <div class="widget-header p-t-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="m-b-5 m-l-10 text-info">Data Diri</h4>                            
                        </div> 
                    </div>
                </div>
                <div class="border-top my-1"></div> 
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/ckonsumen/saveadd') }}">

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

                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Nama Lengkap</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="nama"  class="form-control" placeholder="Nama Lengkap">
                            <strong style="color:red">{{ $errors->first('nama') }}</strong>
                        </div>
                    </div>  
                    <div class="form-group m-b-10">
                        <label class="col-lg-3 col-form-label">Alamat</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="alamat"  class="form-control" placeholder="Alamat">
                            <strong style="color:red">{{ $errors->first('alamat') }}</strong>
                        </div>
                    </div>  
                    
                    <div class="form-group m-b-10">
                        <label class="col-lg-3 col-form-label">Email</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="email" name="email"  class="form-control" placeholder="Email@gmail.com">
                            <strong style="color:red">{{ $errors->first('email') }}</strong>
                        </div>
                    </div>  
                        
                    
                    <div class="form-group m-b-10">
                        <label class="col-lg-3 col-form-label">No. KTP</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="idcard"  class="form-control nomor text-right">
                            <strong style="color:red">{{ $errors->first('idcard') }}</strong>
                        </div>
                    </div>
                    
                    <div class="form-group m-b-10">
                        <label class="col-lg-3 col-form-label">No. NPWP</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="npwp"  class="form-control nomor text-right">
                            <strong style="color:red">{{ $errors->first('npwp') }}</strong>
                        </div>
                    </div>  
                    <div class="form-group m-b-10">
                        <label class="col-lg-3 col-form-label">HP/TLP</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="telp"  class="form-control text-right">
                            <strong style="color:red">{{ $errors->first('telp') }}</strong>
                        </div>
                    </div>  
            </div>
        </div>  
         <!-- begin col-6 -->
        <div class="col-lg-6">
            <div class="widget"> 
                <div class="widget-header p-t-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="m-b-5 m-l-10 text-info">Data Pekerjaan</h4>                            
                        </div> 
                    </div>
                </div>
                <div class="border-top my-1"></div> 
                <!-- begin panel -->
                <div class="form-horizontal">  
                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Pekerjaan</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <select name="pekerjaan" class="default-select2 form-control">  
                                <option value="" >- Pilih --</option>
                                <option value="PNS" >PNS</option>
                                <option value="Karyawan Swasta" >Karyawan Swasta</option>
                                <option value="Wiraswasta" >Wiraswasta</option>
                                <option value="Pensiunan PNS" >Pensiunan PNS</option>
                                <option value="TNI" >TNI</option>
                                <option value="Polri" >Polri</option>
                                <option value="Profesional" >Profesinal</option>
                                <option value="Ibu Rumah Tangga" >Ibu Rumah Tangga</option>
                            </select> 
                            <strong style="color:red">{{ $errors->first('pekerjaan') }}</strong>
                        </div>
                    </div> 
                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Nama Kantor/ Usaha</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="nama_kantor"  class="form-control" placeholder="Nama Kantor">
                            <strong style="color:red">{{ $errors->first('nama_kantor') }}</strong>
                        </div>
                    </div> 
                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Alamat Kantor</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="alamat_kantor"  class="form-control" placeholder="Alamat Kantor">
                            <strong style="color:red">{{ $errors->first('alamat_kantor') }}</strong>
                        </div>
                    </div>   
                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Tlp Kantor</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="telp_kantor"  class="form-control">
                            <strong style="color:red">{{ $errors->first('telp_kantor') }}</strong>
                        </div>
                    </div>  
                    
                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Gaji</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="gaji"  class="form-control rupiah">
                            <strong style="color:red">{{ $errors->first('gaji') }}</strong>
                        </div>
                    </div>  
                    
                    
                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Keterangan</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <textarea name="ket_kerja"  class="form-control" rows="3" placeholder="Keterangan"></textarea> 
                            <strong style="color:red">{{ $errors->first('ket_kerja') }}</strong>
                        </div>
                    </div>  
                </div>
            </div>
        </div><!--end Col 6 -->
    </div><!--end Row -->

    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-6">
            <!-- begin panel -->
            <div class="widget"> 
                <div class="widget-header p-t-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="m-b-5 m-l-10 text-info">Data Pasangan</h4>                            
                        </div> 
                    </div>
                </div>
                <div class="border-top my-1"></div> 
                <div class="form-horizontal">  
                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Nama Lengkap</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="nama_pasangan"  class="form-control" placeholder="Nama Lengkap">
                            <strong style="color:red">{{ $errors->first('nama_pasangan') }}</strong>
                        </div>
                    </div>  
                    <div class="form-group m-b-10">
                        <label class="col-lg-3 col-form-label">Alamat</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="alamat_pasangan"  class="form-control" placeholder="Alamat">
                            <strong style="color:red">{{ $errors->first('alamat_pasangan') }}</strong>
                        </div>
                    </div>  
                    
                    <div class="form-group m-b-10">
                        <label class="col-lg-3 col-form-label">HP/TLP</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="telp_pasangan"  class="form-control text-right">
                            <strong style="color:red">{{ $errors->first('telp_pasangan') }}</strong>
                        </div>
                    </div>  
                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Pekerjaan</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <select name="pekerjaan_pasangan" class="default-select2 form-control">
                                <option value="" >- Pilih --</option>  
                                <option value="PNS" >PNS</option>
                                <option value="Swasta" >Swasta</option>
                                <option value="Wiraswasta" >Wiraswasta</option>
                                <option value="Pensiunan PNS" >Pensiunan PNS</option>
                                <option value="TNI" >TNI</option>
                                <option value="Polri" >Polri</option>
                                <option value="Profesional" >Profesinal</option>
                                <option value="Ibu Rumah Tangga" >Ibu Rumah Tangga</option>
                            </select> 
                            <strong style="color:red">{{ $errors->first('pekerjaan_pasangan') }}</strong>
                        </div>
                    </div> 
                    
                    
                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Gaji</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="gaji_pasangan"  class="form-control rupiah">
                            <strong style="color:red">{{ $errors->first('gaji_pasangan') }}</strong>
                        </div>
                    </div>  
                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Keterangan</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <textarea name="ket_pasangan"  class="form-control" rows="3" placeholder="Keterangan"></textarea> 
                            <strong style="color:red">{{ $errors->first('ket_pasangan') }}</strong>
                        </div>
                    </div>  
                </div>
            </div>  
        </div>  
         <!-- begin col-6 -->
        <div class="col-lg-6">
            <!-- begin panel -->
            <div class="widget"> 
                <div class="widget-header p-t-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="m-b-5 m-l-10 text-info">Data Keluarga</h4>                            
                        </div> 
                    </div>
                </div>
                <div class="border-top my-1"></div> 
                <div class="form-horizontal">  
                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Nama Lengkap</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="nama_keluarga"  class="form-control" placeholder="Nama Lengkap">
                            <strong style="color:red">{{ $errors->first('nama_keluarga') }}</strong>
                        </div>
                    </div>  
                    <div class="form-group m-b-10">
                        <label class="col-lg-3 col-form-label">Alamat</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="alamat_keluarga"  class="form-control" placeholder="Alamat">
                            <strong style="color:red">{{ $errors->first('alamat_keluarga') }}</strong>
                        </div>
                    </div>  
                    
                    <div class="form-group m-b-10">
                        <label class="col-lg-3 col-form-label">HP/TLP</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="telp_keluarga"  class="form-control text-right">
                            <strong style="color:red">{{ $errors->first('telp_keluarga') }}</strong>
                        </div>
                    </div>  
                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Hubungan</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <select class="default-select2 form-control" name="hubungan">
                                <option value="">-- pilih --</option>
                                <option value="Orangtua" >Orang Tua</option>
                                <option value="Anak" >Anak</option>
                                <option value="Paman/Bibi" >Paman/Bibi</option>
                                <option value="Saudara Kandung" >Saudara Kandung</option>
                                <option value="Lain-lain" >Lainnya</option>
                            </select>
                            <strong style="color:red">{{ $errors->first('hubungan') }}</strong>
                        </div>
                    </div> 
                    <div class="form-group m-b-5">
                        <label class="col-lg-3 col-form-label">Keterangan</label>
                        <div class="input-group col-lg-9"> 
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <textarea name="ket_keluarga"  class="form-control" rows="3" placeholder="Keterangan"></textarea> 
                            <strong style="color:red">{{ $errors->first('ket_keluarga') }}</strong>
                        </div>
                    </div>  
                </div>
            </div>  
        </div>
    </div> 
</div><!--end Section -->
 

    <div class="row">
        <!-- begin col-4  <div class="border-top my-3"></div>   -->
        <div class="col-lg-12">
            <!-- begin widget -->
            <div class="widget widget-form">
                
                <div class="widget-body"> 
                        <div class="m-b-15">
                            <button type="submit" class="btn btn-lime btn-block btn-lg">Simpan Data</button>
                        </div>
                    </form>
                         
                </div>
            </div>
            <!-- end widget -->
        </div>
        <!-- end col-4 -->
    </div>
</div>



@stop
 
@section('scripts')

<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script> 
<script src="{{ asset('js/jquery.number.js') }}"></script>  

<script type="text/javascript"> 
    $('.nomor').number(true, 0, ',', ' ');
    $('.rupiah').number(true, 0,);
</script>

<script>
    $(document).ready(function() {   
        $(".default-select2").select2();
    });
</script>
 

@stop
