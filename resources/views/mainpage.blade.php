<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- ❌ Disable zoom -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Mettacity</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="{{ asset('cssfolder/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('cssfolder/carousel.css') }}"> 
    <link rel="stylesheet" href="{{ asset('cssfolder/secondsection.css') }}"> 
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
    </style>
</head>

<body>

    @include('navbar')
    @include('carousel')
    @include('secondsection')
    @include('thirdsection')
    @include('fourthsection')
    @include('footer')

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

</body>
</html>
