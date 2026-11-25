<div class="fourth-section">
    <img src="<?php echo e(asset('assets/TITLE.png')); ?>" alt="Fourth Section Title" class="fourthtitle">
    <img src="<?php echo e(asset('assets/STEP INSIDE.png')); ?>" alt="Fourth Section Body" class="fourthbody">
    <img src="<?php echo e(asset('assets/STEP INSIDE BG.png')); ?>" alt="Step Inside BG" class="stepinsidebgmobile">

    <div class="row-fourth">
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($categories) && $categories->count() >= 3): ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
        <div class="col">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($category->url): ?>
            <a href="<?php echo e($category->url); ?>" target="_blank">
              <img src="<?php echo e(asset('storage/' . $category->image)); ?>" alt="<?php echo e($category->name); ?>" class="<?php echo e(strtolower($category->slug)); ?>">
            </a>
          <?php else: ?>
            <img src="<?php echo e(asset('storage/' . $category->image)); ?>" alt="<?php echo e($category->name); ?>" class="<?php echo e(strtolower($category->slug)); ?>">
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
      <?php else: ?>
        <!-- Fallback to default images -->
        <div class="col">
          <img src="<?php echo e(asset('assets/TECHNOLOGY.png')); ?>" alt="TECHNOLOGY" class="technology">
        </div>
        <div class="col">
          <img src="<?php echo e(asset('assets/PLAY.png')); ?>" alt="PLAY" class="play"> 
        </div>
        <div class="col">
          <img src="<?php echo e(asset('assets/CULTURE.png')); ?>" alt="CULTURE" class="culture">
        </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      <div class="col">
        <a href="<?php echo e(route('enter.metta.city')); ?>"><img src="<?php echo e(asset('assets/ENTER METTACITY.png')); ?>" alt="ENTER METTACITY" class="entermettacity" style="height: 500px; width: auto; padding-top: 200px"></a>
      </div>
    </div>

      <div class="row-fourth-mobile">
        <div class="col">
          <img src="<?php echo e(asset('assets/1. TECHNOLOGY.png')); ?>" alt="TECHNOLOGY" class="techologym">
        </div>
        <div class="col">
          <img src="<?php echo e(asset('assets/2. PLAY.png')); ?>" alt="PLAY" class="playm"> 
        </div>
        <div class="col">
          <img src="<?php echo e(asset('assets/3. CULTURE.png')); ?>" alt="CULTURE" class="culturem">
        </div>
        <div class="col">
          <a href="<?php echo e(route('enter.metta.city')); ?>"><img src="<?php echo e(asset('assets/ENTER BUTTON.png')); ?>" alt="ENTER METTACITY" id="entermettacitym"></a>
        </div>
      </div>

    <div class="row-title">
      <div class="col-sm-9 p-3 t1">
        An immersive universe <br class="mobile-break">where you don't just watch the experience—
      </div>
      <div class="col-sm-9 p-3 t2">
        YOU BECOME PART OF IT!
      </div>
    </div>
  </div>

<!-- SCROLLING BANNER -->
<div class="fourth-scrolling-banner-wrapper">
  <div class="fourth-scrolling-banner" aria-hidden="true">
    
    <!-- SCROLLING TRACK -->
    <div class="fourth-scrolling-track">

      <!-- FIRST SET -->
      <p>
        <span class="technology">TECHNOLOGY</span> • 
        <span class="play">PLAY</span> • 
        <span class="culture">CULTURE</span> • 

        <span class="technology">TECHNOLOGY</span> • 
        <span class="play">PLAY</span> • 
        <span class="culture">CULTURE</span> • 

        <span class="technology">TECHNOLOGY</span> • 
        <span class="play">PLAY</span> • 
        <span class="culture">CULTURE</span> • 

        <span class="technology">TECHNOLOGY</span> • 
        <span class="play">PLAY</span> • 
        <span class="culture">CULTURE</span> •
      </p>

      <!-- DUPLICATED SET (REQUIRED FOR SEAMLESS LOOP) -->
      <p>
        <span class="technology">TECHNOLOGY</span> • 
        <span class="play">PLAY</span> • 
        <span class="culture">CULTURE</span> • 

        <span class="technology">TECHNOLOGY</span> • 
        <span class="play">PLAY</span> • 
        <span class="culture">CULTURE</span> • 

        <span class="technology">TECHNOLOGY</span> • 
        <span class="play">PLAY</span> • 
        <span class="culture">CULTURE</span> • 

        <span class="technology">TECHNOLOGY</span> • 
        <span class="play">PLAY</span> • 
        <span class="culture">CULTURE</span> •
      </p>

    </div>
  </div>
</div>

  <div class="fifth-banner">
    <img src="<?php echo e(asset('./assets/COREMESSAGE.png')); ?>" alt="Core Message" class="core-message">
   



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
            <a href="<?php echo e(route('visit')); ?>"><img src="<?php echo e(asset('./assets/PLAN YOUR VISIT.png')); ?>" alt="Enter Button" class="enter-button"></a>
            </div>
          </div>
        </section>
 </section>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo e(asset('jsfolder/fourthsection.js')); ?>"></script><?php /**PATH C:\Users\marke\OneDrive\Desktop\METTACITY MAIN\mettacityv2\resources\views\fourthsection.blade.php ENDPATH**/ ?>