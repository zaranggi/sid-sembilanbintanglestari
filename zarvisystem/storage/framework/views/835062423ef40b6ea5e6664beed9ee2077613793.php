

<?php $__env->startSection('styles'); ?> 
<link href="<?php echo e(asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css")); ?>" rel="stylesheet" />
<link href="<?php echo e(asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css")); ?>" rel="stylesheet" />
<link href="<?php echo e(asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css")); ?>" rel="stylesheet" />

<link href="<?php echo e(asset("plugins/bootstrap-select/bootstrap-select.min.css")); ?>" rel="stylesheet" />
<link href="<?php echo e(asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")); ?>" rel="stylesheet" />
<link href="<?php echo e(asset("plugins/jquery-tag-it/css/jquery.tagit.css")); ?>" rel="stylesheet" />
<link href="<?php echo e(asset("plugins/select2/dist/css/select2.min.css")); ?>" rel="stylesheet" /> 

<link href="<?php echo e(asset("plugins/bootstrap-calendar/css/bootstrap_calendar.css")); ?>" rel="stylesheet" />
<link href="<?php echo e(asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")); ?>" rel="stylesheet" /> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


     
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Booking Fee</h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                   

                    <?php if(Session::has('flash_message')): ?>
                        <div class="alert alert-info ">
                      <span class="glyphicon glyphicon-ok">
                      </span><em>  ~  <?php echo e(Session::get('flash_message')); ?></em>
                        </div>
                    <?php endif; ?>

                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                        <table id="data-table"  class="table table-bordered table-hover width-full">
                            <thead>
                                <tr class="text-center"> 
                                    <th class="text-nowrap">Perumahan</th>
                                    <th class="text-nowrap" >Kavling</th>
                                    <th class="text-nowrap" >Tipe Unit</th>
                                    <th class="text-nowrap">Nama</th>
                                    <th class="text-nowrap">Tanda Jadi</th>
                                    <th class="text-nowrap">Pembayaran</th>
                                    <th class="text-nowrap">Kurang</th>
                                    <th class="text-nowrap">Status</th> 
                                    <th class="text-nowrap">Jatuh Tempo</th> 
                                    <th class="text-nowrap">Action</th> 
                                </tr>

                            </thead>
                             <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td class="text-nowrap"><?php echo e($r->nama_properti); ?></td>
                                <td  class="text-center text-nowrap"><?php echo e($r->nama_kav); ?></td>
                                <td  class="text-center text-nowrap"><?php echo e($r->tipe_unit); ?></td>
                                <td class="text-nowrap"><?php echo e($r->nama_konsumen); ?></td>
                                <td class="text-right" ><?php echo e(number_format($r->tagihan)); ?></td>
                                <td class="text-right" ><?php echo e(number_format($r->bayar)); ?></td>
                                <td class="text-right" ><?php echo e(number_format($r->tagihan - $r->bayar)); ?></td>
                                <td class="text-center"><?php echo e($r->status); ?></td>                                
                                <td class="text-center  text-nowrap"><?php echo e(App\Helpers\Tanggal::tgl_indo($r->tgl_jatuhtempo)); ?></td>
                                <td class="text-center">    
									<?php if(($r->tagihan - $r->bayar) > 0): ?>
										<a href="#modal-dialog" id="<?php echo e($r->id); ?>" class="text-successed bayar" data-toggle="modal">
                                                <i class="fa fa-money-bill-wave"></i> 
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(url('booking/cetak/'.$r->id."/".$r->urutan)); ?>" class="text-lime font-weight-bold" target="_blank">
                                            <i class="fa fa-money-bill-wave"></i>  Cetak
                                        </a>
                                    <?php endif; ?>   
                                </td> 
                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

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
                    
                    <h4 class="modal-title">Pembayaran Booking Fee</h4>
					<button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="<?php echo e(url("booking/simpanbayar")); ?>">
                        <?php echo csrf_field(); ?>  
                        <input type="hidden" name="id_tagihan" id="id_tagihan" value="">
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3">Terima Dari </label>
                            <div class="col-md-6"> 
                                <input type="text" name="nama"  class="form-control" required>                            
                            </div>
                        </div>  
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Tanggal Bayar</label>
                            <div class="col-md-6"> 
                                <div class="input-group" id="daterange-singledate">
                                    <input type="text" name="tanggal" id="datepicker-default" class="form-control" placeholder="Pilih Tanggal" required/>
                                    <span class="input-group-btn">
                                        <i class="fa fa-calendar-alt text-info"></i>
                                    </span>
                                </div>                            
                            </div>
                        </div>
						<div class="form-group row m-b-10">
							<label class="col-form-label  col-md-3 font-weight-bold">Cara Bayar</label>
							<div class="col-md-4"> 
								<select class="form-control  pilih" id="tipe" name="tipe_pembayaran">
									<option value="Cash" selected>Tunai</option>       
									<option value="Transfer">Transfer</option>                         
								</select>
							</div>
						</div>
						<div id="tampil" style="display:none;">
							<div class="form-group row m-b-10">
								<label class="col-form-label col-md-3 font-weight-bold">Bank Pengirim</label>
								<div class="col-md-6"> 
									<select class="form-control pilih" id="bank_pengirim" name="bank_pengirim">
										<option value="" selected>Pilih Bank Pengirim</option>                         
										<?php $__currentLoopData = $bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($r->nama); ?>"><?php echo e($r->nama); ?></option>                         
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>
							<div class="form-group row m-b-10">
								<label class="col-form-label col-md-3">No.Rek Pengirim</label>
								<div class="col-md-5"> 
									<input type="text" name="norek_pengirim"  id="norek_pengirim" class="form-control text-right">                            
								</div>
							</div> 						
							<div class="form-group row m-b-10">
								<label class="col-form-label col-md-3 font-weight-bold">Bank PT</label>
								<div class="col-md-6"> 
									<select class="form-control pilih" name="id_bank" id="id_bank">
										<option value="" selected>Pilih Bank PT</option>                         
										<?php $__currentLoopData = $bank_pt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($r->id); ?>"><?php echo e($r->nama); ?> :: <?php echo e($r->nomor_rekening); ?> An <?php echo e($r->atas_nama); ?></option>                         
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>
						</div>
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3">Total Bayar</label>
                            <div class="col-md-5"> 
                                <input type="text" name="gross"  class="form-control rupiah text-right" required>                            
                            </div>
                        </div>
						
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Keterangan</label>
                            <div class="col-md-8"> 
                                <textarea name="keterangan"  class="form-control" rows="3" placeholder="Keterangan" ></textarea> 
                            </div>
                        </div> 
                        
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Lampiran</label>
                            <div class="col-md-9"> 
                                <input type="file" name="photo"  class="form-control" placeholder="Photo Bukti Bayar">                            
                            </div>
                        </div> 
    
                      
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>

                    <button type="submit" name="simpan" id="simpan" class="btn width-100 btn-primary">Simpan</button>
            
                </div>
            </form>  
            </div>
        </div>
    </div>

    <!-- /basic initialization --> 
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset("plugins/DataTables/media/js/jquery.dataTables.js")); ?>"></script>
<script src="<?php echo e(asset("plugins/DataTables/media/js/dataTables.bootstrap.min.js")); ?>"></script>
<script src="<?php echo e(asset("plugins/DataTables/extensions/Select/js/dataTables.select.min.js")); ?>"></script> 
<script src="<?php echo e(asset("js/page-table-manage-select.demo.min.js")); ?>"></script>
<script src="<?php echo e(asset('js/jquery.number.js')); ?>"></script> 
<script src="<?php echo e(asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bootstrap-daterangepicker/moment.js')); ?>"></script>
<script src="<?php echo e(asset("plugins/bootstrap-select/bootstrap-select.min.js")); ?>"></script>
<script src="<?php echo e(asset("plugins/select2/dist/js/select2.min.js")); ?>"></script> 

<script type="text/javascript"> 
    $('.nomor').number(true, 0, ',', ' ');
    $('.rupiah').number(true, 0,);
</script>

<script type="text/javascript">
    $(document).ready(function() {   
        $("#datepicker-default").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
        }); 
		
		$(".pilih").select2();
		$('#tipe').change(function(){
			var id = $(this).val();
			if(id == "Cash"){
				$('#tampil').hide();
				$('#norek_pengirim').val("");
				
				$('#id_bank').val("");
				$('#bank_pengirim').val("");
			}else{
				$('#tampil').show();
			}
		});
    });
</script>

<script type="text/javascript">
    $(document).ready(function() { 
        PageDemo.init();
    });
</script>

<script type="text/javascript">
$(document).on('click', '.bayar', function(){  
    var id_tagihan = $(this).attr("id");   
    //$('#id_tagihan').empty();
    $('#id_tagihan').val(id_tagihan);    
         
});  

$(document).on('click', '#simpan', function(){  
    $('#simpan').hide();    
         
});  
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\zarvi\sbl\zarvisystem\app\Modules/Booking/resources/views/data.blade.php ENDPATH**/ ?>