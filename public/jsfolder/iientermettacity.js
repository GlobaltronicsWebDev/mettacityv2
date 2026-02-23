
  function setupMarquee() {
    const track = document.getElementById("marqueeTrack");
    const set = document.getElementById("marqueeSet");
    if (!track || !set) return;

    // Remove old clones (keep the first set)
    [...track.children].forEach((child, i) => {
      if (i > 0) child.remove();
    });

    // Measure one set width
    const setWidth = set.getBoundingClientRect().width;

    // Clone until track is at least 2x viewport width (prevents blanks)
    const viewportWidth = window.innerWidth;
    const needed = Math.ceil((viewportWidth * 2) / setWidth);

    for (let i = 0; i < needed; i++) {
      const clone = set.cloneNode(true);
      clone.removeAttribute("id");
      clone.setAttribute("aria-hidden", "true");
      track.appendChild(clone);
    }

    // Set exact distance for seamless looping (one-set width)
    track.style.setProperty("--marquee-distance", `${setWidth}px`);

    // Optional: auto adjust speed based on width (feels consistent)
    // bigger setWidth = longer duration
    const duration = Math.max(10, Math.min(22, setWidth / 60));
    track.style.setProperty("--marquee-duration", `${duration}s`);
  }

  window.addEventListener("load", setupMarquee);
  window.addEventListener("resize", setupMarquee);


  // ZONE CARDS
  
   (function () {
    const isHoverDevice = window.matchMedia("(hover: hover) and (pointer: fine)").matches;
    if (isHoverDevice) return;

    document.addEventListener("pointerup", (e) => {
      const card = e.target.closest(".zone-card.has-overlay");
      const active = document.querySelector(".zone-card.has-overlay.is-active");

      if (!card) {
        if (active) active.classList.remove("is-active");
        return;
      }

      const href = card.getAttribute("href");

      // first tap -> open overlay (prevent navigation)
      if (!card.classList.contains("is-active")) {
        e.preventDefault();
        if (active) active.classList.remove("is-active");
        card.classList.add("is-active");
        return;
      }

      // second tap -> follow link
      if (!href || href === "#") {
        e.preventDefault();          // still prevent jump if it's #
        card.classList.remove("is-active");
        return;
      }

      window.location.href = href;  // go to real link
    }, { passive: false });
  })();

  // IntersectionObserver for statement-section visibility
  document.addEventListener("DOMContentLoaded", function () {
    const section = document.querySelector(".statement-section");
    if (!section) return;

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
          } else {
            entry.target.classList.remove("is-visible");
          }
        });
      },
      { threshold: 0.1 }
    );

    observer.observe(section);
  });

  