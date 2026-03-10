<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- ❌ Disable zoom -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Mettacity</title>

    <!-- Preconnect to external resources -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="{{ asset('cssfolder/preloader.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('cssfolder/navbar.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('cssfolder/carousel.css?v=' . time()) }}"> 
    <link rel="stylesheet" href="{{ asset('cssfolder/secondsection.css?v=' . time()) }}"> 
    <link rel="stylesheet" href="{{ asset('cssfolder/thirdsection.css?v=' . time()) }}"> 
    <link rel="stylesheet" href="{{ asset('cssfolder/fourthsection.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('cssfolder/footer.css?v=' . time()) }}">

    <style>
        /* Video Popup Styles */
        .video-popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 10000;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease;
        }

        .video-popup-overlay.active {
            display: flex;
        }

        .video-popup-content {
            position: relative;
            width: 90%;
            max-width: 900px;
            animation: slideDown 0.4s ease;
        }

        .video-popup-close {
            position: absolute;
            top: -40px;
            right: 0;
            background: #fff;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            color: #333;
            transition: all 0.3s ease;
            z-index: 10001;
        }

        .video-popup-close:hover {
            background: #ff4444;
            color: #fff;
            transform: rotate(90deg);
        }

        .video-popup-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .video-popup-wrapper iframe,
        .video-popup-wrapper video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 12px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .video-popup-content {
                width: 95%;
            }

            .video-popup-close {
                top: -35px;
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }
        }
    </style>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* ❌ Prevent double-tap zoom on mobile */
        html, body {
            touch-action: manipulation;
            overflow-x: hidden;
        }
        
        @media (max-width: 425px) {
            html, body {
                touch-action: manipulation;
                overflow-x: hidden !important;
            }           
        }

        /* Loading optimization */
        img {
            content-visibility: auto;
        }
    </style>
    
    <!-- Disable DevTools -->
    <script src="{{ asset('js/disable-devtools.js?v=' . time()) }}"></script>
</head>

<body>

    <!-- Video Popup Modal -->
    <div id="videoPopup" class="video-popup-overlay">
        <div class="video-popup-content">
            <button class="video-popup-close" id="closeVideoPopup">
                <i class="fas fa-times"></i>
            </button>
            <div class="video-popup-wrapper" id="videoPopupWrapper">
                <!-- Video element will be dynamically inserted here -->
            </div>
        </div>
    </div>

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-content">
            <div class="preloader-logo">
                <img src="{{ asset('./assets/MEEKO.png') }}" alt="Loading...">
            </div>
            <div class="preloader-spinner"></div>
            <div class="preloader-text">Loading Mettacity...</div>
        </div>
    </div>

    @include('navbar')
    @include('carousel')
    @include('secondsection')
    @include('thirdsection')
    @include('fourthsection')
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

    <script>
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
    </script>

    <!-- Duplicate scrolling banner content for seamless loops -->
    <script>
        (function(){
            var tracks = document.querySelectorAll('.scrolling-banner .track');
            if (!tracks || tracks.length === 0) return;

            tracks.forEach(function(track){
                var original = track.innerHTML;
                track.innerHTML = original + original;
                var children = track.children;
                var originalCount = children.length / 2;

                for (var i = 0; i < children.length; i++) {
                    if (i >= originalCount) {
                        children[i].classList.add('duplicate');
                    }
                }
                track.classList.add('animate');
            });
        })();
    </script>

    <!-- ❌ Disable zoom using keyboard & mouse -->
    <script>
        // Disable Ctrl + scroll zoom
        document.addEventListener('wheel', function(e) {
            if (e.ctrlKey) {
                e.preventDefault();
            }
        }, { passive: false });

        // Disable Ctrl + +/-/0 zoom
        document.addEventListener('keydown', function(e) {
            if (
                e.ctrlKey &&
                (e.key === '+' || e.key === '-' || e.key === '=' || e.key === '0')
            ) {
                e.preventDefault();
            }
        });

        // Disable pinch zoom (mobile)
        document.addEventListener('gesturestart', function(e) {
            e.preventDefault();
        });
        document.addEventListener('gesturechange', function(e) {
            e.preventDefault();
        });
        document.addEventListener('gestureend', function(e) {
            e.preventDefault();
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Video Popup - Show on first visit
        window.addEventListener('load', function() {
            @if(isset($popupVideo) && $popupVideo && $popupVideo->is_active && $popupVideo->video_file)
            const videoPopup = document.getElementById('videoPopup');
            const videoWrapper = document.getElementById('videoPopupWrapper');
            const closeBtn = document.getElementById('closeVideoPopup');
            const VIDEO_SOURCE = '{{ asset('storage/' . $popupVideo->video_file) }}';
            const DELAY_MS = {{ $popupVideo->delay_seconds * 1000 }};
            let videoElement = null;
            
            // Check if user has seen the video popup before
            const hasSeenPopup = sessionStorage.getItem('videoPopupSeen');
            
            if (!hasSeenPopup && VIDEO_SOURCE) {
                setTimeout(function() {
                    // Create HTML5 video element for local files
                    videoElement = document.createElement('video');
                    videoElement.controls = true;
                    videoElement.autoplay = true;
                    videoElement.style.cssText = 'position: absolute; top: 0; left: 0; width: 100%; height: 100%; border-radius: 12px;';
                    
                    const source = document.createElement('source');
                    source.src = VIDEO_SOURCE;
                    source.type = 'video/mp4';
                    
                    videoElement.appendChild(source);
                    videoWrapper.appendChild(videoElement);
                    
                    videoPopup.classList.add('active');
                    document.body.style.overflow = 'hidden'; // Prevent scrolling
                }, DELAY_MS);
            }
            
            // Close button click
            closeBtn.addEventListener('click', function() {
                closeVideoPopup();
            });
            
            // Close on overlay click
            videoPopup.addEventListener('click', function(e) {
                if (e.target === videoPopup) {
                    closeVideoPopup();
                }
            });
            
            // Close on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && videoPopup.classList.contains('active')) {
                    closeVideoPopup();
                }
            });
            
            function closeVideoPopup() {
                videoPopup.classList.remove('active');
                
                // Stop video
                if (videoElement) {
                    videoElement.pause();
                    videoElement.currentTime = 0;
                    // Remove video element from DOM
                    videoWrapper.innerHTML = '';
                    videoElement = null;
                }
                
                document.body.style.overflow = ''; // Restore scrolling
                sessionStorage.setItem('videoPopupSeen', 'true'); // Mark as seen for this session
            }
            @endif
        });

        // Preloader - Hide when page is fully loaded
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            setTimeout(function() {
                preloader.classList.add('hidden');
                // Remove from DOM after animation
                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 500);
            }, 500); // Show for at least 500ms
        });

        // Simple dropdown toggle for News and Merch menus
        document.addEventListener('DOMContentLoaded', function() {
            const dropdowns = document.querySelectorAll('.header-nav .dropdown-toggle');
            
            dropdowns.forEach(function(dropdown) {
                dropdown.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Close all other dropdowns
                    document.querySelectorAll('.header-nav .dropdown-menu').forEach(function(menu) {
                        if (menu !== dropdown.nextElementSibling) {
                            menu.classList.remove('show');
                        }
                    });
                    
                    // Toggle current dropdown
                    const menu = dropdown.nextElementSibling;
                    if (menu && menu.classList.contains('dropdown-menu')) {
                        menu.classList.toggle('show');
                    }
                });
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.header-nav .dropdown-menu').forEach(function(menu) {
                        menu.classList.remove('show');
                    });
                }
            });
        });
    </script>

</body>
</html>
