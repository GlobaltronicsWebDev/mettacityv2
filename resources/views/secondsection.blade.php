    <!-- Static background images under carousel -->
    <img src="{{ asset('./assets/CAROUSEL.png') }}" alt="Carousel Background" class="carousel-background">
    <img src="{{ asset('./assets/CAROUSELBGMOBILE.png') }}" alt="Carousel Background" class="carousel-background-mobile">

    <!-- SCROLLING BANNER -->
    <div class="scrolling-banner-wrapper">
        <div class="scrolling-banner left" aria-hidden="true">
            <div class="track">
                <p>
                    <span class="technology">TECHNOLOGY</span> • 
                    <span class="play">PLAY</span> • 
                    <span class="culture">CULTURE</span> • 
                    <span class="technology">TECHNOLOGY</span> • 
                    <span class="play">PLAY</span> • 
                    <span class="culture">CULTURE</span>
                </p>
                <p>
                    <span class="technology">TECHNOLOGY</span> • 
                    <span class="play">PLAY</span> • 
                    <span class="culture">CULTURE</span> • 
                    <span class="technology">TECHNOLOGY</span> • 
                    <span class="play">PLAY</span> • 
                    <span class="culture">CULTURE</span>
                </p>
            </div>
        </div>

        <div class="scrolling-banner right" aria-hidden="true">
            <div class="track">
                <p>
                    <span class="technology">TECHNOLOGY</span> • 
                    <span class="play">PLAY</span> • 
                    <span class="culture">CULTURE</span> • 
                    <span class="technology">TECHNOLOGY</span> • 
                    <span class="play">PLAY</span> • 
                    <span class="culture">CULTURE</span>
                </p>
                <p>
                    <span class="technology">TECHNOLOGY</span> • 
                    <span class="play">PLAY</span> • 
                    <span class="culture">CULTURE</span> • 
                    <span class="technology">TECHNOLOGY</span> • 
                    <span class="play">PLAY</span> • 
                    <span class="culture">CULTURE</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Banner Text -->
    <div class="secondbanner">
        <h2>The future of amusement-</h2>
        <h1>Where Culture, Play, and Technology Meet</h1>
        <a href="{{ route('enter.metta.city') }}"><img src="{{ asset('./assets/ENTER BUTTON.png') }}" alt="Enter Button" class="enter-button"></a>
    </div>

    <!-- Main Carousel -->

  <div class="firstmaincarousel-overlay"></div>

  <div class="firstmaincarousel-images">
    <img src="{{ asset('assets/AFRICAN SAVANNAH.png') }}" data-carousel-image />
    <img src="{{ asset('assets/BIUBIU GUN GOD.png') }}" data-carousel-image />
    <img src="{{ asset('assets/DOOMSDAY HURRICANE.png') }}" data-carousel-image />
    <img src="{{ asset('assets/FLYING CINEM.png') }}" data-carousel-image />
    <img src="{{ asset('assets/METTACITY.png') }}" data-carousel-image />
    <img src="{{ asset('assets/NORTH AND SOUTH POLES.png') }}" data-carousel-image />
    <img src="{{ asset('assets/SEAWORLD.png') }}" data-carousel-image />
    <img src="{{ asset('assets/XR INFINITE SPACE.png') }}" data-carousel-image />
  </div>

  <script type="module">
    import * as THREE from 'https://cdn.jsdelivr.net/npm/three@0.158/build/three.module.js';

    /* ================= SCENE ================= */
    const firstmaincarouselScene = new THREE.Scene();

    /* ================= CAMERA ================= */
    const firstmaincarouselCamera = new THREE.PerspectiveCamera(
      50,
      window.innerWidth / window.innerHeight,
      0.1,
      1000
    );

    firstmaincarouselCamera.position.z = 2.5;

    /* ================= RENDERER ================= */
    const firstmaincarouselRenderer = new THREE.WebGLRenderer({
      antialias: true,
      alpha: true
    });

    firstmaincarouselRenderer.setSize(window.innerWidth, window.innerHeight);
    firstmaincarouselRenderer.setPixelRatio(
      Math.min(window.devicePixelRatio, 2)
    );
    firstmaincarouselRenderer.setClearColor(0x000000, 0);

    document.body.appendChild(firstmaincarouselRenderer.domElement);

    /* ================= LIGHT ================= */
    firstmaincarouselScene.add(
      new THREE.AmbientLight(0xffffff, 1)
    );

    /* ================= READ IMAGES ================= */
    const firstmaincarouselImages = [
      ...document.querySelectorAll('[data-carousel-image]')
    ];

    function firstmaincarouselLoadImage(imgEl) {
      return new Promise((resolve, reject) => {
        if (imgEl.complete) return resolve(imgEl);
        imgEl.onload = () => resolve(imgEl);
        imgEl.onerror = reject;
      });
    }

    async function firstmaincarouselCreateTexture() {
      const images = await Promise.all(
        firstmaincarouselImages.map(firstmaincarouselLoadImage)
      );

      const TARGET_HEIGHT = 600;
      const GAP = 180;
      const CANVAS_HEIGHT = 800;

      let totalWidth = GAP;

      const drawData = images.map(img => {
        const scale = TARGET_HEIGHT / img.naturalHeight;
        const drawWidth = img.naturalWidth * scale;
        totalWidth += drawWidth + GAP;
        return { img, drawWidth };
      });

      totalWidth += GAP;

      const canvas = document.createElement('canvas');
      canvas.width = totalWidth;
      canvas.height = CANVAS_HEIGHT;

      const ctx = canvas.getContext('2d');

      let x = GAP;
      drawData.forEach(({ img, drawWidth }) => {
        const y = (CANVAS_HEIGHT - TARGET_HEIGHT) / 2;
        ctx.drawImage(img, x, y, drawWidth, TARGET_HEIGHT);
        x += drawWidth + GAP;
      });

      const texture = new THREE.CanvasTexture(canvas);
      texture.wrapS = THREE.RepeatWrapping;
      texture.wrapT = THREE.ClampToEdgeWrapping;
      texture.repeat.x = -1;
      texture.offset.x = 1;
      texture.colorSpace = THREE.SRGBColorSpace;

      return texture;
    }

    /* ================= CYLINDER ================= */
    const firstmaincarouselGeometry = new THREE.CylinderGeometry(
      6,
      6,
      4,
      128,
      1,
      true
    );

    const firstmaincarouselMaterial = new THREE.MeshBasicMaterial({
      side: THREE.BackSide,
      transparent: true
    });

    const firstmaincarouselMesh = new THREE.Mesh(
      firstmaincarouselGeometry,
      firstmaincarouselMaterial
    );

    firstmaincarouselMesh.position.y = 0.6;
    firstmaincarouselMesh.renderOrder = 10;

    firstmaincarouselScene.add(firstmaincarouselMesh);

    /* ================= APPLY TEXTURE ================= */
    firstmaincarouselCreateTexture().then(texture => {
      firstmaincarouselMaterial.map = texture;
      firstmaincarouselMaterial.needsUpdate = true;
    });

    /* ================= ANIMATION ================= */
    function firstmaincarouselAnimate() {
      requestAnimationFrame(firstmaincarouselAnimate);
      firstmaincarouselMesh.rotation.y += 0.0015;
      firstmaincarouselRenderer.render(
        firstmaincarouselScene,
        firstmaincarouselCamera
      );
    }

    firstmaincarouselAnimate();

    /* ================= RESIZE ================= */
    window.addEventListener('resize', () => {
      firstmaincarouselCamera.aspect =
        window.innerWidth / window.innerHeight;

      firstmaincarouselCamera.updateProjectionMatrix();
      firstmaincarouselRenderer.setSize(
        window.innerWidth,
        window.innerHeight
      );
    });
  </script>



<script src="{{ asset('jsfolder/secondsection.js') }}"></script>

