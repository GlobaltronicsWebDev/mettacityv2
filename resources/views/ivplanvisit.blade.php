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

      <form class="booking-form" id="bookingForm">
        <div class="form-input-group">
          <span class="input-prefix">+63</span>
          <input type="tel" placeholder="Please enter your phone number" required>
        </div>

        <div class="form-input-group">
          <input type="email" placeholder="Please enter your email address" required>
        </div>

        <div class="form-input-group date-input-group">
          <input type="text" id="dateInput" placeholder="See available dates" readonly>
          <button type="button" class="date-toggle-btn" id="dateToggle">
            <i class="fa-solid fa-chevron-down"></i>
          </button>
        </div>

        <!-- Calendar Dropdown -->
        <div class="calendar-dropdown" id="calendarDropdown">
          <div class="calendar-header">
            <button type="button" class="cal-nav-btn" id="prevMonth">
              <i class="fa-solid fa-chevron-left"></i>
            </button>
            <h4 id="monthYear"></h4>
            <button type="button" class="cal-nav-btn" id="nextMonth">
              <i class="fa-solid fa-chevron-right"></i>
            </button>
          </div>
          <div class="calendar-weekdays">
            <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
          </div>
          <div class="calendar-grid" id="calendarGrid"></div>
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