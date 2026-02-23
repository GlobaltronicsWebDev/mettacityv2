<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers - Mettacity</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('cssfolder/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('cssfolder/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('cssfolder/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('cssfolder/news.css') }}">
   
</head>
<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-content">
            <div class="preloader-logo">
                <img src="{{ asset('./assets/MEEKO.png') }}" alt="Loading...">
            </div>
            <div class="preloader-spinner"></div>
            <div class="preloader-text">Loading Careers...</div>
        </div>
    </div>

    @include('navbar')

    <div class="news-container">
        <div class="news-header">
            <h1>JOIN OUR TEAM</h1>
            <p>🚀 Explore Career Opportunities at Mettacity 🚀</p>
        </div>

        <div class="news-grid">
            @forelse($careers as $career)
            <!-- Career Card -->
            <div class="news-card">
                @if($career->image)
                    <img src="{{ asset('storage/' . $career->image) }}" alt="{{ $career->title }}" class="news-card-img">
                @else
                    <img src="{{ asset('assets/BANNER.png') }}" alt="{{ $career->title }}" class="news-card-img">
                @endif
                <div class="news-card-body">
                    <div class="news-date">
                        @if($career->location)
                            <i class="fas fa-map-marker-alt"></i> {{ $career->location }}
                        @endif
                        @if($career->type)
                            <span class="ms-2"><i class="fas fa-briefcase"></i> {{ $career->type }}</span>
                        @endif
                    </div>
                    <h3 class="news-title">{{ $career->title }}</h3>
                    <p class="news-excerpt">
                        {{ Str::limit($career->description, 150) }}
                    </p>
                    <a href="mailto:careers@mettacity.com?subject=Application for {{ $career->title }}" class="read-more">
                        Apply Now →
                    </a>
                </div>
            </div>
            @empty
            <!-- No Careers Available -->
            <div class="col-12 text-center py-5">
                <i class="fas fa-briefcase fa-3x mb-3" style="opacity: 0.3;"></i>
                <h3>No Open Positions</h3>
                <p>Check back soon for new opportunities!</p>
            </div>
            @endforelse
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
            <a href="{{ route('visit') }}"><img src="{{ asset('./assets/PLAN YOUR VISIT.png') }}" alt="Enter Button" class="enter-button"></a>
            </div>
          </div>
        </section>
    </section>
    
    @include('footer')

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="scroll-to-top" title="Back to top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <style>
        .scroll-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 212, 255, 0.4);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .scroll-to-top.show {
            opacity: 1;
            visibility: visible;
            animation: bounce 2s infinite;
        }

        .scroll-to-top:hover {
            animation: none;
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 212, 255, 0.6);
            background: linear-gradient(135deg, #0099cc 0%, #00d4ff 100%);
        }

        .scroll-to-top:active {
            transform: translateY(-2px);
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        @media (max-width: 768px) {
            .scroll-to-top {
                width: 45px;
                height: 45px;
                bottom: 20px;
                right: 20px;
                font-size: 1rem;
            }
        }
    </style>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
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

        // Scroll to Top Button
        const scrollToTopBtn = document.getElementById('scrollToTop');

        // Show button when user scrolls down 300px
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.add('show');
            } else {
                scrollToTopBtn.classList.remove('show');
            }
        });

        // Smooth scroll to top when clicked
        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

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
