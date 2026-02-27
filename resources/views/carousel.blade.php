        <!-- Carousel -->
    <div id="carouselExampleIndicators" class="carouselslide carousel slide" data-bs-ride="carousel" data-bs-interval="4000" data-bs-touch="true" data-bs-pause="hover">
        @if($carousels->count() > 0)
        <div class="carousel-indicators">
            @foreach($carousels as $index => $carousel)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($carousels as $index => $carousel)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $carousel->image) }}" class="d-block w-100 carousel-img" alt="{{ $carousel->title ?? 'Slide ' . ($index + 1) }}">
                @if($carousel->title || $carousel->description)
                <div class="carousel-caption d-none d-md-block">
                    @if($carousel->title)
                    <h5>{{ $carousel->title }}</h5>
                    @endif
                    @if($carousel->description)
                    <p>{{ $carousel->description }}</p>
                    @endif
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <!-- Fallback to default images if no carousel images uploaded -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('./assets/BANNER.png') }}" class="d-block w-100 B1" alt="Slide 1">
                <img src="{{ asset('./assets/MBANNER 1.png') }}" class="d-block w-100 MB1" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('./assets/BANNER 2.png') }}" class="d-block w-100 B2" alt="Slide 2">
                <img src="{{ asset('./assets/MBANNER 2.png') }}" class="d-block w-100 MB2" alt="Slide 2">
            </div>
        </div>
        @endif
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>