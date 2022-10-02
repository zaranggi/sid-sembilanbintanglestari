

<?php $__env->startSection('styles'); ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

            <h1 class="page-header"> List Tagihan Booking Fee  <small>Konsumen</small></h1>
            <!-- begin section-container -->
            <div class="section-container section-with-top-border p-b-5">
            <!-- begin row -->
                <div class="row">
                    <!-- begin col-9 -->
                    <div class="col-lg-8">
                        <?php if(Session::has('flash_message')): ?>
                        <div class="alert alert-info ">
                            <span class="glyphicon glyphicon-ok">
                            </span><em>  ~  <?php echo e(Session::get('flash_message')); ?></em>
                        </div>
                        <?php endif; ?>
						<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="col-xl-4 col-md-6">
							<div class="widget widget-stats bg-blue">
								<div class="stats-icon"><i class="fa fa-home"></i></div>
								<div class="stats-info">
									<h4><?php echo e(ucfirst($r->nama)); ?></h4>
									<p><?php echo e(number_format($r->tunit)); ?> Unit</p>	
								</div>
								<div class="stats-link">
									<a href="<?php echo e(url('booking/listall/'.$r->id)); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
								</div>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </div>
                    <!-- end col-9 --> 

                    <div class="col-lg-4">
                        <!-- begin panel -->
                        <div class="panel p-20">
                            <h5 class="m-t-0">Quick Search</h5>
                            <form class="form-input-flat" method="POST" action="<?php echo e(url('booking/tagihan')); ?>">
                                <?php echo e(csrf_field()); ?>

                                <div class="input-group m-b-15">
                                    <input type="text" name="kode" id="cari" class="form-control" placeholder="Enter keywords..." />
                                    <div id="tampil">
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                    
                                    
                                </div>
                            </form> 
                            
                            <div class="horizontal-divider m-0 m-b-15"></div> 
                             
                        </div>
                        <!-- end panel -->
                    </div>
                    <!-- end col-3 -->
                <!-- end col-3 --> 

                     
                </div>
                <!-- end row -->
            </div>
            <!-- end section-container -->
            <?php $__env->stopSection(); ?>            
<?php $__env->startSection('scripts'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->   
<script src="<?php echo e(asset("js/demo.min.js")); ?>"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() { 
        PageDemo.init();
    });
</script>
 
 
<script type="text/javascript">

    $(document).ready(function(){

        $('#cari').keyup(function(){ 
                var query = $(this).val();
                if(query.length >3)
                {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"<?php echo e(url('konsumen/autocomplete')); ?>",
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){
                            $('#tampil').fadeIn();  
                                        $('#tampil').html(data);
                        }
                    });
                }
            });

            $(document).on('click', 'li', function(){  
                $('#cari').val($(this).text());  
                $('#tampil').fadeOut();  
            });  

    });


</script>

<?php $__env->stopSection(); ?> 

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\zarvi\sbl\zarvisystem\app\Modules/Booking/resources/views/index.blade.php ENDPATH**/ ?>