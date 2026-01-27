    <!-- Static background images under carousel -->
    <img src="{{ asset('./assets/CAROUSEL.png') }}" alt="Carousel Background" class="carousel-background">
    <img src="{{ asset('./assets/CAROUSELBGMOBILE.png') }}" alt="Carousel Background" class="carousel-background-mobile">

    <!-- SCROLLING BANNER -->
    <div class="scrolling-banner-wrapper">
        <div class="scrolling-banner left" aria-hidden="true">
            <div class="track">
                <p>
                    <span class="technology">TECHNOLOGY</span> • 
                    <span class="play">PLAY</span> • 
                    <span class="culture">CULTURE</span> • 
                    <span class="technology">TECHNOLOGY</span> • 
                    <span class="play">PLAY</span> • 
                    <span class="culture">CULTURE</span>
                </p>
                <p>
                    <span class="technology">TECHNOLOGY</span> • 
                    <span class="play">PLAY</span> • 
                    <span class="culture">CULTURE</span> • 
                    <span class="technology">TECHNOLOGY</span> • 
                    <span class="play">PLAY</span> • 
                    <span class="culture">CULTURE</span>
                </p>
            </div>
        </div>

        <div class="scrolling-banner right" aria-hidden="true">
            <div class="track">
                <p>
                    <span class="technology">TECHNOLOGY</span> • 
                    <span class="play">PLAY</span> • 
                    <span class="culture">CULTURE</span> • 
                    <span class="technology">TECHNOLOGY</span> • 
                    <span class="play">PLAY</span> • 
                    <span class="culture">CULTURE</span>
                </p>
                <p>
                    <span class="technology">TECHNOLOGY</span> • 
                    <span class="play">PLAY</span> • 
                    <span class="culture">CULTURE</span> • 
                    <span class="technology">TECHNOLOGY</span> • 
                    <span class="play">PLAY</span> • 
                    <span class="culture">CULTURE</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Banner Text -->
    <div class="secondbanner">
        <h2>The future of amusement-</h2>
        <h1>Where Culture, Play, and Technology Meet</h1>
        <a href="{{ route('enter.metta.city') }}"><img src="{{ asset('./assets/ENTER BUTTON.png') }}" alt="Enter Button" class="enter-button"></a>
    </div>

    <!-- Main Carousel -->
    <img src="{{ asset('./assets/MAINCAROUSEL.png') }}" alt="Main Carousel" class="main-carousel">

<div class="">
<div class="firstmaincarousel-overlay"></div>

<!-- ================= IMAGE LIST (Blade Format) ================= -->
<div class="firstmaincarousel-images">
  {{-- Blade example --}}
  {{-- @foreach($images as $image) --}}
  {{-- <img src="{{ asset($image) }}" data-carousel-image /> --}}
  {{-- @endforeach --}}

  <!-- Plain HTML version -->
  <img src="{{ asset('assets/AFRICAN SAVANNAH.png') }}" data-carousel-image>
  <img src="{{ asset('assets/BIUBIU GUN GOD.png') }}" data-carousel-image>
  <img src="{{ asset('assets/DOOMSDAY HURRICANE.png') }}" data-carousel-image>
  <img src="{{ asset('assets/FLYING CINEM.png') }}" data-carousel-image>
  <img src="{{ asset('assets/METTACITY.png') }}" data-carousel-image>
  <img src="{{ asset('assets/NORTH AND SOUTH POLES.png') }}" data-carousel-image>
  <img src="{{ asset('assets/SEAWORLD.png') }}" data-carousel-image>
  <img src="{{ asset('assets/XR INFINITE SPACE.png') }}" data-carousel-image>
</div>
</div>



<script src="{{ asset('jsfolder/secondsection.js') }}"></script>

