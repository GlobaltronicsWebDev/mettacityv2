<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PLAN YOUR VISIT</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('cssfolder/ivplanvisit.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/footer.css') }}">

</head>

<body style="background-image: url('{{ asset('./assets/IV_PLANVISIT/PLAN_MAINBG.png')}}');">
    
@include('navbar')

<!-- ================= STICKY GRID IMAGE ================= -->
<div class="sticky-grid">
  <img
    src="{{ asset('./assets/IV_PLANVISIT/PLAN_BG.png') }}" alt="Grid background" class="plan-bg"/>
  <div class="grid-title fade-down">
    <img src="{{ asset('./assets/IV_PLANVISIT/PLAN_TITLE.png') }}" alt="Frequently Asked Questions"/>
  </div>
</div>

<!-- MAIN CONTENT -->
<section class="main-section">
  
  
  <!-- FAQ SIDEBAR -->
  <aside class="faq-sidebar" id="faqSidebar">
    <a href="{{ route('faqs') }}" class="faq-tab" id="faqTab">
      <img src="{{ asset('./assets/IV_PLANVISIT/FAQs Shape.png') }}" alt="FAQs" class="faq-shape-img">
      <div class="faq-tab-content">
        <span class="faq-text">FAQs</span>
        <i class="fa-solid fa-chevron-right faq-arrow"></i>
      </div>
    </a>
    <div class="faq-panel">
      <img src="{{ asset('./assets/IV_PLANVISIT/FAQS-SECTION/TEXT.png') }}" alt="FAQ Content" class="faq-content-img">
    </div>
  </aside>

  <div class="content-grid">
    
    <!-- EVENT CARD -->
    <div class="event-card">
        <div class="event-character">
          <img src="{{ asset('./assets/IV_PLANVISIT/EVENT (Full).png') }}" alt="Meeko Character">
        </div>
    </div>

    <!-- BOOKING FORM -->
    <div class="booking-card">
      <div class="booking-header">
        <h3>Book Mettacity for immersive, interactive events—</h3>
        <p>from birthday parties and private events to school tours and team building.</p>
      </div>

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <form class="booking-form" id="bookingForm" method="POST" action="{{ route('bookings.store') }}" onsubmit="console.log('Form submitting...'); return true;">
        @csrf
        
        <div class="form-input-group">
          <input type="text" name="name" placeholder="Please enter your full name" value="{{ old('name') }}" required>
        </div>

        <div class="form-input-group">
          <span class="input-prefix">+63</span>
          <input type="tel" name="phone" placeholder="Please enter your phone number" value="{{ old('phone') }}" required>
        </div>

    
        <div class="form-input-group date-input-group">
          <input type="date" name="visit_date" id="dateInput" placeholder="Select visit date" value="{{ old('visit_date') }}" required>
        </div>
   
        <button type="submit" class="submit-btn">Book METTACITY Now</button>

        <div class="form-terms">
          <label class="checkbox-label">
            <input type="checkbox" required>
            <span>I have read and hereby accepted <a href="#">Terms of Services</a> and <a href="#">Privacy Policy</a>. This website uses <a href="#">Terms of Services</a> and <a href="#">Privacy Policy</a>.</span>
          </label>
        </div>
      </form>
    </div>

  </div>
</section>

<!-- MARQUEE -->
<div class="marquee-container">
  <div class="marquee-track" id="marqueeTrack">
    <div class="marquee-content">
      <span class="marquee-item play">PLAY</span>
      <span class="marquee-dot">•</span>
      <span class="marquee-item culture">CULTURE</span>
      <span class="marquee-dot">•</span>
      <span class="marquee-item tech">TECHNOLOGY</span>
      <span class="marquee-dot">•</span>
    </div>
  </div>
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
            <img src="{{ asset('./assets/IV_PLANVISIT/BOOKBUTTON.png') }}" alt="Enter Button" class="enter-button">
            </div>
          </div>
        </section>
 </section>

@include('footer')


  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('jsfolder/ivplanvisit.js') }}"></script>

</body>
</html>