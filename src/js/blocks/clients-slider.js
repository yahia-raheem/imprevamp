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
  const sliderSections = document.querySelectorAll("section.clients-slider");
  if (sliderSections.length > 0) {
    sliderSections.forEach((section, secIndex) => {
      const sliderEl = section.querySelector(".splide.clients-slider");
      const slider = new splide(sliderEl, {
        width: "100%",
        autoplay: true,
        pagination: false,
        interval: 10000,
        arrows: false,
        perPage: 6,
        perMove: 1,
        rewind: true,
        draggable: true,
        swipeToSlide: false,
        touchMove: false,
        breakpoints: {
          992: {
            draggable: true,
            swipeToSlide: true,
            touchMove: true,
            perPage: 4,
          },
          740: {
            perPage: 3,
          },
          500: {
            perPage: 2,
          },
        },
      }).mount();
    });
    return true;
  } else {
    return false;
  }
};
