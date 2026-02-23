<div class="fourth-section">
    <img src="{{ asset('assets/TITLE.png') }}" alt="Fourth Section Title" class="fourthtitle">
    <img src="{{ asset('assets/STEP INSIDE.png') }}" alt="Fourth Section Body" class="fourthbody">
    <img src="{{ asset('assets/STEP INSIDE BG.png') }}" alt="Step Inside BG" class="stepinsidebgmobile">

    <div class="row-fourth">
      <div class="col">
        <img src="{{ asset('assets/TECHNOLOGY.png') }}" alt="TECHNOLOGY" class="technology">
      </div>
      <div class="col">
        <img src="{{ asset('assets/PLAY.png') }}" alt="PLAY" class="play"> 
      </div>
      <div class="col">
        <img src="{{ asset('assets/CULTURE.png') }}" alt="CULTURE" class="culture">
      </div>
      <div class="col">
        <a href="{{ route('enter.metta.city') }}"><img src="{{ asset('assets/ENTER METTACITY.png') }}" alt="ENTER METTACITY" class="entermettacity" style="height: 500px; width: auto; padding-top: 200px"></a>
      </div>
    </div>

      <div class="row-fourth-mobile">
        <div class="col">
          <img src="{{ asset('assets/1. TECHNOLOGY.png') }}" alt="TECHNOLOGY" class="techologym">
        </div>
        <div class="col">
          <img src="{{ asset('assets/2. PLAY.png') }}" alt="PLAY" class="playm"> 
        </div>
        <div class="col">
          <img src="{{ asset('assets/3. CULTURE.png') }}" alt="CULTURE" class="culturem">
        </div>
        <div class="col">
          <a href="{{ route('enter.metta.city') }}"><img src="{{ asset('assets/ENTER BUTTON.png') }}" alt="ENTER METTACITY" id="entermettacitym"></a>
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
    <img src="{{ asset('./assets/COREMESSAGE.png') }}" alt="Core Message" class="core-message">
    <img src="{{ asset('./assets/CORE MESSAGE.png') }}" alt="Core Message" class="core-messagem">



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
            <a href="{{ route('visit') }}"><img src="{{ asset('./assets/PLAN YOUR VISIT.png') }}" alt="Enter Button" class="enter-button"></a>
            </div>
          </div>
        </section>
 </section>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('jsfolder/fourthsection.js') }}"></script>