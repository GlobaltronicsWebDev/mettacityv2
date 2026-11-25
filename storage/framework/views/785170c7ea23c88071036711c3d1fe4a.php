<?php $__env->startSection('title', 'Booking Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-calendar-check"></i> Booking Details</h2>
    <a href="<?php echo e(route('admin.bookings.index')); ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to List
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Booking #<?php echo e($booking->id); ?></h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Name:</strong><br>
                        <?php echo e($booking->name); ?>

                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong><br>
                        <?php echo e($booking->email); ?>

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Phone:</strong><br>
                        <?php echo e($booking->phone); ?>

                    </div>
                    <div class="col-md-6">
                        <strong>Number of Guests:</strong><br>
                        <?php echo e($booking->number_of_guests); ?>

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Visit Date:</strong><br>
                        <?php echo e($booking->visit_date->format('F d, Y')); ?>

                    </div>
                    <div class="col-md-6">
                        <strong>Status:</strong><br>
                        <span class="badge bg-<?php echo e($booking->status == 'confirmed' ? 'success' : ($booking->status == 'cancelled' ? 'danger' : 'warning')); ?>">
                            <?php echo e(ucfirst($booking->status)); ?>

                        </span>
                    </div>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->message): ?>
                <div class="row mb-3">
                    <div class="col-12">
                        <strong>Message:</strong><br>
                        <p class="border p-3 rounded bg-light"><?php echo e($booking->message); ?></p>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="row">
                    <div class="col-12">
                        <strong>Booked On:</strong><br>
                        <?php echo e($booking->created_at->format('F d, Y h:i A')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Actions</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.bookings.updateStatus', $booking)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Update Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" <?php echo e($booking->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                            <option value="confirmed" <?php echo e($booking->status == 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                            <option value="cancelled" <?php echo e($booking->status == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save"></i> Update Status
                    </button>
                </form>

                <hr>

                <form action="<?php echo e(route('admin.bookings.destroy', $booking)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this booking?')">
                        <i class="fas fa-trash"></i> Delete Booking
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\marke\OneDrive\Desktop\METTACITY MAIN\mettacityv2\resources\views\admin\bookings\show.blade.php ENDPATH**/ ?>