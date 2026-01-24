<!-- HEADER (OVERLAY / RESPONSIVE) -->
<header class="header-bg" id="siteHeader">
  <div class="header-content">
    <div class="container-fluid">
      <div class="row align-items-center">

        <!-- MOBILE: HAMBURGER ONLY -->
        <div class="col-12 d-flex align-items-center justify-content-start d-md-none">
          <button class="menu-btn" type="button"
                  data-bs-toggle="offcanvas"
                  data-bs-target="#mobileMenu"
                  aria-controls="mobileMenu"
                  aria-label="Open menu">
            <i class="fa-solid fa-bars"></i>
          </button>
          <div class="mobile-header-socials ms-auto">
            <a href="#" class="mobile-header-social"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="mobile-header-social"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" class="mobile-header-social"><i class="fa-brands fa-x-twitter"></i></a>
          </div>
        </div>

        <!-- DESKTOP: LEFT NAV -->
        <div class="col-4 d-none d-md-flex align-items-center">
          <ul class="header-nav">
            <li><a class="nav-link" href="#">Home</a></li>
            <li><a class="nav-link" href="#">About Us</a></li>
            <li><a class="nav-link active" href="../II_ENTER METTACITY/III_TICKETING/ticketing.html"">Tickets</a></li>
            <li><a class="nav-link" href="#">Contact</a></li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Merch</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Shirts</a></li>
                <li><a class="dropdown-item" href="#">Hats</a></li>
                <li><a class="dropdown-item" href="#">Accessories</a></li>
              </ul>
            </li>
          </ul>
        </div>

        <!-- DESKTOP: LOGO -->
        <div class="col-4 col-mid d-none d-md-flex">
          <img src="{{ asset('./assets/METTACITY Logo.png') }}" class="logo-img" alt="Mettacity Logo">
        </div>

        <!-- DESKTOP: CTA + SOCIAL -->
        <div class="col-4 d-none d-md-flex align-items-center justify-content-end gap-3 pe-4">
          <img src="{{ asset('./assets/PLAN YOUR VISIT.png') }}" class="plan-visit-img" alt="Plan Your Visit">

          <a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" class="social-icon"><i class="fa-brands fa-x-twitter"></i></a>
        </div>
        
      </div>
    </div>
  </div>
  <img src="{{ asset('./assets/NAVIGATIONBAR.png') }}" alt="Navigation Bar Background" class="header-bg-img">

</header>