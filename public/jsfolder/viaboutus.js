  const reelImage = document.querySelector('.reel-image');
  const baseOffset = -800;
  const speed = 0.15;

  window.addEventListener('scroll', () => {
    reelImage.style.transform =
      `translateY(${baseOffset + window.scrollY * -speed}px)`;
  });
  console.log(reelImage);

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