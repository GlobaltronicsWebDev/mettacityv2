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
  <img src="{{ asset('assets/IV_PLANVISIT/PLAN_BG.png') }}" alt="Grid background" class="plan-bg">
  <div class="grid-title fade-down">
    <img src="{{ asset('assets/IV_PLANVISIT/PLAN_TITLE.png') }}" alt="The Mettacity Zones">
  </div>
</div>
<section class="booking-section">
<!-- FAQ SIDE TAB -->
   <div class="faq-wrapper" id="faqWrapper">

      <div class="faq-tab" id="faqToggle">
        <div class="faq-img-wrapper">
          <a href="{{ route('faqs') }}" ><img src="{{ asset('assets/IV_PLANVISIT/FAQs Shape.png') }}"></a>
          <span class="faq-text">FAQs</span>
          <i class="fa-solid fa-chevron-right faq-arrow"></i>
        </div>
      </div>

      <div class="faq-panel">
        <h2>Frequently Asked Questions</h2>
        <p>This now slides out correctly.</p>
      </div>
    </div>


  <div class="booking-grid">
      <!-- LEFT CARD -->
        <div class="promo-card image-card">
          <img src="{{ asset('assets/IV_PLANVISIT/EVENT (Full).png') }}" alt="Got an event in mind">
        </div>
        <!-- RIGHT FORM -->
<div class="form-card">
  <div class="form-header">
  <h3>
    Book Mettacity for immersive, interactive events—
  </h3>
  <p>
    from birthday parties and private events to school tours and team building.
  </p>
</div>

  <div class="input-row">
    <span class="prefix">+63</span>
    <input type="tel" placeholder="Please enter your phone number">
  </div>

  <div class="input-row">
    <input type="email" placeholder="Please enter your email address">
  </div>


  <!-- DATE PICKER -->
  <div class="date-picker-wrapper">

    <div class="input-row has-action" id="toggleCalendar">
      <input
        type="text"
        id="selectedDate"
        placeholder="See available dates"
        readonly
      >
      <button class="action-btn" type="button">✓</button>
    </div>

    <!-- OVERLAY CALENDAR -->
    <div class="calendar" id="calendar">
      <div class="calendar-header">
        <button class="nav-btn" id="prevMonth">‹</button>
        <h3 id="monthLabel"></h3>
        <button class="nav-btn" id="nextMonth">›</button>
      </div>

      <div class="weekdays">
        <div>Mon</div><div>Tue</div><div>Wed</div>
        <div>Thu</div><div>Fri</div><div>Sat</div><div>Sun</div>
      </div>

      <div class="days" id="daysGrid"></div>
    </div>

  </div>

  <button class="cta-btn">Book METTACITY Now</button>
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