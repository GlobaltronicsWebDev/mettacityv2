<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News - Mettacity</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('cssfolder/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('cssfolder/footer.css') }}">
     <link rel="stylesheet" href="{{ asset('cssfolder/news.css') }}">
   
</head>
<body>

    @include('navbar')

    <div class="news-container">
        <div class="news-header">
            <h1>LATEST NEWS</h1>
        </div>

        <div class="news-grid">
            <!-- Sample News Card 1 -->
            <div class="news-card" onclick="window.open('https://www.facebook.com/photo/?fbid=1427733736031843&set=a.711623520976205', '_blank')">
                <img src="{{ asset('assets/NEWSPAGE/OPENINGWELCOME.png') }}" alt="News" class="news-card-img">
                <div class="news-card-body">
                    <div class="news-date">February 13, 2026</div>
                      <h3 class="news-title">Step beyond reality and immerse yourself in a one-of-a-kind adventure like no other</h3>
                    <p class="news-excerpt">
                        Don't miss our special weekend promotions! Get exclusive discounts on tickets and merchandise this weekend only.
                    </p>
                    <a href="https://www.facebook.com/photo/?fbid=1427733736031843&set=a.711623520976205" target="_blank" class="read-more" onclick="event.stopPropagation()">Read More →</a>
                </div>
            </div>

            <!-- Sample News Card 2 -->
            <div class="news-card" onclick="window.open('https://www.facebook.com/reel/721206764259309', '_blank')">
                <img src="{{ asset('assets/NEWSPAGE/METTACITYGRAND.png') }}" alt="News" class="news-card-img">
                <div class="news-card-body">
                    <div class="news-date">February 11, 2026</div>
                   <h3 class="news-title">METTACITY AT GLORIETTA: EXPERIENCE THE NEW IMMERSIVE ENTERTAINMENT HUB</h3>
                    <p class="news-excerpt">
                       Mettacity, the next-generation immersive destination.
                    </p>
                    <a href="https://www.facebook.com/reel/721206764259309" target="_blank" class="read-more" onclick="event.stopPropagation()">Read More →</a>
                </div>
            </div>

            <!-- Sample News Card 3 -->
            <div class="news-card" onclick="window.open('https://www.facebook.com/photo?fbid=122112735561209501&set=pcb.122112735783209501', '_blank')">
                <img src="{{ asset('assets/NEWSPAGE/FLOWER.jpg') }}" alt="News" class="news-card-img">
                <div class="news-card-body">
                    <div class="news-date">February 5, 2026</div>
                    <h3 class="news-title">Special Weekend Promotions</h3>
                    <p class="news-excerpt">
                        Don't miss our special weekend promotions! Get exclusive discounts on tickets and merchandise this weekend only.
                    </p>
                    <a href="https://www.facebook.com/photo?fbid=122112735561209501&set=pcb.122112735783209501" target="_blank" class="read-more" onclick="event.stopPropagation()">Read More →</a>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Fade in statement section on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, { threshold: 0.1 });

        const statementSection = document.querySelector('.statement-section');
        if (statementSection) {
            observer.observe(statementSection);
        }
    </script>
</body>
</html>
