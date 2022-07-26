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
  const innerHeaderSection = document.querySelectorAll("section.imp-content");
  if (innerHeaderSection.length > 0) {
    innerHeaderSection.forEach((one) => {
      const paddingTop = one.getAttribute("data-padding-top");
      const paddingBottom = one.getAttribute("data-padding-bottom");
      one.style.setProperty("--elm-ptop", paddingTop);
      one.style.setProperty("--elm-pbottom", paddingBottom);
    });
    return true;
  } else {
    return false;
  }
};
