<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Mettacity</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('cssfolder/iientermettacity.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/footer.css') }}">

</head>

<body class="main-bg-section" style="background-image: url('{{ asset('./assets/II_ENTERMETTACITY/ENTER_METTACITY.png') }}');">

@include('navbar')

  <!-- HERO SECTION -->
  <section class="hero-wrapper">

    <!-- BACKGROUND VIDEO -->
    <video class="hero-video" autoplay muted loop playsinline>
      <source src="{{ asset('./assets/II_ENTERMETTACITY/main-video/BG-VIDEO.mp4') }}" type="video/mp4">
      <!-- fallback text -->
    </video>

    <!-- HERO CONTENT -->
    <div class="hero-content">
      <!-- <h1>Welcome to METTACITY</h1>
      <p>An Immersive Universe</p> -->
    </div>

  </section>
  
<!-- MARQUEE STRIP -->
<section class="marquee-strip">
  <div class="marquee-viewport">
    <div class="marquee-track" id="marqueeTrack">
      <div class="marquee-set" id="marqueeSet">
        <span class="dot">•</span><span class="play">PLAY</span>
        <span class="dot">•</span><span class="culture">CULTURE</span>
        <span class="dot">•</span><span class="tech">TECHNOLOGY</span>
      </div>
    </div>
  </div>
</section>

<!-- MAIN BACKGROUND SECTION -->
<section>
  <div class="zones-wrap">

    <!-- MAIN TITLE -->
    <div class="main-title-box">
        <img src="{{ asset('./assets/II_ENTERMETTACITY/TITLE.png') }}"  alt="The Mettacity Zones" class="main-title-img">
    </div>  

    <!-- ZONES LIST (STACKED) -->
    <div class="zones-list">
     <!-- 1) XR INFINITE SPACE -->
        <a href="javascript:void(0)" class="zone-card zone-purple has-overlay">
          <img src="{{ asset('./assets/II_ENTERMETTACITY/XR Infinite Space.png') }}" alt="XR Infinite Space">

          <div class="zone-full-overlay">
            <h3 class="zone-title">XR INFINITE SPACE</h3>
            <p class="zone-desc">Explore immersive worlds, cosmic visuals, and next-gen interactive experiences.</p>
          </div>
        </a>

        <!-- 2) 9D THEATER: FLYING CINEMA -->
        <a href="javascript:void(0)" class="zone-card zone-teal has-overlay">
          <img src="{{ asset('./assets/II_ENTERMETTACITY/9D Theatre_ Flying Cinema.png') }}" alt="9D Theater - Flying Cinema">

          <div class="zone-full-overlay">
            <h3 class="zone-title">9D THEATER</h3>
            <p class="zone-desc">Flying Cinema with motion, wind, and thrilling cinematic effects.</p>
          </div>
        </a>

        <!-- 3) 9D THEATER: DOOMSDAY HURRICANE -->
        <a href="javascript:void(0)" class="zone-card zone-yellow has-overlay">
          <img src="{{ asset('./assets/II_ENTERMETTACITY/9D Theatre_ Doomsday Hurricane.png') }}" alt="9D Theater - Doomsday Hurricane">

          <div class="zone-full-overlay">
            <h3 class="zone-title">DOOMSDAY HURRICANE</h3>
            <p class="zone-desc">An intense 9D cinematic ride with powerful effects and action scenes.</p>
          </div>
        </a>

      <!-- 4) KIDS WORLD (placeholder image) -->
      <a href="javascript:void(0)" class="zone-card zone-pink has-overlay">
          <img src="{{ asset('./assets/II_ENTERMETTACITY/Kids World.png') }}" alt="9D Theater - Doomsday Hurricane">

          <div class="zone-full-overlay">
            <h3 class="zone-title">DOOMSDAY HURRICANE</h3>
            <p class="zone-desc">An intense 9D cinematic ride with powerful effects and action scenes.</p>
          </div>
        </a>
    </div>
    </div>
    

            <!-- ✅ SECTION -->
    <section class="feature-exact">
      <div class="bg-wrapper stretch-bg">

        <!-- Desktop: exact image (no crop) -->
        <img src="{{ asset('./assets/II_ENTERMETTACITY/BG.png') }}" class="bg-exact-img" alt="BG" />

        <!-- Mobile: exact image (no crop) -->
        <img src="{{ asset('./assets/II_ENTERMETTACITY/FEATUREBG.png') }}" class="bgm-exact-img" alt="BG" />

        <!-- Overlay content -->
        <div class="feature-overlay container-fluid">
          <div class="row h-100 align-items-center justify-content-center">
            <div class="col-12">

              <!-- ROW 1 -->
              <div class="row align-items-center feature-row">
                <div class="col-lg-4 col-md-5">
                  <div class="pill">
                    <span class="pill-icon">
                      <img src="{{ asset('./assets/II_ENTERMETTACITY/Arrow.png') }}" alt="Arrow" />
                    </span>
                    <span class="pill-text">Play without Limits</span>
                  </div>
                </div>
                <div class="col-lg-8 col-md-7">
                  <p class="feature-text">
                    Jump, move, collaborate, compete—every space reacts to you.
                  </p>
                </div>
              </div>

              <!-- ROW 2 -->
              <div class="row align-items-center feature-row">
                <div class="col-lg-4 col-md-5">
                  <div class="pill">
                    <span class="pill-icon">
                        <img src="{{ asset('./assets/II_ENTERMETTACITY/Arrow.png') }}" alt="Arrow" />
                    </span>
                    <span class="pill-text">Explore Living Worlds</span>
                  </div>
                </div>
                <div class="col-lg-8 col-md-7">
                  <p class="feature-text">
                    Walls shift. Lights respond. Stories unfold as you explore.
                  </p>
                </div>
              </div>

              <!-- ROW 3 -->
              <div class="row align-items-center feature-row">
                <div class="col-lg-4 col-md-5">
                  <div class="pill">
                    <span class="pill-icon">
                        <img src="{{ asset('./assets/II_ENTERMETTACITY/Arrow.png') }}" alt="Arrow" />
                    </span>
                    <span class="pill-text">Create &amp; Share</span>
                  </div>
                </div>
                <div class="col-lg-8 col-md-7">
                  <p class="feature-text">
                    Capture moments, unlock surprises, and share your journey—every corner is Instagrammable.
                  </p>
                </div>
              </div>

              <!-- ROW 4 -->
              <div class="row align-items-center feature-row">
                <div class="col-lg-4 col-md-9">
                  <div class="pill">
                    <span class="pill-icon">
                        <img src="{{ asset('./assets/II_ENTERMETTACITY/Arrow.png') }}" alt="Arrow" />
                    </span>
                    <span class="pill-text">Experience Culture in Motion</span>
                  </div>
                </div>
                <div class="col-lg-8 col-md-7">
                  <p class="feature-text">
                    Art, music, fashion, and storytelling come alive through interactive environments.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
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
  <script src="{{ asset('jsfolder/iientermettacity.js') }}"></script>

</body>
</html>
