import splide from "@splidejs/splide";
import { wpEditorDone } from "../components/helper-funcs.js";


const init = () => {
  const sliderSections = document.querySelectorAll("section.home-slider");
  if (sliderSections.length > 0) {
    sliderSections.forEach((section, secIndex) => {
      const sliderEl = section.querySelector(".splide.course-slider");
      const slider = new splide(sliderEl, {
        width: "100%",
        autoplay: false,
        pagination: false,
        rewind: true,
        draggable: false,
        swipeToSlide: false,
        direction: 'rtl',
        touchMove: false,
        breakpoints: {
          992: {
            draggable: true,
            swipeToSlide: true,
            touchMove: true,
            arrows: false,
            autoplay: true,
            interval: 5000,
          },
        },
      }).mount();
    });
    return true;
  } else {
    return false;
  }
};

wpEditorDone(3, init);