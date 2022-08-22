@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Approval Pembayaran  <small>Termin </small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Data Approval </h4>
                    
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
                                <tr class="text-center text-nowrap"> 
                                    <th>No SPK</th> 
                                    <th>Perumahan</th> 
                                    <th>Kavling</th> 
                                    <th>Tipe</th> 
                                    <th>Termin Ke</th>
                                    <th>Biaya Termin</th> 
                                    <th>Keterangan</th> 
                                    <th>Sisa Hari</th>
                                    <th>Diajukan Oleh</th>
                                    <th>Proses</th>  
                                </tr>

                            </thead>
                             <tbody>
                                
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center ">{{ $r->kode }}</td>
                                <td class="text-nowrap">{{ $r->nama_properti }}</td> 
                                <td class="text-center text-nowrap">{{ $r->nama_kav }}</td> 
                                <td class="text-center text-nowrap">{{ $r->tipe_unit }}</td> 
                                <td class="text-center text-nowrap">{{ $r->termin }}</td>  
                                <td class="text-center text-nowrap">{{ number_format($r->bayar) }}</td> 
                                <td class="text-center text-nowrap">{{ $r->keterangan }}</td>  
                                <td class="text-center text-nowrap">{{ App\Helpers\Tanggal::selisih_hari($r->tanggal_bast) }}</td> 
                                <td class="text-center text-nowrap">{{ $r->created_by }}</td> 
                                <td class="text-center text-nowrap">
									<div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-align-right text-successed"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-158px, 19px, 0px);">
											<a href="#modal-dialog" id="{{ $r->id }}" class="dropdown-item bayar" data-toggle="modal" >
												<i class="fa fa-wallet text-lime"></i> Approval
											</a> 
											 <a href="{{ url('apppaysubkon/detail/'. $r->id_spk) }}" 
														onclick="window.open(this.href, '_blank', 'left=20,top=20,width=950,height=500,toolbar=0,resizable=0'); 
														return false;"
														class="dropdown-item">
												<i class="fa fa-eye text-warning"></i> Detail SPK
											</a>
										</div>
									</div>
											
                                </td> 
                            </tr>
                            
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
                    <h4 class="modal-title">Approval Pembayaran Termin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="{{ url("apppaysubkon/simpanbayar")}}">
                        @csrf  
                        <input type="hidden" name="id_termin" id="id_termin" value="">
                       
                        <div class="form-group row m-l-10">
                            <label class="col-form-label col-md-4 ">Keterangan</label>
                            <div class="col-md-8"> 
                                <textarea name="keterangan"  class="form-control" rows="3" placeholder="Keterangan" ></textarea> 
                            </div>
                        </div> 
                           
                        <div class="form-group row m-l-10">
                            <label class="col-form-label col-md-4 ">Approval</label>
                            <div class="col-md-6"> 
                                <select name="status"  class="form-control select-icons" data-fouc>
                                    <option value="2" data-icon="blank" selected> Approve </option>
                                    <option value="3" data-icon="blank"> Tolak </option>
                                </select>
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
    <!-- /basic initialization --> 
@stop 
@section('scripts')
<script src="{{ asset("plugins/DataTables/media/js/jquery.dataTables.js") }}"></script>
<script src="{{ asset("plugins/DataTables/media/js/dataTables.bootstrap.min.js") }}"></script>
<script src="{{ asset("plugins/DataTables/extensions/Select/js/dataTables.select.min.js") }}"></script> 
<script src="{{ asset("js/page-table-manage-select.demo.min.js") }}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() { 
        PageDemo.init();
    });
</script>


<script type="text/javascript">
    $(document).on('click', '.bayar', function(){  
        var id_termin = $(this).attr("id");   
        
        $('#id_termin').val(id_termin);    
             
    });  
	 $(document).on('click', '#simpan', function(){  
        
        $('#simpan').hide();    
             
    });  
    </script>
    

@stop


