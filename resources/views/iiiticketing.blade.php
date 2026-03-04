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
  <link rel="stylesheet" href="{{ asset('cssfolder/preloader.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/iiiticketing.css?v=' . time()) }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/footer.css') }}">

</head>

<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-content">
            <div class="preloader-logo">
                <img src="{{ asset('./assets/MEEKO.png') }}" alt="Loading...">
            </div>
            <div class="preloader-spinner"></div>
            <div class="preloader-text">Loading Tickets...</div>
        </div>
    </div>
    
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

      @if(isset($tiers) && $tiers->count() > 0)
        @foreach($tiers as $tier)
          <div class="col-6 col-md-4">
            @if($tier->url)
              <a href="{{ $tier->url }}" target="_blank" class="tier-link">
                <img src="{{ asset('storage/' . $tier->image) }}" class="img-fluid grid-img" alt="{{ $tier->name }}">
              </a>
            @else
              <img src="{{ asset('storage/' . $tier->image) }}" class="img-fluid grid-img" alt="{{ $tier->name }}">
            @endif
          </div>
        @endforeach
      @else
        <!-- No tiers uploaded yet -->
        <div class="col-12 text-center py-5">
          <p class="text-muted">No ticket tiers available at the moment.</p>
        </div>
      @endif

    </div>

  </div>
</main>

    <!-- CENTER BUTTON -->
 
   <section class="marquee-strip">
     <div class="marquee-center">
    <a href="https://premier.ticketworld.com.ph/shows/show.aspx?sh=METTACIT26" class="buy-ticket-link" target="_blank">
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
            <a href="{{ route('visit') }}"><img src="{{ asset('./assets/PLAN YOUR VISIT.png') }}" alt="Enter Button" class="enter-button"></a>
            </div>
          </div>
        </section>
 </section>

@include('footer')


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
  
  <script src="{{ asset('jsfolder/iiiticketing.js') }}"></script>

</body>
</html>