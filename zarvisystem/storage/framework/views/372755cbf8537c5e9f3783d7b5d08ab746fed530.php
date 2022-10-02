

<?php $__env->startSection('styles'); ?> 
<link href="<?php echo e(asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css")); ?>" rel="stylesheet" />
<link href="<?php echo e(asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css")); ?>" rel="stylesheet" />
<link href="<?php echo e(asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css")); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <h1 class="page-header">Manage  <small>Users</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">List All Menu</h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <a href="<?php echo e(route('menu.create')); ?>" class="btn  btn-primary mb-5">
                        <i class="icon-plus3 "></i> Add New
                    </a>

                    <?php if(Session::has('flash_message')): ?>
                        <div class="alert alert-info ">
                      <span class="glyphicon glyphicon-ok">
                      </span><em>  ~  <?php echo e(Session::get('flash_message')); ?></em>
                        </div>
                    <?php endif; ?>

                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <table id="data-table"  class="table table-bordered table-hover width-full"">
                            <thead>
                                <tr class="text-center"> 
                                    <th >ID</th>
                                    <th>Name</th>
                                    <th >Link</th>
                                    <th>Active</th>
                                    <th>ID Main </th>
                                    <th> </th> 
                                </tr>

                            </thead>
                             <tbody>
                        <?php $__currentLoopData = $listmenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td align="center"><?php echo e($r->id); ?></td>
                                <td><?php echo e($r->name_menu); ?></td>
                                <td ><?php echo e($r->link); ?></td>
                                <td ><?php echo e($r->active); ?></td>
                                <td ><?php echo e($r->id_main); ?></td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-align-right text-successed"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-158px, 19px, 0px);">
                                            <a href="<?php echo e(route('menu.edit', $r->id)); ?>" class="dropdown-item">
                                                <i class="fa fa-pen-alt text-successed"></i> Edit
                                            </a>
                                            <a href="<?php echo e(route('menu.destroy', $r->id)); ?>" data-method="delete" data-confirm="Menu ini akan di-non aktifkan?" rel="nofollow" class="dropdown-item">
                                                <i class="fa fa-trash-alt text-danger"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </td> 
                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

                            </tbody>

                        </table>

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


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\zarvi\sbl\zarvisystem\app\Modules/Menu/resources/views/index.blade.php ENDPATH**/ ?>