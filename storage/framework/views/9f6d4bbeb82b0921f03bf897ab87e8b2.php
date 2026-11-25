<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PLAN YOUR VISIT</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?php echo e(asset('cssfolder/preloader.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('cssfolder/ivplanvisit.css')); ?>?v=<?php echo e(time()); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('cssfolder/navbar.css')); ?>?v=<?php echo e(time()); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('cssfolder/footer.css')); ?>?v=<?php echo e(time()); ?>">

</head>

<body style="background-image: url('<?php echo e(asset('./assets/IV_PLANVISIT/PLAN_MAINBG.png')); ?>');">

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-content">
            <div class="preloader-logo">
                <img src="<?php echo e(asset('./assets/MEEKO.png')); ?>" alt="Loading...">
            </div>
            <div class="preloader-spinner"></div>
            <div class="preloader-text">Planning Your Visit...</div>
        </div>
    </div>
    
<?php echo $__env->make('navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- ================= STICKY GRID IMAGE ================= -->
<div class="sticky-grid">
  <img
    src="<?php echo e(asset('./assets/IV_PLANVISIT/PLAN_BG.png')); ?>" alt="Grid background" class="plan-bg"/>
  <div class="grid-title fade-down">
    <img src="<?php echo e(asset('./assets/IV_PLANVISIT/PLAN_TITLE.png')); ?>" alt="Frequently Asked Questions"/>
  </div>
</div>

<!-- MAIN CONTENT -->
<section class="main-section">
  
  
  <!-- FAQ SIDEBAR -->
  <aside class="faq-sidebar" id="faqSidebar">
    <a href="<?php echo e(route('faqs')); ?>" class="faq-tab" id="faqTab">
      <img src="<?php echo e(asset('./assets/IV_PLANVISIT/FAQs Shape.png')); ?>" alt="FAQs" class="faq-shape-img">
      <div class="faq-tab-content">
        <span class="faq-text">FAQs</span>
        <i class="fa-solid fa-chevron-right faq-arrow"></i>
      </div>
    </a>
    <div class="faq-panel">
    </div>
  </aside>

  <div class="content-grid">
    
    <!-- EVENT CARD -->
    <div class="event-card">
        <div class="event-character">
          <img src="<?php echo e(asset('./assets/IV_PLANVISIT/EVENT (Full).png')); ?>" alt="Meeko Character">
        </div>
    </div>

    <!-- BOOKING FORM -->
    <div class="booking-card">
      <div class="booking-header">
        <h3>Book Mettacity for immersive, interactive events—</h3>
        <p>from birthday parties and private events to school tours and team building.</p>
      </div>

      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
          <?php echo e(session('success')); ?>

          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show">
          <ul class="mb-0">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
              <li><?php echo e($error); ?></li>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

      <form class="booking-form" id="bookingForm" method="POST" action="<?php echo e(route('bookings.store')); ?>" onsubmit="console.log('Form submitting...'); return true;">
        <?php echo csrf_field(); ?>
        
        <div class="form-input-group">
          <input type="text" name="name" placeholder="Please enter your full name" value="<?php echo e(old('name')); ?>" required>
        </div>

        <div class="form-input-group">
          <span class="input-prefix">+63</span>
          <input type="tel" name="phone" placeholder="Please enter your phone number" value="<?php echo e(old('phone')); ?>" required>
        </div>

    
        <div class="form-input-group date-input-group">
          <input type="date" name="visit_date" id="dateInput" placeholder="Select visit date" value="<?php echo e(old('visit_date')); ?>" required>
        </div>
   
        <button type="submit" class="submit-btn">Book METTACITY Now</button>

        <div class="form-terms">
          <label class="checkbox-label">
            <input type="checkbox" required>
            <span>I have read and hereby accepted <a href="#">Terms of Services</a> and <a href="#">Privacy Policy</a>. This website uses <a href="#">Terms of Services</a> and <a href="#">Privacy Policy</a>.</span>
          </label>
        </div>
      </form>
    </div>

  </div>
</section>

<!-- MARQUEE -->
<div class="marquee-container">
  <div class="marquee-track" id="marqueeTrack">
    <div class="marquee-content">
      <span class="marquee-item play">PLAY</span>
      <span class="marquee-dot">•</span>
      <span class="marquee-item culture">CULTURE</span>
      <span class="marquee-dot">•</span>
      <span class="marquee-item tech">TECHNOLOGY</span>
      <span class="marquee-dot">•</span>
    </div>
  </div>
</div>

 <section class="bottom-merge">

        <!-- STATEMENT -->
        <section class="statement-section">
          <div class="container-fluid">
            <div class="statement-inner">
              <p class="statement-eyebrow">The future of amusement-</p>
              <h2 class="statement-heading">
                Where Culture, Play, and Technology Meet
              </h2>
            <img src="<?php echo e(asset('./assets/IV_PLANVISIT/BOOKBUTTON.png')); ?>" alt="Enter Button" class="enter-button">
            </div>
          </div>
        </section>
 </section>

<?php echo $__env->make('footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Preloader - Hide when page is fully loaded
    window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');
        setTimeout(function() {
            preloader.classList.add('hidden');
            setTimeout(function() {
                preloader.style.display = 'none';
            }, 500);
        }, 500);
    });
  </script>
  
  <script src="<?php echo e(asset('jsfolder/ivplanvisit.js')); ?>"></script>

</body>
</html><?php /**PATH C:\Users\marke\OneDrive\Desktop\METTACITY MAIN\mettacityv2\resources\views\ivplanvisit.blade.php ENDPATH**/ ?>