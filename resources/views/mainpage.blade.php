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
    <link rel="stylesheet" href="{{ asset('cssfolder/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('cssfolder/carousel.css') }}"> 
    <link rel="stylesheet" href="{{ asset('cssfolder/secondsection.css?v=3') }}"> 
    <link rel="stylesheet" href="{{ asset('cssfolder/thirdsection.css') }}"> 
    <link rel="stylesheet" href="{{ asset('cssfolder/fourthsection.css') }}">
    <link rel="stylesheet" href="{{ asset('cssfolder/footer.css') }}">

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
</head>

<body>

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
