
  document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
      button.parentElement.classList.toggle('active');
    });
  });

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