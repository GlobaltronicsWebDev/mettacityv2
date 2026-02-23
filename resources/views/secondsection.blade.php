<!-- =========================
     STATIC BACKGROUND IMAGES
     These are just decorative background images that sit behind the carousel.
     ========================= -->
<img src="{{ asset('./assets/CAROUSEL.png') }}" alt="Carousel Background" class="carousel-background">
<img src="{{ asset('./assets/CAROUSELBGMOBILE.png') }}" alt="Carousel Background" class="carousel-background-mobile">


<!-- =========================
     SCROLLING BANNER SECTION
     Two scrolling text banners (left + right) that animate in opposite directions.
     aria-hidden="true" means screen readers ignore it (since it’s decorative).
     ========================= -->
<div class="scrolling-banner-wrapper">

  <!-- Left scrolling banner -->
  <div class="scrolling-banner left" aria-hidden="true">
    <div class="track">
      <!-- We repeat the same line twice so the scrolling looks infinite -->
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

  <!-- Right scrolling banner -->
  <div class="scrolling-banner right" aria-hidden="true">
    <div class="track">
      <!-- Same idea: repeat text twice for seamless infinite scroll -->
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


<!-- =========================
     MAIN BANNER TEXT + ENTER BUTTON
     This is your main heading and button overlay on top of everything.
     ========================= -->
<div class="secondbanner">
  <h2>The future of amusement-</h2>
  <h1>Where Culture, Play, and Technology Meet</h1>

  <!-- Laravel route link -->
  <a href="{{ route('enter.metta.city') }}">
    <img src="{{ asset('./assets/ENTER BUTTON.png') }}" alt="Enter Button" class="enter-button">
  </a>
</div>


<!-- =========================
     OVERLAY (darkens or styles the carousel area)
     Usually used for gradients or dark fade effects.
     ========================= -->
<div class="firstmaincarousel-overlay"></div>


<!-- =========================
     IMAGE LIST (hidden, used only for loading textures)
     These images are NOT displayed directly.
     They are read by JS and drawn into a single texture canvas.
     ========================= -->
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


<!-- =========================
     THREE.JS CAROUSEL SCRIPT
     This creates a rotating 3D cylinder that has your images wrapped inside it.
     ========================= -->
