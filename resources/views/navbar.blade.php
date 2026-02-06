<!-- ===========================
     HEADER (OVERLAY / RESPONSIVE)
     This is the main site header.
     It contains:
     - background image
     - desktop navigation
     - mobile hamburger menu + socials
=========================== -->
<header class="header-bg" id="siteHeader">

  <!-- ===========================
       HEADER BACKGROUND IMAGE
       This image is used as the visual background of the header.
       The class "header-bg-img" is usually styled with CSS to fit/cover.
  =========================== -->
  <img src="{{ asset('./assets/NAVIGATIONBAR.png') }}"
       alt="Navigation Bar Background"
       class="header-bg-img">

  <!-- ===========================
       HEADER CONTENT WRAPPER
       This holds the actual nav, logo, socials, etc.
       It sits on top of the background image.
  =========================== -->
  <div class="header-content">
    <div class="container-fluid">
      <div class="row align-items-center">

        <!-- ==========================================================
             MOBILE ONLY (d-md-none)
             This section appears only on screens smaller than "md"
             It contains:
             - Hamburger menu button (opens offcanvas)
             - Social icons on the right
        ========================================================== -->
        <div class="col-12 d-flex align-items-center justify-content-start d-md-none">

          <!-- ===========================
               HAMBURGER MENU BUTTON
               This triggers the Bootstrap offcanvas menu.
               data-bs-target="#mobileMenu" links to the offcanvas below.
          =========================== -->
          <button class="menu-btn" type="button"
                  data-bs-toggle="offcanvas"
                  data-bs-target="#mobileMenu"
                  aria-controls="mobileMenu"
                  aria-label="Open menu">
            <i class="fa-solid fa-bars"></i>
          </button>

          <!-- ===========================
               MOBILE SOCIAL ICONS
               ms-auto pushes this block to the far right.
          =========================== -->
          <div class="mobile-header-socials ms-auto">

            <!-- Facebook -->
            <a href="https://www.facebook.com/MettaCityPH"
               target="_blank"
               rel="noopener noreferrer"
               class="mobile-header-social"
               aria-label="Facebook">
              <i class="fa-brands fa-facebook-f"></i>
            </a>

            <!-- Instagram -->
            <a href="https://www.instagram.com/MettaCityPH"
               target="_blank"
               rel="noopener noreferrer"
               class="mobile-header-social"
               aria-label="Instagram">
              <i class="fa-brands fa-instagram"></i>
            </a>

            <!-- X / Twitter -->
            <a href="https://twitter.com/MettaCityPH"
               target="_blank"
               rel="noopener noreferrer"
               class="mobile-header-social"
               aria-label="X / Twitter">
              <i class="fa-brands fa-x-twitter"></i>
            </a>

          </div>
        </div>

        <!-- ==========================================================
             DESKTOP ONLY LEFT NAV (d-none d-md-flex)
             This section appears only on medium screens and above.
             This is your main navigation menu.
        ========================================================== -->
        <div class="col-4 d-none d-md-flex align-items-center">
          <ul class="header-nav">

            <!-- Home Link -->
            <li>
              <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>

            <!-- About Us Link -->
            <li>
              <a class="nav-link" href="{{ route('aboutus') }}">About Us</a>
            </li>

            <!-- Tickets Link (currently marked active manually) -->
            <li>
              <a class="nav-link active" href="{{ route('ticketing') }}">Tickets</a>
            </li>

            <!-- Contact Link (currently placeholder "#") -->
            <li>
              <a class="nav-link" href="#">Contact</a>
            </li>

            <!-- ===========================
                 DROPDOWN MENU (Merch)
                 Uses Bootstrap dropdown behavior.
            =========================== -->
            <li class="nav-item dropdown">

              <!-- Dropdown toggle button -->
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                Merch
              </a>

              <!-- Dropdown items -->
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Shirts</a></li>
                <li><a class="dropdown-item" href="#">Hats</a></li>
                <li><a class="dropdown-item" href="#">Accessories</a></li>
              </ul>
            </li>

          </ul>
        </div>

        <!-- ==========================================================
             DESKTOP ONLY CENTER LOGO (d-none d-md-flex)
             This is your logo in the middle column.
        ========================================================== -->
        <div class="col-4 col-mid d-none d-md-flex">

          <!-- Main logo -->
          <img src="{{ asset('./assets/METTACITY Logo.png') }}"
               class="logo-img"
               alt="Mettacity Logo">
        </div>

        <!-- ==========================================================
             DESKTOP ONLY RIGHT SIDE (CTA + SOCIALS)
             Contains:
             - "Plan Your Visit" CTA image link
             - Social icons
        ========================================================== -->
        <div class="col-4 d-none d-md-flex align-items-center justify-content-end gap-3 pe-4">

          <!-- ===========================
               CTA LINK
               This is a clickable image that routes to visit page.
          =========================== -->
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
     MOBILE OFFCANVAS MENU (ONLY ONE)
     This is the Bootstrap offcanvas menu that slides in from the left.
     It opens when the hamburger button is clicked.
========================================================== -->
<div class="offcanvas offcanvas-start mobile-offcanvas"
     tabindex="-1"
     id="mobileMenu"
     aria-labelledby="mobileMenuLabel">

  <!-- ===========================
       OFFCANVAS HEADER
       Contains:
       - Logo
       - Close button
  =========================== -->
  <div class="offcanvas-header mobile-offcanvas-header">

    <!-- Mobile menu logo -->
    <img src="header-menu-carousel/METTACITY Logo.png"
         alt="Mettacity"
         class="mobile-menu-logo">

    <!-- Close button (Bootstrap) -->
    <button type="button"
            class="btn-close btn-close-white"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
  </div>

  <!-- ===========================
       OFFCANVAS BODY
       Contains the navigation links.
  =========================== -->
  <div class="offcanvas-body mobile-offcanvas-body">

    <!-- Mobile navigation wrapper -->
    <nav class="mobile-nav">

      <!-- Home link
           request()->routeIs checks if the current page is the "home" route.
           If yes, it adds "active" class automatically. -->
      <a class="mobile-link {{ request()->routeIs('home') ? 'active' : '' }}"
         href="{{ route('home') }}">
        Home
      </a>

      <!-- About Us link -->
      <a class="mobile-link {{ request()->routeIs('aboutus') ? 'active' : '' }}"
         href="{{ route('aboutus') }}">
        About Us
      </a>

      <!-- Tickets link -->
      <a class="mobile-link {{ request()->routeIs('ticketing') ? 'active' : '' }}"
         href="{{ route('ticketing') }}">
        Tickets
      </a>

      <!-- Contact (empty link right now) -->
      <a class="mobile-link" href="">Contact</a>

      <!-- Divider line (visual separator) -->
      <div class="mobile-divider"></div>

      <!-- Merch Section Title -->
      <div class="mobile-section-title">Merch</div>

      <!-- Merch links -->
      <a class="mobile-link" href="#">Shirts</a>
      <a class="mobile-link" href="#">Hats</a>
      <a class="mobile-link" href="#">Accessories</a>

    </nav>
  </div>
</div>
