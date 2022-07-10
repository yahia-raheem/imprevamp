import splide from "@splidejs/splide";

if (typeof wp !== "undefined" && typeof wp.data !== "undefined") {
  const { select, subscribe } = wp.data;

  const closeListener = subscribe(() => {
    const isReady = select("core/editor").__unstableIsEditorReady();
    if (!isReady) {
      return;
    }
    closeListener();
    const ticker = setInterval(() => {
      const result = init();
      if (result === true) {
        clearInterval(ticker);
      }
    }, 1000);
  });
} else {
  document.addEventListener("DOMContentLoaded", () => {
    init();
  });
}

const init = () => {
  const sliderSections = document.querySelectorAll("section.home-slider");
  if (sliderSections.length > 0) {
    sliderSections.forEach((section, secIndex) => {
      const sliderEl = section.querySelector(".splide.course-slider");
      const slider = new splide(sliderEl, {
        width: "100%",
        autoplay: false,
        pagination: false,
        interval: 10000,
        rewind: true,
        draggable: false,
        swipeToSlide: false,
        touchMove: false,
        breakpoints: {
          740: {
            draggable: true,
            swipeToSlide: true,
            touchMove: true,
          }
        },
      }).mount();
    });
    return true;
  } else {
    return false;
  }
};
