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
            background: rgba(0, 0, 0, 0.95);
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
            width: 95%;
            max-width: 1400px;
            animation: slideDown 0.4s ease;
        }

        .video-popup-close {
            position: absolute;
            top: -50px;
            right: 0;
            background: #fff;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.4rem;
            color: #333;
            transition: all 0.3s ease;
            z-index: 10001;
        }

        .video-popup-close:hover {
            background: #ff4444;
            color: #fff;
            transform: rotate(90deg) scale(1.1);
        }

        .video-popup-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.8);
        }

        .video-popup-wrapper iframe,
        .video-popup-wrapper video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 16px;
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
                width: 98%;
            }

            .video-popup-close {
                top: -45px;
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }
            
            .video-popup-wrapper {
                border-radius: 12px;
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

        /* Cookie Consent Banner */
        .cookie-consent {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.95);
            color: #fff;
            padding: 20px;
            z-index: 9999;
            display: none;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.4s ease;
        }

        .cookie-consent.show {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .cookie-consent-text {
            flex: 1;
            font-size: 14px;
            line-height: 1.5;
        }

        .cookie-consent-text a {
            color: #00d4ff;
            text-decoration: none;
            font-weight: 600;
        }

        .cookie-consent-text a:hover {
            text-decoration: underline;
        }

        .cookie-consent-buttons {
            display: flex;
            gap: 10px;
            flex-shrink: 0;
        }

        .cookie-consent-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .cookie-consent-btn-accept {
            background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
            color: #fff;
        }

        .cookie-consent-btn-accept:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 212, 255, 0.4);
        }

        .cookie-consent-btn-decline {
            background: transparent;
            color: #fff;
            border: 1px solid #666;
        }

        .cookie-consent-btn-decline:hover {
            border-color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }

        @keyframes slideUp {
            from {
                transform: translateY(100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .cookie-consent {
                padding: 15px;
                flex-direction: column;
                align-items: flex-start;
            }

            .cookie-consent.show {
                flex-direction: column;
                align-items: stretch;
            }

            .cookie-consent-text {
                font-size: 13px;
            }

            .cookie-consent-buttons {
                width: 100%;
                gap: 10px;
            }

            .cookie-consent-btn {
                flex: 1;
                padding: 12px 15px;
            }
        }
    </style>
    
    <!-- Disable DevTools -->
    <script src="{{ asset('js/disable-devtools.js?v=' . time()) }}"></script>
</head>

<body>

    <!-- Cookie Consent Banner -->
    <div id="cookieConsent" class="cookie-consent">
        <div class="cookie-consent-text">
            We use cookies to enhance your experience and analyze site traffic. By continuing to use this site, you agree to our use of cookies.
            <a href="#" onclick="event.preventDefault(); alert('Cookie Policy: We use essential cookies for site functionality and analytics cookies to understand how you use our site.');">Learn more</a>
        </div>
        <div class="cookie-consent-buttons">
            <button class="cookie-consent-btn cookie-consent-btn-decline" id="cookieDecline">Decline</button>
            <button class="cookie-consent-btn cookie-consent-btn-accept" id="cookieAccept">Accept</button>
        </div>
    </div>

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
        // Cookie Consent Banner
        document.addEventListener('DOMContentLoaded', function() {
            const cookieConsent = document.getElementById('cookieConsent');
            const cookieAccept = document.getElementById('cookieAccept');
            const cookieDecline = document.getElementById('cookieDecline');
            const COOKIE_NAME = 'mettacity_cookie_consent';
            const COOKIE_EXPIRY = 365; // days

            // Check if user has already made a choice
            function getCookie(name) {
                const nameEQ = name + "=";
                const cookies = document.cookie.split(';');
                for (let i = 0; i < cookies.length; i++) {
                    let cookie = cookies[i].trim();
                    if (cookie.indexOf(nameEQ) === 0) {
                        return cookie.substring(nameEQ.length);
                    }
                }
                return null;
            }

            function setCookie(name, value, days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                const expires = "expires=" + date.toUTCString();
                document.cookie = name + "=" + value + ";" + expires + ";path=/";
            }

            // Show banner if no cookie exists
            if (!getCookie(COOKIE_NAME)) {
                cookieConsent.classList.add('show');
            }

            // Accept cookies
            cookieAccept.addEventListener('click', function() {
                setCookie(COOKIE_NAME, 'accepted', COOKIE_EXPIRY);
                cookieConsent.classList.remove('show');
                // Load analytics or tracking scripts here if needed
                console.log('Cookies accepted');
            });

            // Decline cookies
            cookieDecline.addEventListener('click', function() {
                setCookie(COOKIE_NAME, 'declined', COOKIE_EXPIRY);
                cookieConsent.classList.remove('show');
                console.log('Cookies declined');
            });
        });
    </script>

    <script>
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
            @if(isset($popupVideo) && $popupVideo && $popupVideo->is_active)
            @php
                $videoFile = $popupVideo->video_file ?? (isset($popupVideo->video_url) && str_starts_with($popupVideo->video_url, 'popup-videos/') ? $popupVideo->video_url : null);
            @endphp
            @if($videoFile)
            const videoPopup = document.getElementById('videoPopup');
            const videoWrapper = document.getElementById('videoPopupWrapper');
            const closeBtn = document.getElementById('closeVideoPopup');
            const VIDEO_SOURCE = '{{ asset('storage/' . $videoFile) }}';
            const DELAY_MS = {{ $popupVideo->delay_seconds * 1000 }};
            let videoElement = null;
            
            // Check if user has seen the video popup before
            const hasSeenPopup = sessionStorage.getItem('videoPopupSeen');
            
            if (!hasSeenPopup && VIDEO_SOURCE) {
                setTimeout(function() {
                    // Create HTML5 video element for local files
                    videoElement = document.createElement('video');
                    videoElement.controls = true;
                    videoElement.playsInline = true;
                    videoElement.setAttribute('playsinline', '');
                    videoElement.style.cssText = 'position: absolute; top: 0; left: 0; width: 100%; height: 100%; border-radius: 16px;';
                    
                    const source = document.createElement('source');
                    source.src = VIDEO_SOURCE;
                    source.type = 'video/mp4';
                    
                    videoElement.appendChild(source);
                    videoWrapper.appendChild(videoElement);
                    
                    videoPopup.classList.add('active');
                    document.body.style.overflow = 'hidden';
                    
                    // Try to play with sound first
                    videoElement.play().then(function() {
                        console.log('Video playing with sound');
                    }).catch(function(error) {
                        console.log('Autoplay with sound blocked, trying muted');
                        // If blocked, mute and try again
                        videoElement.muted = true;
                        videoElement.play().catch(function(err) {
                            console.log('Autoplay failed completely:', err);
                        });
                    });
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