<script type="module">
  /* Import Three.js as an ES module from CDN */
  import * as THREE from 'https://cdn.jsdelivr.net/npm/three@0.158/build/three.module.js';

  /* =========================
     SCENE
     The scene is like the "world" where everything exists.
     ========================= */
  const firstmaincarouselScene = new THREE.Scene();

  /* =========================
     CAMERA
     A PerspectiveCamera simulates human eye perspective (objects get smaller far away).
     fov = 50 (field of view)
     aspect = 1 (temporary, updated later)
     near = 0.1 (closest visible distance)
     far = 1000 (farthest visible distance)
     ========================= */
  const firstmaincarouselCamera = new THREE.PerspectiveCamera(
    50,
    1,
    0.1,
    1000
  );

  /* Camera distance from the center of the scene */
  firstmaincarouselCamera.position.z = 2.5;

  /* =========================
     RENDERER
     WebGLRenderer draws the scene into a canvas element.
     antialias = smoother edges
     alpha = transparent background
     ========================= */
  const firstmaincarouselRenderer = new THREE.WebGLRenderer({
    antialias: true,
    alpha: true
  });

  /* Better quality on high DPI devices, but capped for performance */
  firstmaincarouselRenderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

  /* Transparent background */
  firstmaincarouselRenderer.setClearColor(0x000000, 0);

  /* Add the renderer canvas into the page */
  document.body.appendChild(firstmaincarouselRenderer.domElement);

  /* =========================
     LIGHTING
     Ambient light lights everything equally.
     MeshBasicMaterial does NOT require light, but this is harmless.
     ========================= */
  firstmaincarouselScene.add(new THREE.AmbientLight(0xffffff, 1));

  /* =========================
     READ IMAGES FROM HTML
     We grab all images that have [data-carousel-image]
     ========================= */
  const firstmaincarouselImages = [
    ...document.querySelectorAll('[data-carousel-image]')
  ];

  /* =========================
     HELPER: WAIT UNTIL AN IMAGE IS LOADED
     This ensures naturalWidth / naturalHeight is available.
     ========================= */
  function firstmaincarouselLoadImage(imgEl) {
    return new Promise((resolve, reject) => {
      if (imgEl.complete) return resolve(imgEl);
      imgEl.onload = () => resolve(imgEl);
      imgEl.onerror = reject;
    });
  }

  /* =========================
     CREATE ONE LONG TEXTURE CANVAS
     Instead of applying 8 textures separately, we:
     - Draw all images side-by-side on a 2D canvas
     - Convert that canvas into a Three.js texture
     ========================= */
  async function firstmaincarouselCreateTexture() {
    /* Wait for all images to load */
    const images = await Promise.all(
      firstmaincarouselImages.map(firstmaincarouselLoadImage)
    );

    /* Settings for how big images should appear in the texture */
    const TARGET_HEIGHT = 600;  // height of each image inside the texture
    const GAP = 180;            // space between images
    const CANVAS_HEIGHT = 800;  // total canvas height

    /* We calculate the total width needed for all images + gaps */
    let totalWidth = GAP;

    /* For each image:
       - scale it to TARGET_HEIGHT
       - compute the width needed after scaling */
    const drawData = images.map(img => {
      const scale = TARGET_HEIGHT / img.naturalHeight;
      const drawWidth = img.naturalWidth * scale;
      totalWidth += drawWidth + GAP;
      return { img, drawWidth };
    });

    /* Extra gap at the end */
    totalWidth += GAP;

    /* Create canvas with calculated width */
    const canvas = document.createElement('canvas');
    canvas.width = totalWidth;
    canvas.height = CANVAS_HEIGHT;

    /* 2D drawing context */
    const ctx = canvas.getContext('2d');

    /* Draw each image horizontally */
    let x = GAP;
    drawData.forEach(({ img, drawWidth }) => {
      /* Center vertically */
      const y = (CANVAS_HEIGHT - TARGET_HEIGHT) / 2;

      /* Draw the image */
      ctx.drawImage(img, x, y, drawWidth, TARGET_HEIGHT);

      /* Move x forward for next image */
      x += drawWidth + GAP;
    });

    /* Convert canvas into a Three.js texture */
    const texture = new THREE.CanvasTexture(canvas);

    /* Wrap settings:
       - RepeatWrapping allows the texture to repeat seamlessly
       - ClampToEdge prevents vertical wrapping artifacts */
    texture.wrapS = THREE.RepeatWrapping;
    texture.wrapT = THREE.ClampToEdgeWrapping;

    /* Flip direction so it maps correctly inside cylinder */
    texture.repeat.x = -1;

    /* Offset helps align the start of the texture */
    texture.offset.x = 1;

    /* Correct color space for accurate image colors */
    texture.colorSpace = THREE.SRGBColorSpace;

    return texture;
  }

  /* =========================
     CYLINDER GEOMETRY
     Cylinder acts like a 3D "wall" with images inside.
     radiusTop = 6
     radiusBottom = 6
     height = 4
     radialSegments = 128 (smoothness)
     heightSegments = 1
     openEnded = true (no top/bottom caps)
     ========================= */
  const firstmaincarouselGeometry = new THREE.CylinderGeometry(
    6,
    6,
    4,
    128,
    1,
    true
  );

  /* =========================
     MATERIAL
     MeshBasicMaterial shows the texture with no shading.
     side = BackSide so we see the inside of the cylinder.
     transparent = true lets your overlay/background show through.
     ========================= */
  const firstmaincarouselMaterial = new THREE.MeshBasicMaterial({
    side: THREE.BackSide,
    transparent: true
  });

  /* Combine geometry + material into a mesh */
  const firstmaincarouselMesh = new THREE.Mesh(
    firstmaincarouselGeometry,
    firstmaincarouselMaterial
  );

  /* Move the cylinder slightly upward */
  firstmaincarouselMesh.position.y = 0.6;

  /* renderOrder ensures this mesh draws above other items */
  firstmaincarouselMesh.renderOrder = 10;

  /* =========================
     MOBILE FIT FUNCTION
     If screen <= 425px, make carousel smaller + move camera back.
     This keeps it from looking huge on phones.
     ========================= */
  function applyMobileSizing() {
    if (window.innerWidth <= 425) {
      /* Scale down cylinder */
      firstmaincarouselMesh.scale.set(0.65, 0.65, 0.65);

      /* Move camera further back so it still fits */
      firstmaincarouselCamera.position.z = 4.2;

      /* Move cylinder down a bit */
      firstmaincarouselMesh.position.y = 0.2;
    } else {
      /* Reset to desktop settings */
      firstmaincarouselMesh.scale.set(1, 1, 1);
      firstmaincarouselCamera.position.z = 2.5;
      firstmaincarouselMesh.position.y = 0.6;
    }
  }

  /* Add cylinder mesh to the scene */
  firstmaincarouselScene.add(firstmaincarouselMesh);

  /* =========================
     APPLY TEXTURE TO CYLINDER
     We create the long texture and set it as the material map.
     ========================= */
  firstmaincarouselCreateTexture().then(texture => {
    firstmaincarouselMaterial.map = texture;
    firstmaincarouselMaterial.needsUpdate = true;
  });

  /* =========================
     CANVAS SIZE CONTROL
     This is SUPER important for mobile.
     We resize the renderer based on the canvas CSS size,
     not window size.
     ========================= */
  function resizeRendererToCanvas() {
    const canvas = firstmaincarouselRenderer.domElement;

    /* Use the real CSS size */
    const width = canvas.clientWidth;
    const height = canvas.clientHeight;

    /* If canvas has no size yet, skip */
    if (width === 0 || height === 0) return;

    /* Resize renderer without changing CSS */
    firstmaincarouselRenderer.setSize(width, height, false);

    /* Update camera aspect ratio */
    firstmaincarouselCamera.aspect = width / height;
    firstmaincarouselCamera.updateProjectionMatrix();
  }

  /* =========================
     ANIMATION LOOP
     requestAnimationFrame runs ~60fps.
     ========================= */
  function firstmaincarouselAnimate() {
    requestAnimationFrame(firstmaincarouselAnimate);

    /* Apply responsive sizing */
    applyMobileSizing();

    /* Keep renderer + camera in sync with canvas */
    resizeRendererToCanvas();

    /* Rotate the cylinder slowly */
    firstmaincarouselMesh.rotation.y += 0.0015;

    /* Draw scene */
    firstmaincarouselRenderer.render(
      firstmaincarouselScene,
      firstmaincarouselCamera
    );
  }

  /* Start animation */
  firstmaincarouselAnimate();

  /* =========================
     RESIZE EVENT
     When the browser resizes, update the sizing.
     ========================= */
  window.addEventListener('resize', () => {
    applyMobileSizing();
    resizeRendererToCanvas();
  });
</script>

<!-- External JS file for second section -->
<script src="{{ asset('jsfolder/secondsection.js') }}"></script>
