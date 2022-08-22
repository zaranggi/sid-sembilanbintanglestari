@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />

@stop 
@section('content')
 

<h1 class="page-header">Manage Unit Properti/Perumahan <small>Add new...</small></h1>

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
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('munit.update', $data->id) }}">

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
                            <label class="col-lg-2 col-form-label">Tipe Unit</label>
                            <div class="input-group col-lg-3"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <select name="tipe" class="default-select2 form-control" required>  
                                    <option value="{{ $data->tipe }}" selected>{{ $data->tipe }}</option>
                                    <option value="21">21</option>
                                    <option value="27" >27</option>
                                    <option value="30" >30</option>
                                    <option value="33" >33</option>
                                    <option value="36" >36</option>
                                    <option value="45" >45</option>
                                    <option value="50" >50</option>
                                    <option value="54" >54</option>
                                    <option value="54" >56</option>
                                    <option value="60" >60</option>
                                    <option value="64" >64</option>
                                    <option value="68" >68</option>
                                    <option value="70" >70</option>
                                    <option value="120" >120</option>
                                    <option value="Ruko" >Ruko</option> 
                                </select> 
                                <strong style="color:red">{{ $errors->first('tipe') }}</strong>
                            </div>
                        </div>  

                        <div class="form-group m-b-5">
                            <label class="col-lg-2 col-form-label">Nama Unit (Blok)</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" value="{{ $data->nama }}" name="nama"  class="form-control" placeholder="Nama Blok">
                                <strong style="color:red">{{ $errors->first('nama') }}</strong>
                            </div>
                        </div>  
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Keterangan</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" value="{{ $data->keterangan }}" name="keterangan"  class="form-control" placeholder="Keterangan">
                                <strong style="color:red">{{ $errors->first('keterangan') }}</strong>
                            </div>
                        </div>  
                      

                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Luas Tanah</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" value="{{ number_format($data->luas_tanah) }}" name="luas_tanah"  class="form-control meter text-right" placeholder="Luas Tanah (meter persegi)">
                                <strong style="color:red">{{ $errors->first('luas_tanah') }}</strong>
                            </div>
                        </div>

                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Luas Bangunan</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" value="{{ number_format($data->luas_bangunan) }}" name="luas_bangunan"  class="form-control meter text-right" placeholder="Luas Bangunan (meter persegi)">
                                <strong style="color:red">{{ $errors->first('luas_bangunan') }}</strong>
                            </div>
                        </div> 

                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Harga Jual(Brosur)</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" value="{{ number_format($data->harga) }}" name="harga"  class="form-control harga text-right" placeholder="Rp 0.00">
                                <strong style="color:red">{{ $errors->first('harga') }}</strong>
                            </div>
                        </div> 

                        
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Harga Jual Tanah Kavling</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" value="{{ number_format($data->hargakav) }}" name="hargakav"  class="form-control harga text-right" placeholder="Rp 0.00">
                                <strong style="color:red">{{ $errors->first('hargakav') }}</strong>
                            </div>
                        </div> 
                        <div class="form-group m-b-10">
                            <label class="col-lg-4 col-form-label">Nilai Persediaan Tanah per Meter (HPP)</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" value="{{ number_format($data->hpp_tanah) }}" name="hpp_tanah"  class="form-control harga text-right" placeholder="Rp 0.00">
                                <strong style="color:red">{{ $errors->first('hpp_tanah') }}</strong>
                            </div>
                        </div> 
                        <div class="form-group m-b-10">
                            <label class="col-lg-4 col-form-label">Nilai Persediaan Bangunan (HPP)</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" value="{{ number_format($data->hpp_bangunan) }}" name="hpp_bangunan"  class="form-control harga text-right" placeholder="Rp 0.00">
                                <strong style="color:red">{{ $errors->first('hpp_bangunan') }}</strong>
                            </div>
                        </div> 
 
                        <div class="border-top my-3"></div> 
                   
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- begin col-4 -->
        <div class="col-lg-12">
            <!-- begin widget -->
            <div class="widget widget-form">
                
                <div class="widget-body">
                    
                        <div class="form-group dropzone" id="image-upload"> 

                                <div class="text-center text-info">
                                    <h3>Upload Multiple Image By Click On Box</h3>
                                </div> 
                        </div>
                        
                        <div class="m-b-15">
                            <button type="submit" class="btn btn-lime btn-block btn-lg">Simpan Data</button>
                        </div>
                    </form>
                        <p class="help-block text-muted f-s-11 m-b-0">
                            <span class="text-danger">*</span> File size maksimum 4 MB.   
                        </p> 
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

<script type="text/javascript">
    $('.meter').number(true, 2);
    $('.harga').number(true, 0);
</script>

<script>
    $(document).ready(function() {  
        $(".multiple-select2").select2({placeholder:"Select a Bank PT"})
    });
</script>
<script type="text/javascript">
    var uploadedDocumentMap = {}
  Dropzone.options.imageUpload = {
    url: '{{ url('munit/simpangambar') }}',
    maxFiles: 1,
    maxFilesize: 4, // MB    
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
      uploadedDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentMap[file.name]
      }
      $('form').find('input[name="document[]"][value="' + name + '"]').remove()
    },
    init: function () {
        @if(isset($gambar))
        var files = {!! json_encode($gambar) !!};
          
        for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="document[]" value="' + file.gambar + '">')
        }
      @endif
    }
  }
 
</script>

@stop
