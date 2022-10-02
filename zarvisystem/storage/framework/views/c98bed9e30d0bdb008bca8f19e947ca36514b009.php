

<?php $__env->startSection('styles'); ?> 
<link href="<?php echo e(asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css")); ?>" rel="stylesheet" />
<link href="<?php echo e(asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css")); ?>" rel="stylesheet" />
<link href="<?php echo e(asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css")); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <h1 class="page-header">Data Konsumen <small>Mundur</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">List All </h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    
                    <a href="<?php echo e(url('mundur/create')); ?>" class="btn  btn-primary mb-5">
                        <i class="fa fa-plus "></i> Add New
                    </a> 

                    <?php if(Session::has('flash_message')): ?>
                        <div class="alert alert-info ">
                      <span class="glyphicon glyphicon-ok">
                      </span><em>  ~  <?php echo e(Session::get('flash_message')); ?></em>
                        </div>
                    <?php endif; ?>

                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                        <table id="data-table"  class="table table-bordered table-hover width-full"">
                            <thead>
                                <tr class="text-center"> 
                                    <th >No</th>
                                    <th>Perumahan</th>
                                    <th>Kavling</th>
                                    <th>Konsumen</th>
                                    <th>Marketing</th>
                                    <th>Tanggal</th>
                                    <th>Nilai MOU</th>
                                    <th>Tertagih</th> 
                                    <th>Terbayar</th> 
                                    <th>Pengembalian</th> 
                                    <th>Status</th> 
                                    <th></th>
                                </tr>

                            </thead>
                             <tbody>
                                 <?php 
                                    $no = 1;
                                 ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td class="text-center"><?php echo e($no); ?></td>
                                <td class="text-center text-nowrap"><?php echo e($r->nama_properti); ?></td>
                                <td  class="text-center text-nowrap"><?php echo e($r->nama_kav." / ".$r->tipe_unit); ?></td> 
                                
                                <td class="text-center text-nowrap"><?php echo e($r->nama_konsumen); ?></td>                                
                                <td class="text-center text-nowrap"><?php echo e($r->nama_marketing); ?></td>                                
                                <td class="text-center text-nowrap"><?php echo e(App\Helpers\Tanggal::tgl_indo($r->tanggal_mundur)); ?></td>        
                                <td  class="text-right text-nowrap"><?php echo e(number_format($r->nilai_mou)); ?></td>
                                <td  class="text-right text-nowrap"><?php echo e(number_format($r->total_tagihan)); ?></td>
                                <td  class="text-right text-nowrap"><?php echo e(number_format($r->terbayar)); ?></td>
                                <td  class="text-right text-nowrap"><?php echo e(number_format($r->pengembalian)); ?></td> 
                                <td  class="text-center text-nowrap">
                                    <?php if($r->status == "1"): ?>
                                        <span class="label label-lime">Diajukan</span>
                                    <?php elseif($r->status == 2): ?>
                                        <span class="label label-lime">Disetujui Direksi</span>
                                    <?php else: ?> 
                                        <span class="label label-lime">Ditolak Direksi</span>
                                    <?php endif; ?>
                                   
                                </td> 
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-align-right text-successed"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-158px, 19px, 0px);">
                                            <a href="<?php echo e(route('mundur.edit', $r->id_spr)); ?>" class="dropdown-item">
                                                <i class="fa fa-pen-alt text-successed"></i> Preview
                                            </a> 
                                        </div>
                                    </div>
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

    <!-- /basic initialization --> 
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset("plugins/DataTables/media/js/jquery.dataTables.js")); ?>"></script>
<script src="<?php echo e(asset("plugins/DataTables/media/js/dataTables.bootstrap.min.js")); ?>"></script>
<script src="<?php echo e(asset("plugins/DataTables/extensions/Select/js/dataTables.select.min.js")); ?>"></script> 
<script src="<?php echo e(asset("js/page-table-manage-select.demo.min.js")); ?>"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() { 
        PageDemo.init();
    });
</script>

<script src="<?php echo e(asset('js/datadelete.js')); ?> "></script>
<script type="text/javascript">
    window.csrfToken = '<?php echo csrf_token(); ?>';
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\zarvi\sbl\zarvisystem\app\Modules/Mundur/resources/views/index.blade.php ENDPATH**/ ?>