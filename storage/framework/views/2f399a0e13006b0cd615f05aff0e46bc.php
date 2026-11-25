<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<h2 class="mb-4" style="font-size: 1.25rem; font-weight: 600; color: #ffffffff; font-family: 'Poppins', sans-serif;">
    <i class="fas fa-chart-line"></i> Dashboard Overview
</h2>

<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm" style="border-radius: 8px;">
            <div class="card-body" style="padding: 18px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1" style="font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Total Visits</h6>
                        <h3 class="mb-0" style="font-size: 1.625rem; font-weight: 700; font-family: 'Poppins', sans-serif;"><?php echo e(number_format($totalVisits)); ?></h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded" style="border-radius: 8px;">
                        <i class="fas fa-eye fa-lg text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm" style="border-radius: 8px;">
            <div class="card-body" style="padding: 18px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1" style="font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Today's Visits</h6>
                        <h3 class="mb-0" style="font-size: 1.625rem; font-weight: 700; font-family: 'Poppins', sans-serif;"><?php echo e(number_format($todayVisits)); ?></h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded" style="border-radius: 8px;">
                        <i class="fas fa-calendar-day fa-lg text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm" style="border-radius: 8px;">
            <div class="card-body" style="padding: 18px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1" style="font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Yesterday's Visits</h6>
                        <h3 class="mb-0" style="font-size: 1.625rem; font-weight: 700; font-family: 'Poppins', sans-serif;"><?php echo e(number_format($yesterdayVisits)); ?></h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded" style="border-radius: 8px;">
                        <i class="fas fa-chart-line fa-lg text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm" style="border-radius: 8px;">
            <div class="card-body" style="padding: 18px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1" style="font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Total Bookings</h6>
                        <h3 class="mb-0" style="font-size: 1.625rem; font-weight: 700; font-family: 'Poppins', sans-serif;"><?php echo e($bookingsCount); ?></h3>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pendingBookings > 0): ?>
                            <span class="badge bg-warning" style="font-size: 0.65rem; font-weight: 500;"><?php echo e($pendingBookings); ?> Pending</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded" style="border-radius: 8px;">
                        <i class="fas fa-calendar-check fa-lg text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm" style="border-radius: 8px;">
            <div class="card-body" style="padding: 18px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="text-muted mb-1" style="font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Career Posts</h6>
                        <h3 class="mb-0" style="font-size: 1.625rem; font-weight: 700; font-family: 'Poppins', sans-serif;"><?php echo e($careersCount); ?></h3>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded" style="border-radius: 8px;">
                        <i class="fas fa-briefcase fa-lg text-info"></i>
                    </div>
                </div>
                <a href="<?php echo e(route('admin.careers.index')); ?>" class="btn btn-sm btn-info w-100" style="font-size: 0.8125rem; border-radius: 6px; font-family: 'Poppins', sans-serif; font-weight: 500; letter-spacing: 0.3px;">
                    <i class="fas fa-arrow-right"></i> View Careers
                </a>
            </div>
        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->is_super_admin): ?>
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm" style="border-radius: 8px;">
            <div class="card-body" style="padding: 18px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="text-muted mb-1" style="font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Total News</h6>
                        <h3 class="mb-0" style="font-size: 1.625rem; font-weight: 700; font-family: 'Poppins', sans-serif;"><?php echo e($newsCount); ?></h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded" style="border-radius: 8px;">
                        <i class="fas fa-newspaper fa-lg text-primary"></i>
                    </div>
                </div>
                <a href="<?php echo e(route('admin.news.index')); ?>" class="btn btn-sm btn-primary w-100" style="font-size: 0.8125rem; border-radius: 6px; font-family: 'Poppins', sans-serif; font-weight: 500; letter-spacing: 0.3px;">
                    <i class="fas fa-arrow-right"></i> Manage News
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm" style="border-radius: 8px;">
            <div class="card-body" style="padding: 18px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="text-muted mb-1" style="font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Total Users</h6>
                        <h3 class="mb-0" style="font-size: 1.625rem; font-weight: 700; font-family: 'Poppins', sans-serif;"><?php echo e($usersCount); ?></h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded" style="border-radius: 8px;">
                        <i class="fas fa-users fa-lg text-success"></i>
                    </div>
                </div>
                <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-sm btn-success w-100" style="font-size: 0.8125rem; border-radius: 6px; font-family: 'Poppins', sans-serif; font-weight: 500; letter-spacing: 0.3px;">
                    <i class="fas fa-arrow-right"></i> Manage Users
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 8px;">
            <div class="card-body" style="padding: 18px;">
                <h5 class="card-title mb-3" style="font-size: 0.95rem; font-weight: 600; font-family: 'Poppins', sans-serif;">
                    <i class="fas fa-bolt"></i> Quick Actions
                </h5>
                <div class="d-flex gap-2 flex-wrap">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->is_super_admin): ?>
                    <a href="<?php echo e(route('admin.news.create')); ?>" class="btn btn-primary btn-sm" style="font-size: 0.8125rem; border-radius: 6px; font-family: 'Poppins', sans-serif; font-weight: 500; letter-spacing: 0.3px;">
                        <i class="fas fa-plus"></i> Add News
                    </a>
                    <a href="<?php echo e(route('admin.careers.create')); ?>" class="btn btn-info btn-sm" style="font-size: 0.8125rem; border-radius: 6px; font-family: 'Poppins', sans-serif; font-weight: 500; letter-spacing: 0.3px;">
                        <i class="fas fa-plus"></i> Add Career
                    </a>
                    <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-success btn-sm" style="font-size: 0.8125rem; border-radius: 6px; font-family: 'Poppins', sans-serif; font-weight: 500; letter-spacing: 0.3px;">
                        <i class="fas fa-user-plus"></i> Add User
                    </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <a href="<?php echo e(route('admin.bookings.index')); ?>" class="btn btn-warning btn-sm" style="font-size: 0.8125rem; border-radius: 6px; font-family: 'Poppins', sans-serif; font-weight: 500; letter-spacing: 0.3px;">
                        <i class="fas fa-calendar"></i> View Bookings
                    </a>
                    <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary btn-sm" target="_blank" style="font-size: 0.8125rem; border-radius: 6px; font-family: 'Poppins', sans-serif; font-weight: 500; letter-spacing: 0.3px;">
                        <i class="fas fa-external-link-alt"></i> View Website
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\marke\OneDrive\Desktop\METTACITY MAIN\mettacityv2\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>