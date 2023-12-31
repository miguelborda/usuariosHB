

<?php $__env->startSection('title', 'Roles'); ?>
<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="css/datatable.css" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?> 
<div class="title-wrapper pt-30">
    <div class="row align-items-center" style="height: 60px">
      <div class="col-md-6">
        <div class="titlemb-30">
          <h2>Roles</h2>
        </div>
      </div>
      <div class="col-md-6" style="text-align: right;">
        <div class="titlemb-30">
          <button type="button" class="btn btn-primary btn-lg">Nuevo</button>
        </div>
      </div>
    </div>
    <!-- end row -->
  </div>
<div class="tables-wrapper">
    <div class="row">
      	<div class="col-lg-12">
        	<div class="card-style mb-30">
				<div class="table-wrapper table-responsive">
		            <table class="table hover" id="myTable">
		              <thead>
		                <tr>
		                  <th><h6>ID</h6></th>
		                  <th><h6>NOMBRE</h6></th>
		                  <th><h6>SLUG</h6></th>
		                  <th><h6>DESCRIPCION</h6></th>
		                  <th><h6>NIVEL</h6></th>
						  <th><h6>AREA</h6></th>
						  <th><h6>accion</h6></th>
		                </tr>
		                <!-- end table row-->
		              </thead>
		              <tbody>
		              	<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                <tr>
		                  <td class="min-width">
		                    <p><?php echo e($role->id); ?></p>
		                  </td>
		                  <td class="min-width">
		                    <p><?php echo e($role->name); ?></p>
		                  </td>
		                  <td class="min-width">
		                    <p><?php echo e($role->slug); ?></p>
		                  </td>
						  <td class="min-width">
		                    <p><?php echo e($role->description); ?></p>							
		                  </td>
						  <td class="min-width">
		                    <p><?php echo e($role->level); ?></p>
		                  </td>
		                  <td class="min-width">
		                		
							<p><?php echo e($role->area); ?></p>							
		                  </td>
		                  <td>
		                  	<?php if($role->trial412 === 'F'): ?>
		                        <a href="" class="text-danger"><i class="lni lni-thumbs-down"></i></a>
                            <?php else: ?>
		                        <a href="" class="text-blue"><i class="lni lni-thumbs-up"></i></a>
                            <?php endif; ?>
                            <button type="button" class="btn btn-primary btn-sm">Editar</button>
		                  </td>
		                </tr>
		                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                <!-- end table row -->
		              </tbody>
		            </table>
		        </div>
            <!-- end table -->
          	</div>
        </div>
        <!-- end card -->
    </div>
      <!-- end col -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="js/datatable.js"></script>
    <script>
$('#myTable').DataTable();
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\usuariosHB\resources\views/sistemas/roles/index.blade.php ENDPATH**/ ?>