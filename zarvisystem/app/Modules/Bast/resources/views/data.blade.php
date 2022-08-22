@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />

<link href="{{ asset("plugins/bootstrap-calendar/css/bootstrap_calendar.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")}}" rel="stylesheet" /> 
@stop
@section('content')


     
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">BAST Unit Konsumen</h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">                  

                    @if(Session::has('flash_message'))
                        <div class="alert alert-info ">
                      <span class="glyphicon glyphicon-ok">
                      </span><em>  ~  {{ Session::get('flash_message') }}</em>
                        </div>
                    @endif

                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                        <table id="data-table"  class="table table-bordered table-hover width-full">
                            <thead>
                                <tr class="text-center"> 
                                    <th class="text-nowrap">No</th>
                                    <th class="text-nowrap">Nama</th>
                                    <th class="text-nowrap" >Kavling</th>
                                    <th class="text-nowrap" >Tipe Unit</th>
                                    <th class="text-nowrap" >LT</th>
                                    <th class="text-nowrap" >LB</th>
                                    <th class="text-nowrap">Status</th>
                                    <th class="text-nowrap">Tanggal BAST</th>
                                    <th class="text-nowrap">Marketing</th>
                                    <th class="text-nowrap">Media</th> 
                                    <th class="text-nowrap">Action</th> 
                                </tr>

                            </thead>
                             <tbody>
                                 @php $no = 1; @endphp;
                        @foreach($data as $r)

                            <tr>
                                <td class="text-nowrap">{{ $no }}</td>
                                <td class="text-nowrap">{{ $r->nama_konsumen }}</td>
                                <td  class="text-center text-nowrap">{{  $r->nama_kav }}</td>
                                <td  class="text-center text-nowrap">{{  $r->tipe_unit }}</td>
                                <td  class="text-center text-nowrap">{{  $r->lt + $r->luas_penambahan_tanah }} m <sup>2</sup></td>
                                <td  class="text-center text-nowrap">{{  $r->lb }} m <sup>2</sup></td>
                                <td class="text-center text-nowrap">
								@if($r->tanggal == "")
									Belum BAST
								@else 
									Sudah BAST
								@endif
								</td>   
                                <td class="text-center text-nowrap">{{  App\Helpers\Tanggal::tgl_indo($r->tanggal) }}</td>                
                                <td class="text-left text-nowrap">{{  $r->nama_marketing }}</td>
                                <td class="text-center text-nowrap">
                                    @if($r->file <> "")
                                    <a href="{{  url('image/surat/'.$r->file) }}" class="text-warning" target="_blank">
                                        <i class="fa fa-camera-retro fa-2x"></i> 
                                    </a> |
                                    @endif
                                    @if($r->file2 <> "")
                                    <a href="{{  url('image/surat/'.$r->file2) }}" class="text-warning" target="_blank">
                                        <i class="fa fa-camera-retro fa-2x"></i> 
                                    </a> |
                                    @endif
                                    @if($r->file3 <> "")
                                    <a href="{{  url('image/surat/'.$r->file3) }}" class="text-warning" target="_blank">
                                        <i class="fa fa-camera-retro fa-2x"></i> 
                                    </a> 
                                    @endif
                                </td>   
								<td class="text-center">    
									@if($r->tanggal == "")								
										<a href="#modal-dialog" id="{{ $r->id }}" class="text-successed bast" data-toggle="modal">
											<i class="fa fa-pen"></i> 
										</a>
									@else 
										
									@endif
                                       
                                </td> 
                            </tr>
                            @php $no++; @endphp

                        @endforeach 

                            </tbody>

                        </table>

                    </div>
                </div>
                </div>
            <!-- end panel-body -->
            </div>
        </div>
    </div>


    <!-- #modal-dialog -->
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title">BAST Unit - Konsumen</h4>
					<button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{ url('bast/simpan')}}" enctype="multipart/form-data">
                        @csrf  
                        <input type="hidden" name="id_spr" id="id_spr" value="">

                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Tanggal BAST</label>
                            <div class="col-md-6"> 
                                <div class="input-group" id="daterange-singledate">
                                    <input type="text" name="tanggal" id="datepicker-default" class="form-control" placeholder="Pilih Tanggal" required />
                                    <span class="input-group-btn">
                                        <i class="fa fa-calendar-alt text-info"></i>
                                    </span>
                                </div>                            
                            </div>
                        </div>  
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Keterangan</label>
                            <div class="col-md-8"> 
                                <textarea name="keterangan"  class="form-control" rows="3" placeholder="Keterangan" ></textarea> 
                            </div>
                        </div>  
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Foto 1 </label>
                            <div class="input-group col-lg-10"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="file" name="file"  class="form-control">
                                <strong style="color:red">{{ $errors->first('file') }}</strong>
                            </div>
                        </div>  
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Foto 2 </label>
                            <div class="input-group col-lg-10"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="file" name="file2"  class="form-control">
                                <strong style="color:red">{{ $errors->first('file2') }}</strong>
                            </div>
                        </div>  
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Foto 3 </label>
                            <div class="input-group col-lg-10"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="file" name="file3"  class="form-control">
                                <strong style="color:red">{{ $errors->first('file3') }}</strong>
                            </div>
                        </div>  
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
                    <button type="submit" id="simpan" class="btn width-100 btn-primary">Simpan</a>
                    </form>  
                </div>
            </div>
        </div>
    </div>
	
	
@stop 
@section('scripts')
<script src="{{ asset('plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/DataTables/extensions/Select/js/dataTables.select.min.js') }}"></script> 
<script src="{{ asset('js/page-table-manage-select.demo.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {   
        $("#datepicker-default").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            }); 
        });
</script>
 
<script type="text/javascript">
    $(document).ready(function() { 
        PageDemo.init();
    });
</script>
<script type="text/javascript">
$(document).on('click', '.bast', function(){  
    var id = $(this).attr("id");   
    
    $('#id_spr').val(id);    
         
});  


$(document).on('click', '#simpan', function(){   
    
    $('#simpan').hide();    
         
});  
</script>

@stop

