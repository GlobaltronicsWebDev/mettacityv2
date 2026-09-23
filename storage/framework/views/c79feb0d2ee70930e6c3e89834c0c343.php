<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?php echo e(asset('cssfolder/viaboutus.css?v=1' . time())); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('cssfolder/navbar.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('cssfolder/footer.css?v=1' . time())); ?>">

</head>

<body style="background-image: url('<?php echo e(asset('./assets/VI_ABOUTUS/FAQS_BG.png')); ?>');">
    
<?php echo $__env->make('navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- ================= STICKY GRID IMAGE ================= -->
<section class="sticky-grid-wrapper">

  <div class="sticky-grid">
    <img
      src="<?php echo e(asset('./assets/VI_ABOUTUS/about_bg.png')); ?>" 
      alt="Grid background"
      class="plan-bg"/>

    <div class="grid-title fade-down">
      <img
        src="<?php echo e(asset('./assets/VI_ABOUTUS/abouttitle.png')); ?>"
        alt="Frequently Asked Questions"
        class="title-bg"/>
    </div>
  </div>

</section>

<section class="reel-section">
  <div class="reel-container">
    <img
      src="<?php echo e(asset('./assets/VI_ABOUTUS/REEL.png')); ?>"
      alt="Experience Reel"
      class="reel-image">
  </div>
</section>

<!-- VIDEO SECTION -->
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($aboutVideo) && $aboutVideo && $aboutVideo->video_file): ?>
<section class="video-section">
  <div class="video-container">
    <div class="video-wrapper">
      <video 
        width="100%" 
        height="600" 
        controls
        controlsList="nodownload"
        poster="<?php echo e(asset('./assets/VI_ABOUTUS/REEL.png')); ?>"
        style="width: 100%; height: auto; border-radius: 12px;">
        <source src="<?php echo e(asset('storage/' . $aboutVideo->video_file)); ?>" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>
  </div>
</section>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<!-- ABOUT METTACITY SECTION -->
<section class="about-mettacity-section"> 
  <div class="container">
    <div class="about-mettacity-header">
      <img src="<?php echo e(asset('./assets/VI_ABOUTUS/aboutlogo.png')); ?>" alt="About Mettacity" />
    </div>
<div class="about-mettacity-content">
  <div class="about-text-block">
    <h2>
      Only experiences you can move through, touch, and shape.
    </h2>

    <p>
      METTACITY is a next generation amusement destination
      where <em>real</em> and <em>digital</em> worlds collide.
    </p>
  </div>
</div>
  </div>
        <div class="mettacity-features container text-center">
          <div class="row align-items-center">
          <div class="feature-card col">
            <img src="<?php echo e(asset('./assets/VI_ABOUTUS/icon1.png')); ?>" alt="City">
            <p>It’s a city<br>you can play in.</p>
          </div>

          <div class="feature-card col">
            <img src="<?php echo e(asset('./assets/VI_ABOUTUS/icon2.png')); ?>" alt="Universe">
            <p>A universe<br>that responds to you.</p>
          </div>

          <div class="feature-card col">
            <img src="<?php echo e(asset('./assets/VI_ABOUTUS/icon3.png')); ?>" alt="Rocket">
            <p>A space where<br>every visit feels new.</p>
          </div>

          <div class="feature-card col">
            <img src="<?php echo e(asset('./assets/VI_ABOUTUS/icon4.png')); ?>" alt="Experience">
            <p>No screens<br>to just stare at.</p>
          </div>
          </div>
        </div>
        <div class="mettacity-tagline">
          <img src="<?php echo e(asset('./assets/VI_ABOUTUS/tagline.png')); ?>" alt="Come play. Share. Capture. Repeat." class="tagline-image">
        </div>
</section>

 <section class="bottom-merge">

        <!-- STATEMENT -->
        <section class="statement-section">
          <div class="container-fluid">
            <div class="statement-inner">
              <p class="statement-eyebrow">The future of amusement-</p>
              <h2 class="statement-heading">
                Where Culture, Play, and Technology Meet
              </h2>
            <a href="<?php echo e(route('visit')); ?>"><img src="<?php echo e(asset('./assets/PLAN YOUR VISIT.png')); ?>" alt="Enter Button" class="enter-button"></a>
            </div>
          </div>
        </section>
 </section>



<?php echo $__env->make('footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>



  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo e(asset('jsfolder/viaboutus.js')); ?>"></script>

</body>
</html><?php /**PATH C:\Users\marke\OneDrive\Desktop\METTACITY MAIN\mettacityv2\resources\views/viaboutus.blade.php ENDPATH**/ ?>