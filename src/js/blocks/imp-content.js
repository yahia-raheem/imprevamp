import { wpEditorDone } from "../components/helper-funcs";

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

wpEditorDone(3, init);