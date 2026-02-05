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
  <link rel="stylesheet" href="{{ asset('cssfolder/vaboutus.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/footer.css') }}">

</head>

<body style="background-image: url('{{ asset('./assets/V_ABOUTUS/FAQS_BG.png')}}');">
    
@include('navbar')

<!-- ================= STICKY GRID IMAGE ================= -->
<section class="sticky-grid-wrapper">

  <div class="sticky-grid">
    <img
      src="{{ asset('./assets/V_ABOUTUS/about_bg.png') }}" 
      alt="Grid background"
      class="plan-bg"/>

    <div class="grid-title fade-down">
      <img
        src="{{ asset('./assets/V_ABOUTUS/abouttitle.png') }}"
        alt="Frequently Asked Questions"/>
    </div>
  </div>

</section>

<section class="reel-section">
  <div class="reel-container">
    <img
      src="{{ asset('./assets/V_ABOUTUS/REEL.png') }}"
      alt="Experience Reel"
      class="reel-image">
  </div>
</section>



<!-- ABOUT METTACITY SECTION -->
<section class="about-mettacity-section"> 
  <div class="container">
    <div class="about-mettacity-header">
      <img src="{{ asset('./assets/V_ABOUTUS/aboutlogo.png') }}" alt="About Mettacity" />
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
        <div class="mettacity-features">
          <div class="feature-card">
            <img src="{{ asset('./assets/V_ABOUTUS/icon1.png') }}" alt="City">
            <p>It’s a city<br>you can play in.</p>
          </div>

          <div class="feature-card">
            <img src="{{ asset('./assets/V_ABOUTUS/icon2.png') }}" alt="Universe">
            <p>A universe<br>that responds to you.</p>
          </div>

          <div class="feature-card">
            <img src="{{ asset('./assets/V_ABOUTUS/icon3.png') }}" alt="Rocket">
            <p>A space where<br>every visit feels new.</p>
          </div>

          <div class="feature-card">
            <img src="{{ asset('./assets/V_ABOUTUS/icon4.png') }}" alt="Experience">
            <p>No screens<br>to just stare at.</p>
          </div>
        </div>
        <div class="mettacity-tagline">
          <img src="{{ asset('./assets/V_ABOUTUS/tagline.png') }}" alt="Come play. Share. Capture. Repeat.">
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
            <img src="{{ asset('./assets/PLAN YOUR VISIT.png') }}" alt="Enter Button" class="enter-button">
            </div>
          </div>
        </section>
 </section>



@include('footer')



  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('jsfolder/vaboutus.js') }}"></script>

</body>
</html>