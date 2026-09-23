<!-- FOOTER -->
<footer class="footer-exact">

  <div class="footer-bg-wrap">
    <!-- Footer background -->
    <img src="<?php echo e(asset('assets/CONTACT.png')); ?>" class="footer-bg-img" alt="">

    <!-- Character anchored to footer bg -->
    <img src="<?php echo e(asset('assets/MEEKO SITTING.png')); ?>" class="footer-character" alt="">

    <img src="<?php echo e(asset('assets/Mobilefooter.png')); ?>" class="mobilefooter" alt="">
  </div>

  <!-- Logo + socials -->
  <div class="footer-logo-center">
    <img src="<?php echo e(asset('assets/METTACITY LOGO WHITE.png')); ?>" class="footer-logo" alt="">

    <div class="footer-socials">
      <!-- Facebook -->
      <a href="https://www.facebook.com/MettaCityPH" target="_blank" rel="noopener noreferrer">
        <i class="fa-brands fa-facebook-f" aria-label="Facebook"></i>
      </a>

      <!-- YouTube -->
      <a href="https://www.youtube.com/@MettaCityPH" target="_blank" rel="noopener noreferrer">
        <i class="fa-brands fa-youtube" aria-label="YouTube"></i>
      </a>

      <!-- Instagram -->
      <a href="https://www.instagram.com/mettacityph/" target="_blank" rel="noopener noreferrer">
        <i class="fa-brands fa-instagram" aria-label="Instagram"></i>
      </a>
    </div>

    <!-- Visit Counter -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($totalVisits)): ?>
    <div class="footer-visit-counter">
      <i class="fa-solid fa-eye"></i>
      <span class="visit-count"><?php echo e(number_format($totalVisits)); ?></span>
      <span class="visit-label">Total Visits</span>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  </div>

  <div class="footer-contact">
    <img src="<?php echo e(asset('assets/mettacity_contacts.png')); ?>" class="footer-contact-img" alt="">
  </div>

</footer>
<?php /**PATH C:\Users\marke\OneDrive\Desktop\METTACITY MAIN\mettacityv2\resources\views/footer.blade.php ENDPATH**/ ?>