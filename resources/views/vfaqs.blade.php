<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faqs</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('cssfolder/vfaqs.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/footer.css') }}">

</head>

<body style="background-image: url('{{ asset('./assets/V_FAQS/FAQS_MAINBG.png')}}');">
    
@include('navbar')

<!-- ================= STICKY GRID IMAGE ================= -->
<div class="sticky-grid">
  <img src="{{ asset('./assets/V_FAQS/FAQS_BG.png') }}" alt="Grid background"class="plan-bg"/>

  <div class="grid-title fade-down">
    <img src="{{ asset('./assets/V_FAQS/FAQS_TITLE.png') }}" alt="Frequently Asked Questions" class="title-bg"/>
  </div>
</div>

<div class="faq-accordion">

  <div class="faq-item" data-color="purple">
    <button class="faq-question">
      <span>Title for Frequently Asked Question 1?</span>
      <span class="icon">+</span>
    </button>
    <div class="faq-answer">
      <p>Your answer content goes here.</p>
    </div>
  </div>

  <div class="faq-item" data-color="green">
    <button class="faq-question">
      <span>Title for Frequently Asked Question 2?</span>
      <span class="icon">+</span>
    </button>
    <div class="faq-answer">
      <p>Your answer content goes here.</p>
    </div>
  </div>

  <div class="faq-item" data-color="yellow">
    <button class="faq-question">
      <span>Title for Frequently Asked Question 3?</span>
      <span class="icon">+</span>
    </button>
    <div class="faq-answer">
      <p>Your answer content goes here.</p>
    </div>
  </div>

  <div class="faq-item" data-color="pink">
    <button class="faq-question">
      <span>Title for Frequently Asked Question 4?</span>
      <span class="icon">+</span>
    </button>
    <div class="faq-answer">
      <p>Your answer content goes here.</p>
    </div>
  </div>
  <div class="faq-item" data-color="red">
    <button class="faq-question">
      <span>Title for Frequently Asked Question 5?</span>
      <span class="icon">+</span>
    </button>
    <div class="faq-answer">
      <p>Your answer content goes here.</p>
    </div>
  </div>

  <div class="faq-item" data-color="green">
    <button class="faq-question">
      <span>Title for Frequently Asked Question 6?</span>
      <span class="icon">+</span>
    </button>
    <div class="faq-answer">
      <p>Your answer content goes here.</p>
    </div>
  </div>

  <div class="faq-item" data-color="yellow">
    <button class="faq-question">
      <span>Title for Frequently Asked Question 7?</span>
      <span class="icon">+</span>
    </button>
    <div class="faq-answer">
      <p>Your answer content goes here.</p>
    </div>
  </div>

  <div class="faq-item" data-color="pink">
    <button class="faq-question">
      <span>Title for Frequently Asked Question 8?</span>
      <span class="icon">+</span>
    </button>
    <div class="faq-answer">
      <p>Your answer content goes here.</p>
    </div>
  </div>

  <div class="faq-item" data-color="yellow">
    <button class="faq-question">
      <span>Title for Frequently Asked Question 9?</span>
      <span class="icon">+</span>
    </button>
    <div class="faq-answer">
      <p>Your answer content goes here.</p>
    </div>
  </div>

  <div class="faq-item" data-color="pink">
    <button class="faq-question">
      <span>Title for Frequently Asked Question 10?</span>
      <span class="icon">+</span>
    </button>
    <div class="faq-answer">
      <p>Your answer content goes here.</p>
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
            </div>
          </div>
        </section>
 </section>


@include('footer')



  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('jsfolder/vfaqs.js') }}"></script>

</body>
</html>