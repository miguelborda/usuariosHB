

<?php $__env->startSection('title', 'Editar Medico'); ?>
<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="css/datatable.css" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="title-wrapper pt-30">
    <div class="row align-items-center" style="height: 60px">
        <div class="col-md-6">
            <div class="titlemb-30">
                <h2>Actualizar datos de Medico <?php echo e($medico->id); ?></h2>
            </div>
        </div>
    </div>
    <!-- end row -->
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('patologia.medico.update', $medico->id)); ?>" onsubmit="return confirm('¿Estás seguro de que deseas modificar este registro?');">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <strong><?php echo Form::label('ci', 'CI'); ?><span class="text-danger">*</span></strong>
                    <?php echo Form::text('ci', isset($medico) ? $medico->ci : '', ['class' => 'form-control', 'placeholder' => 'Ingrese CI de Medico']); ?>

                    <small class="text-danger"><?php echo e($errors->first('ci')); ?></small>
                </div>
            <br>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <strong><?php echo Form::label('nombre', 'Nombres'); ?><span class="text-danger">*</span></strong>
                    <?php echo Form::text('nombre', isset($medico) ? $medico->nombre : '', ['class' => 'form-control', 'placeholder' => 'Ingrese Nombre de Medico']); ?>

                    <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            <br>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <strong><?php echo Form::label('apellido', 'Apellidos'); ?><span class="text-danger">*</span></strong>
                    <?php echo Form::text('apellido', isset($medico) ? $medico->apellido : '', ['class' => 'form-control', 'placeholder' => 'Ingrese Apellido de Medico']); ?>

                    <?php $__errorArgs = ['apellido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            <br>
            </div>           
            <div class="col-md-2">
                <div class="form-group">
                    <strong><?php echo Form::label('fecha_nacimiento', 'Fecha de Nacimiento'); ?></strong>
                    <?php echo Form::date('fecha_nacimiento', isset($medico) ? $medico->fecha_nacimiento : '', ['max' => now()->toDateString(), 'min' => '1900-01-01', 'id' => 'fecha_nacimiento']); ?>

                    <?php $__errorArgs = ['fecha_nacimiento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>            
            </div>
            <!--<div class="col-md-1">
                <div class="form-group">
                    <strong><?php echo Form::label('edad', 'Edad'); ?></strong>
                    <?php echo Form::text('edad', isset($medico) ? $medico->edad : '', ['class' => 'form-control', 'id' => 'edad', 'enabled' => 'disabled']); ?>

                </div>
            </div>            -->
            </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <strong><?php echo Form::label('direccion', 'Dirección'); ?></strong>
                    <?php echo Form::text('direccion', isset($medico) ? $medico->direccion : '', ['class' => 'form-control', 'placeholder' => 'Ingrese Direccion de Medico']); ?>

                    <?php $__errorArgs = ['direccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">                
                    <strong><?php echo Form::label('sexo', 'Sexo'); ?></strong>
                    <?php echo Form::select('sexo', ['Hombre' => 'Hombre', 'Mujer' => 'Mujer'], isset($medico->sexo) ? $medico->sexo : null, ['class' => 'form-control']); ?>

                    <?php $__errorArgs = ['sexo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <strong><?php echo Form::label('especialidad', 'Especialidad'); ?></strong>
                    <?php echo Form::text('especialidad', isset($medico) ? $medico->especialidad : '', ['class' => 'form-control', 'placeholder' => 'Ingrese Especialidad']); ?>

                    <?php $__errorArgs = ['especialidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div><br>            <br>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <?php echo Form::button('Volver', ['class' => 'btn btn-secondary', 'onclick' => 'window.history.go(-1);']); ?>

        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="js/datatable.js"></script>
    <script>
        $('#myTable').DataTable();
    </script>
<script>
    var fechaNacimiento = document.getElementById('fecha_nacimiento');
    var edadCampo = document.getElementById('edad');

    fechaNacimiento.addEventListener('input', function() {
        if (fechaNacimiento.value) {
            // Calcula la edad a partir de la fecha de nacimiento y la fecha actual
            var fechaNacimientoValue = new Date(fechaNacimiento.value);
            var hoy = new Date();
            var edad = hoy.getFullYear() - fechaNacimientoValue.getFullYear();

            if (hoy < new Date(hoy.getFullYear(), fechaNacimientoValue.getMonth(), fechaNacimientoValue.getDate())) {
                edad--;
            }

            // Llena el campo "edad" y desactívalo
            edadCampo.value = edad;
            edadCampo.setAttribute('disabled', 'disabled');
        } else {
            // Si no se selecciona una fecha de nacimiento, borra el valor y habilita el campo "edad"
            edadCampo.value = '';
            edadCampo.removeAttribute('disabled');
        }
    });

    edadCampo.addEventListener('input', function() {
        if (edadCampo.value) {
            // Desactiva el campo "fecha_nacimiento"
            fechaNacimiento.setAttribute('disabled', 'disabled');
        } else {
            // Habilita el campo "fecha_nacimiento"
            fechaNacimiento.removeAttribute('disabled');
        }
    });
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\usuariosHB\resources\views/patologia/medicos/edit.blade.php ENDPATH**/ ?>