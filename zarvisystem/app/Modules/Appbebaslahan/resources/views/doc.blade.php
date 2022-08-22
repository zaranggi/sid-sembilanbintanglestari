@extends('admin.layout')
@section('styles')

<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />

@stop
@section('content')


<h1 class="page-header">Dokumen <small>Pembebasan Lahan ...</small></h1>

<div class="section-container section-with-top-border p-b-5">

<div class="row">
    <!-- begin col-6 -->
    <div class="col-lg-8 offset-lg-2">
        <!-- begin panel -->
        <div class="widget">
            <div class="widget-header p-t-10">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="m-b-5 m-l-10 text-info">Dokumen Pembebasan Lahan</h4>
                    </div>
                </div>
            </div>
            <div class="border-top my-1 m-b-10"></div>
            <div class="form-horizontal">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('bebaslahan/uploaddoc') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{$id}}">
                @php $no = 1; @endphp
                @if(count($listdoc) > 0)
                    @foreach($listdoc as $x)
                        <div class="form-group row m-l-15">
                            <label class="col-form-label col-md-4 text-lime font-weight-bold"> {{ $no.". ".$x->nama }}</label>

                            <div class="col-md-2">

                                <a href="{{ url('image/legalformal/'.trim($x->photo)) }}"
                                    onclick="window.open(this.href, '_blank', 'left=20,top=20,width=500,height=500,toolbar=1,resizable=0');
                                    return false;"><i class="fa fa-camera fa-2x" aria-hidden="true"></i>
                                </a>

                            </div>
                        </div>
                        @php $no++; @endphp

                    @endforeach
                    <hr/>
                    @for($i=1;$i<=5;$i++)
                    <div class="form-group m-b-10">
                        <label class="col-lg-5 col-form-label font-weight-bold">File Dokumen {{ $i }}</label>
                        <div class="input-group col-lg-6">
                            <div class="custom-file">
                                <input type="file" name="namafile[]" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    @endfor
                @else
                    @for($i=1;$i<=5;$i++)
                    <div class="form-group m-b-10">
                        <label class="col-lg-5 col-form-label font-weight-bold">File Dokumen {{ $i }}</label>
                        <div class="input-group col-lg-6">
                            <div class="custom-file">
                                <input type="file" name="namafile[]" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    @endfor
                @endif

            <div class="border-top my-1"></div>
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <!-- begin col-4  <div class="border-top my-3"></div>   -->

        <div class="col-lg-8 offset-lg-2">
            <!-- begin widget -->
            <div class="widget widget-form">

                <div class="widget-body">
                        <div class="m-b-15">
                             <button onclick="history.back()" class="btn btn-orange btn-block btn-lg">Kembali</button>
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
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>

@stop
