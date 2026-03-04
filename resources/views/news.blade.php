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
    <link rel="stylesheet" href="{{ asset('cssfolder/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('cssfolder/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('cssfolder/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('cssfolder/news.css') }}">
    
    <style>
        /* Accordion Styles */
        .accordion-section {
            max-width: 1200px;
            margin: 0 auto 3rem;
            padding: 0 20px;
        }

        .accordion-section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .accordion-item {
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            border-radius: 8px;
            overflow: hidden;
        }

        .accordion-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 1.25rem 1.5rem;
            border: none;
            text-align: left;
        }

        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: transparent;
        }

        .accordion-button::after {
            filter: brightness(0) invert(1);
        }

        .accordion-body {
            padding: 1.5rem;
            font-size: 1rem;
            line-height: 1.6;
            color: #333;
        }

        .accordion-body .row {
            align-items: flex-start;
        }

        .accordion-body p {
            margin: 0;
        }

        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 8px;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .accordion-section-title {
                font-size: 1.8rem;
                margin-bottom: 1.5rem;
            }

            .accordion-button {
                font-size: 1rem;
                padding: 1rem;
            }

            .accordion-body {
                padding: 1rem;
                font-size: 0.95rem;
            }

            .accordion-body .row {
                flex-direction: column;
            }

            .accordion-body .col-md-6 {
                width: 100%;
            }

            .accordion-body p {
                margin-top: 1rem;
            }
        }
    </style>>
   
</head>
<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-content">
            <div class="preloader-logo">
                <img src="{{ asset('./assets/MEEKO.png') }}" alt="Loading...">
            </div>
            <div class="preloader-spinner"></div>
            <div class="preloader-text">Loading News...</div>
        </div>
    </div>

    @include('navbar')

    <div class="news-container">
        <div class="news-header">
            <h1>LATEST NEWS</h1>
        </div>

        <!-- Accordion Section -->
        @if(isset($accordions) && $accordions->count() > 0)
        <div class="accordion-section mb-5">
            <h2 class="accordion-section-title">Check out our events</h2>
            <div class="accordion" id="newsAccordion">
                @foreach($accordions as $index => $accordion)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $accordion->id }}">
                        <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#collapse{{ $accordion->id }}" 
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" 
                                aria-controls="collapse{{ $accordion->id }}">
                            {{ $accordion->title }}
                        </button>
                    </h2>
                    <div id="collapse{{ $accordion->id }}" 
                         class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" 
                         aria-labelledby="heading{{ $accordion->id }}" 
                         data-bs-parent="#newsAccordion">
                        <div class="accordion-body">
                            <div class="row justify-content-end">
                                @if($accordion->embed_code)
                                <div class="col-md-8">
                                    <div class="video-container">
                                        {!! $accordion->embed_code !!}
                                    </div>
                                    <p class="mt-3">{{ $accordion->description }}</p>
                                </div>
                                @else
                                <div class="col-md-12">
                                    <p>{{ $accordion->description }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="news-grid">
            @forelse($news as $item)
            <!-- News Card -->
            <div class="news-card">
                @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="news-card-img">
                @else
                    <img src="{{ asset('assets/BANNER.png') }}" alt="{{ $item->title }}" class="news-card-img">
                @endif
                <div class="news-card-body">
                    <div class="news-date">{{ $item->published_date->format('F d, Y') }}</div>
                    <h3 class="news-title">{{ $item->title }}</h3>
                    <p class="news-excerpt">
                        {{ $item->excerpt }}
                    </p>
                    
                    <!-- Social Links -->
                    @if($item->facebook_link || $item->instagram_link || $item->custom_link)
                    <div class="social-links mb-3">
                        @if($item->facebook_link)
                            <a href="{{ $item->facebook_link }}" target="_blank" class="social-link" title="Facebook">
                                <i class="fab fa-facebook"></i>
                            </a>
                        @endif
                        @if($item->instagram_link)
                            <a href="{{ $item->instagram_link }}" target="_blank" class="social-link" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if($item->custom_link)
                            <a href="{{ $item->custom_link }}" target="_blank" class="social-link" title="Link">
                                <i class="fas fa-link"></i>
                            </a>
                        @endif
                    </div>
                    @endif
                    
                    <a href="{{ $item->facebook_link ?: 'https://www.facebook.com/MettaCityPH' }}" target="_blank" class="read-more">Read More →</a>
                </div>
            </div>
            @empty
            <!-- No News Available -->
            <div class="col-12 text-center py-5">
                <i class="fas fa-newspaper fa-3x mb-3" style="opacity: 0.3;"></i>
                <h3>No News Available</h3>
                <p>Check back soon for updates!</p>
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
