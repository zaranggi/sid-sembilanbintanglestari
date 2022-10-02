 
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="#" class="navbar-brand">
					<img src="<?php echo e(asset('img/logo/logo_symbol.jpg')); ?>" alt="" class="rounded mx-auto d-block"/>  
					<b class="m-l-15"> SID</b> Admin Page</a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				
				<!-- begin navbar-right -->
				<ul class="nav navbar-nav navbar-right">
					<!--<?php if(Auth::user()->id_jabatan == 11 OR Auth::user()->id_jabatan == 1): ?>
					<li class="dropdown">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle f-s-14">
						<i class="fa fa-bell"></i>
						<span class="label text-mute" id="notifku">0</span>
						</a>
						<div class="dropdown-menu media-list dropdown-menu-right">
								<a href="javascript:;" class="dropdown-item media">
									<div class="media-left">
										<i class="fa fa-bullhorn  bg-info"></i>
									</div>
									<div class="media-body">
										<h6 class="media-heading">Transaksi Baru
											<i class="fa fa-exclamation-circle text-info"></i>
										</h6> 
									</div>
								</a>
								<div class="dropdown-footer text-center">
									<a href="<?php echo e(url('lognya')); ?>">Lihat Semua</a>
								</div>
						</div>
					</li>
					
					 <?php endif; ?> -->
					
					<li class="dropdown navbar-user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<span class="image">
							<img src="<?php echo e(asset('img/user-12.jpg')); ?>" alt="" /></span>
							<span class="d-none d-md-inline"><?php echo e(Auth::user()->name); ?></span> <b class="caret"></b>
						</a>
						 
						<div class="dropdown-menu dropdown-menu-right">
							<a href="<?php echo e(url('profile')); ?>" class="dropdown-item">Edit Profile</a>
							 <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
								onclick="event.preventDefault();
											  document.getElementById('logout-form').submit();">
								 <?php echo e(__('Logout')); ?>

							</a>

							<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
								 <?php echo csrf_field(); ?>
							</form>
							 
						</div>
						
					 
					</li>
					 
				</ul>
				<!-- end navbar-right -->
			 <?php /**PATH D:\zarvi\sbl\zarvisystem\resources\views/admin/partials/header.blade.php ENDPATH**/ ?>