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


    <h1 class="page-header">Data Booking  <small>Konsumen </small></h1>

    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
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
                                    <th>No</th>
                                    <th>Konsumen</th>
                                    <th>Nama Perumahan</th>
                                    <th>Tipe</th>
                                    <th>Kavling</th>
                                    <th>Tgl Booking</th>
                                    <th>Tanda Jadi</th>
                                    <th>Ket Keuangan</th>
                                    <th></th>
                                </tr>

                            </thead>
                             <tbody>
                                 <?php
                                    $no  = 1;
                                 ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td class="text-center"><?php echo e($no); ?></td>
                                <td class="text-nowrap text-info" ><?php echo e($r->nama_konsumen); ?></td>
                                <td class="text-nowrap  text-center text-lime font-weight-bold"><?php echo e($r->nama_properti); ?></td>
                                <td class="text-nowrap" ><?php echo e($r->nama_kav); ?></td>
                                <td class="text-center" ><?php echo e($r->tipe_unit); ?></td>
                                <td class="text-nowrap  text-center" ><?php echo e(App\Helpers\Tanggal::tgl_indo($r->tanggal)); ?></td>
                                <td class="text-nowrap  text-right" >Rp <?php echo e(number_format($r->nominal)); ?></td>
                                <td class="text-nowrap  text-left" ><?php echo e($r->ket_keu); ?></td>
                                <td class="text-nowrap  text-center">
                                        <a href="#modal-dialog" id="<?php echo e($r->id); ?>" class="batalkan" data-toggle="modal">
                                        <i class="fa fa-edit text-warning"></i>
										    Buat Catatan
                                        </a>
                                    <a href="<?php echo e(url('bookingkeu/cetak/'.$r->id_note)); ?>" class="text-lime font-weight-bold" target="_blank">
                                        <i class="fa fa-money-bill-wave"></i>  Cetak
                                    </a>
                                </td>
                            </tr>
                            <?php
								$no++;
							 ?>

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

                    <h4 class="modal-title">Note - Pembayaran Booking Fee</h4>
					<button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="<?php echo e(url('bookingkeu/note')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id_booking" id="id_booking" value="">
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

<!-- ================== END PAGE LEVEL JS ================== -->


<script type="text/javascript">
$(document).on('click', '.batalkan', function(){
    var id = $(this).attr("id");

    $('#id_booking').val(id);

});
$(document).on('click', '#simpan', function(){

    $('#simpan').hide();

});
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\zarvi\sbl\zarvisystem\app\Modules/Bookingkeu/resources/views/index.blade.php ENDPATH**/ ?>