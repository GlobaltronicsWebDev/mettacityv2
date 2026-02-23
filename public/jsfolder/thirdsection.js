const thirdStack = document.getElementById("thirdStack");
  const thirdCaption = document.getElementById("thirdCaption");
  const thirdIndicators = document.getElementById("thirdIndicators");
  const thirdPrevBtn = document.getElementById("thirdPrevBtn");
  const thirdNextBtn = document.getElementById("thirdNextBtn");

  const thirdCards = [...thirdStack.children];
  const thirdData = thirdCards.map(card => ({
    label: card.dataset.label
  }));

  let thirdIndex = 0;
  let thirdAutoInterval = null;
  let thirdResumeTimeout = null;
  const thirdDelay = 5000;
  let thirdPausedByVisibility = false;

  thirdData.forEach((_, i) => {
    const dot = document.createElement("div");
    dot.className = "third-dot";
    dot.addEventListener("click", () => {
      thirdIndex = i;
      thirdUpdate();
      thirdPauseAndResume();
    });
    thirdIndicators.appendChild(dot);
  });

  function thirdUpdate() {
    const dots = [...thirdIndicators.children];
    const total = thirdCards.length;

    thirdCards.forEach((card, i) => {
      card.className = "third-card";
      const diff = (i - thirdIndex + total) % total;

      if (diff === 0) card.classList.add("third-active");
      else if (diff === 1) card.classList.add("third-right1");
      else if (diff === 2) card.classList.add("third-right2");
      else if (diff === total - 1) card.classList.add("third-left1");
      else if (diff === total - 2) card.classList.add("third-left2");
      else card.style.transform = "translate(-50%, -50%) scale(0)";
    });

    dots.forEach((dot, i) => {
      dot.classList.toggle("third-active-dot", i === thirdIndex);
    });

    thirdCaption.textContent = thirdData[thirdIndex].label;
  }

  function thirdNext() {
    thirdIndex = (thirdIndex + 1) % thirdData.length;
    thirdUpdate();
  }

  function thirdPrev() {
    thirdIndex = (thirdIndex - 1 + thirdData.length) % thirdData.length;
    thirdUpdate();
  }

  function thirdStartAuto() {
    thirdStopAuto();
    thirdAutoInterval = setInterval(thirdNext, thirdDelay);
  }

  function thirdStopAuto() {
    if (thirdAutoInterval) clearInterval(thirdAutoInterval);
    thirdAutoInterval = null;
  }

  function thirdPauseAndResume() {
    thirdStopAuto();
    clearTimeout(thirdResumeTimeout);
    thirdResumeTimeout = setTimeout(() => {
      if (!thirdPausedByVisibility) thirdStartAuto();
    }, thirdDelay);
  }

  document.addEventListener("visibilitychange", () => {
    if (document.hidden) {
      thirdPausedByVisibility = true;
      thirdStopAuto();
    } else {
      thirdPausedByVisibility = false;
      thirdStartAuto();
    }
  });

  thirdPrevBtn.onclick = () => {
    thirdPrev();
    thirdPauseAndResume();
  };

  thirdNextBtn.onclick = () => {
    thirdNext();
    thirdPauseAndResume();
  };

  thirdUpdate();
  thirdStartAuto();