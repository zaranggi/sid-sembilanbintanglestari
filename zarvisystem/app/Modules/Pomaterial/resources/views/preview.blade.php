@extends('admin.layout') 
@section('styles') 
 

@stop 
@section('content')
 

<h1 class="page-header">Preview <small>PO Material </small></h1>
	
<div class="row">
    <!-- begin col-6 -->
    <div class="col-lg-12">
        <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">PO Material </h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
			<div class="panel-body">
				<!-- begin panel --> 
                			
				@foreach($one as $rone)
					<div class="row">
						<div class="col-lg-6">
                            <div class="form-group row m-l-15">
								<label class="col-form-label col-md-4">Kepada</label>
								<div class="col-md-6"> 
									<select name="dari" class="default-select2 form-control" placeholder="Pilih Perumahan" required >
                                        <option >{{$rone->nama_rekanan}}</option> 
                                        
									</select>
								</div>
							</div> 
							<div class="form-group row m-l-15">
								<label class="col-form-label col-md-4 ">Nomor</label>
								<div class="col-md-6"> 
										<input type="text" value="PO-0{{$rone->docno}}" name="docno" class="form-control" placeholder="Nomor Dokumen" readonly/>
								</div>
							</div>  
							
							<div class="form-group row m-l-15">
								<label class="col-form-label col-md-4 ">Status</label>
								<div class="col-md-6"> 
								 @php 
									if( $rone->status == 0){
										$status = "Baru";    
                                    }elseif( $rone->status == 1){
                                        $status = "Menunggu Approval";
                                    }elseif( $rone->status == 2){
                                        $status = "Disetujui Manager";
                                    }elseif( $rone->status == 3){
                                        $status = "Ditolak Manager";
                                    }elseif( $rone->status == 4){
                                        $status = "Disetujui Direktur";
                                    }else{
                                        $status = "Ditolak Direktur";
									}
								@endphp
										<input type="text" value="{{$status}}" name="docno" class="form-control" placeholder="Nomor Dokumen" readonly/>
								</div>
							</div>  
							 
						</div>
						<div class="col-lg-6">
                            <div class="form-group row m-l-15">
								<label class="col-form-label col-md-4">Tanggal</label>
								<div class="col-md-6"> 
									<div class="input-group" id="daterange-singledate">
										<input type="text" value="{{ App\Helpers\Tanggal::tgl_indo($rone->tanggal) }}" name="tanggal" id="tanggal" class="form-control" placeholder="Pilih Tanggal" required/>
										<span class="input-group-btn">
											<i class="fa fa-calendar-alt text-info"></i>
										</span>
									</div>                            
								</div>
							</div>   
                           
							<div class="form-group row m-l-15">
								<label class="col-form-label col-md-4">Keterangan</label>
								<div class="col-md-6"> 
									<textarea name="keterangan"   class="form-control" rows="2" placeholder="Keterangan" >{{$rone->keterangan}}</textarea> 
								</div>
							</div>
						</div>
					</div>
					@endforeach
                     <br/>
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover width-full" id="listitem">
                                <thead>
                                    <tr class="bg-lime">
                                        <th class="col-2 text-center">PLU</th>
                                        <th class="col-5 text-center">Nama Material</th>
                                        <th class="col-2 text-center">Satuan</th>
                                        <th class="col-3 text-center">Volume</th>
                                    </tr>
                                </thead>
                                <tbody> 
									@foreach($data as $r)
									<tr>
										<td class="text-center">{{$r->prdcd}}</td>
										<td>{{$r->nama_prodmast}}</td>
										<td class="text-center">{{$r->satuan}}</td>
										<td class="text-right">{{ number_format($r->qty) }}</td>
									</tr>
									@endforeach
                                     
                                </tbody>  
                            </table>
                        </div>
                    </div>

                    <div class="border-top my-1 m-b-15"></div> 
                    <div class="m-b-15">
                        <a href="{{ URL::previous() }}" class="btn btn-warning"><i class="fa fa-redo-alt ml-2"></i> Kembali </a>
                    </div>
                </form>  
			</div>
	</div>
</div> 
  

@stop
 
@section('scripts')
 
@stop
