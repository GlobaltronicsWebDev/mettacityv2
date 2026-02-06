<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ticketing</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('cssfolder/iiiticketing.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/footer.css') }}">

</head>

<body>
    
@include('navbar')

<!-- ================= STICKY GRID IMAGE ================= -->
<div class="sticky-grid">
  <img src="{{ asset('./assets/III_TICKETING/TITLE_BG.png') }}" alt="Grid background" class="ticket-bg">
  <div class="grid-title fade-down">
    <img src="{{ asset('./assets/III_TICKETING/TITLE_TITLE1.png') }}" alt="The Mettacity Zones" class="title-bg">
  </div>
</div>

<!-- ================= PAGE CONTENT ================= -->
<main class="page-content">
  <div class="container py-5">

    <!-- OPTIONAL TITLE -->
    <h1 class="mb-4 text-center"></h1>
    <p class="text-center mb-5"></p>

    <!-- IMAGE GRID -->
    <div class="row g-4 justify-content-center">

      <!-- ROWS 1–3 -->
      <div class="col-6 col-md-4">
        <img src="{{ asset('./assets/III_TICKETING/TIER 1.png') }}" class="img-fluid grid-img" alt="Tier 1">
      </div>

      <div class="col-6 col-md-4">
        <img src="{{ asset('./assets/III_TICKETING/TIER 2.png') }}" class="img-fluid grid-img" alt="Tier 2">
      </div>

      <div class="col-6 col-md-4">
        <img src="{{ asset('./assets/III_TICKETING/TIER 3.png') }}" class="img-fluid grid-img" alt="Tier 3">
      </div>

      <div class="col-6 col-md-4">
        <img src="{{ asset('./assets/III_TICKETING/TIER 4.png') }}" class="img-fluid grid-img" alt="Tier 4">
      </div>

      <div class="col-6 col-md-4">
        <img src="{{ asset('./assets/III_TICKETING/TIER 5.png') }}" class="img-fluid grid-img" alt="Tier 5">
      </div>

      <div class="col-6 col-md-4">
        <img src="{{ asset('./assets/III_TICKETING/TIER 6.png') }}" class="img-fluid grid-img" alt="Tier 6">
      </div>

      <div class="col-6 col-md-4">
        <img src="{{ asset('./assets/III_TICKETING/TIER 7.png') }}" class="img-fluid grid-img" alt="Tier 7">
      </div>

      <div class="col-6 col-md-4">
        <img src="{{ asset('./assets/III_TICKETING/TIER 8.png') }}" class="img-fluid grid-img" alt="Tier 8">
      </div>

      <div class="col-6 col-md-4">
        <img src="{{ asset('./assets/III_TICKETING/TIER 9.png') }}" class="img-fluid grid-img" alt="Tier 9">
      </div>

      <!-- LAST ROW (2 IMAGES CENTERED ON DESKTOP) -->
      <div class="col-6 col-md-4 offset-md-2">
        <img src="{{ asset('./assets/III_TICKETING/TIER 10.png') }}" class="img-fluid grid-img" alt="Tier 10">
      </div>

      <div class="col-6 col-md-4">
        <img src="{{ asset('./assets/III_TICKETING/TIER 11.png') }}" class="img-fluid grid-img" alt="Tier 11">
      </div>

    </div>

  </div>
</main>

    <!-- CENTER BUTTON -->
 
   <section class="marquee-strip">
     <div class="marquee-center">
    <a href="" class="buy-ticket-link" target="_blank">
      <img src="{{ asset('./assets/III_TICKETING/BUTTON.png') }}" alt="Buy Your Tickets" class="buy-ticket-button" >
    </a>
  </div>
  <!-- MARQUEE -->
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
  <script src="{{ asset('jsfolder/iiiticketing.js') }}"></script>

</body>
</html>