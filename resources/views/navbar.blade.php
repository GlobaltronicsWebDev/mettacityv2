<!-- ===========================
     HEADER (OVERLAY / RESPONSIVE)
=========================== -->
<header class="header-bg" id="siteHeader">

  <!-- ===========================
       HEADER BACKGROUND IMAGE
  =========================== -->
  <img src="{{ asset('./assets/NAVIGATIONBAR.png') }}"
       alt="Navigation Bar Background"
       class="header-bg-img">

  <!-- ===========================
       HEADER CONTENT WRAPPER
  =========================== -->
  <div class="header-content">
    <div class="container-fluid">
      <div class="row align-items-center">

        <!-- ==========================================================
             MOBILE ONLY (d-md-none)
             Logo LEFT, Hamburger RIGHT
        ========================================================== -->
        <div class="col-12 d-flex align-items-center justify-content-between d-md-none">

          <!-- MOBILE LOGO (LEFT) -->
          <a href="{{ route('home') }}" class="mobile-logo-link">
            <img src="{{ asset('./assets/METTACITY Logo.png') }}"
                 class="mobile-logo-img"
                 alt="Mettacity Logo">
          </a>

          <!-- HAMBURGER MENU BUTTON (RIGHT) -->
          <button class="menu-btn" type="button"
                  data-bs-toggle="offcanvas"
                  data-bs-target="#mobileMenu"
                  aria-controls="mobileMenu"
                  aria-label="Open menu">
            <i class="fa-solid fa-bars"></i>
          </button>

        </div>

        <!-- ==========================================================
             DESKTOP ONLY LEFT NAV
        ========================================================== -->
        <div class="col-4 d-none d-md-flex align-items-center">
          <ul class="header-nav">

            <li>
              <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>

            <li>
              <a class="nav-link" href="{{ route('aboutus') }}">About Us</a>
            </li>

            <li>
              <a class="nav-link active" href="{{ route('ticketing') }}">Tickets</a>
            </li>

            <li>
              <a class="nav-link" href="#">Contact</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                News
              </a>

              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('news') }}">Latest News</a></li>
                <li><a class="dropdown-item" href="{{ route('careers') }}">Careers</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                Merch
              </a>

              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Shirts</a></li>
                <li><a class="dropdown-item" href="#">Hats</a></li>
                <li><a class="dropdown-item" href="#">Accessories</a></li>
              </ul>
            </li>

          </ul>
        </div>

        <!-- ==========================================================
             DESKTOP ONLY CENTER LOGO
        ========================================================== -->
        <div class="col-4 col-mid d-none d-md-flex">
          <img src="{{ asset('./assets/METTACITY Logo.png') }}"
               class="logo-img"
               alt="Mettacity Logo">
        </div>

        <!-- ==========================================================
             DESKTOP ONLY RIGHT SIDE (CTA + SOCIALS)
        ========================================================== -->
        <div class="col-4 d-none d-md-flex align-items-center justify-content-end gap-3 pe-4">

          <!-- Admin Icon -->
          <a href="{{ route('admin.login') }}" class="social-icon" aria-label="Admin Panel" title="Admin Panel">
            <i class="fas fa-user-shield"></i>
          </a>

          <!-- CTA LINK -->
          <a class="nav-link active" href="{{ route('visit') }}">
            <img src="{{ asset('./assets/PLAN YOUR VISIT.png') }}"
                 class="plan-visit-img"
                 alt="Plan Your Visit">
          </a>

          <!-- Facebook -->
          <a href="https://www.facebook.com/MettaCityPH"
             target="_blank"
             rel="noopener noreferrer"
             class="social-icon"
             aria-label="Facebook">
            <i class="fa-brands fa-facebook-f"></i>
          </a>

          <!-- Instagram -->
          <a href="https://www.instagram.com/MettaCityPH"
             target="_blank"
             rel="noopener noreferrer"
             class="social-icon"
             aria-label="Instagram">
            <i class="fa-brands fa-instagram"></i>
          </a>

          <!-- X / Twitter -->
          <a href="https://twitter.com/MettaCityPH"
             target="_blank"
             rel="noopener noreferrer"
             class="social-icon"
             aria-label="X / Twitter">
            <i class="fa-brands fa-x-twitter"></i>
          </a>

        </div>

      </div>
    </div>
  </div>

</header>


<!-- ==========================================================
     MOBILE OFFCANVAS MENU
     SLIDES FROM RIGHT
========================================================== -->
<div class="offcanvas offcanvas-end mobile-offcanvas"
     tabindex="-1"
     id="mobileMenu"
     aria-labelledby="mobileMenuLabel">

  <!-- OFFCANVAS HEADER -->
  <div class="offcanvas-header mobile-offcanvas-header">

    <img src="header-menu-carousel/METTACITY Logo.png"
         alt="Mettacity"
         class="mobile-menu-logo">

    <button type="button"
            class="btn-close btn-close-white"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
  </div>

  <!-- OFFCANVAS BODY -->
  <div class="offcanvas-body mobile-offcanvas-body">

    <!-- TOP ROW: Plan Visit LEFT, Socials RIGHT -->
    <div class="mobile-offcanvas-top">

      <a href="{{ route('visit') }}" class="mobile-plan-visit">
        <img src="{{ asset('./assets/PLAN YOUR VISIT.png') }}"
             alt="Plan Your Visit">
      </a>

      <div class="mobile-offcanvas-socials">

        <a href="{{ route('admin.login') }}"
           class="mobile-offcanvas-social"
           aria-label="Admin Panel">
          <i class="fas fa-user-shield"></i>
        </a>

        <a href="https://www.facebook.com/MettaCityPH"
           target="_blank"
           rel="noopener noreferrer"
           class="mobile-offcanvas-social"
           aria-label="Facebook">
          <i class="fa-brands fa-facebook-f"></i>
        </a>

        <a href="https://www.instagram.com/MettaCityPH"
           target="_blank"
           rel="noopener noreferrer"
           class="mobile-offcanvas-social"
           aria-label="Instagram">
          <i class="fa-brands fa-instagram"></i>
        </a>

        <a href="https://twitter.com/MettaCityPH"
           target="_blank"
           rel="noopener noreferrer"
           class="mobile-offcanvas-social"
           aria-label="X / Twitter">
          <i class="fa-brands fa-x-twitter"></i>
        </a>

      </div>
    </div>

    <!-- NAV LINKS -->
    <nav class="mobile-nav">

      <a class="mobile-link {{ request()->routeIs('home') ? 'active' : '' }}"
         href="{{ route('home') }}">
        Home
      </a>

      <a class="mobile-link {{ request()->routeIs('aboutus') ? 'active' : '' }}"
         href="{{ route('aboutus') }}">
        About Us
      </a>

      <a class="mobile-link {{ request()->routeIs('ticketing') ? 'active' : '' }}"
         href="{{ route('ticketing') }}">
        Tickets
      </a>

      <a class="mobile-link" href="">Contact</a>

      <div class="mobile-divider"></div>

      <div class="mobile-section-title">News</div>

      <a class="mobile-link {{ request()->routeIs('news') ? 'active' : '' }}"
         href="{{ route('news') }}">
        Latest News
      </a>

      <a class="mobile-link {{ request()->routeIs('careers') ? 'active' : '' }}"
         href="{{ route('careers') }}">
        Careers
      </a>

      <div class="mobile-divider"></div>

      <div class="mobile-section-title">Merch</div>

      <a class="mobile-link" href="#">Shirts</a>
      <a class="mobile-link" href="#">Hats</a>
      <a class="mobile-link" href="#">Accessories</a>

    </nav>
  </div>
</div>
