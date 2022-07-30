import { wpEditorDone } from "../components/helper-funcs";

const init = () => {
    const multiplier = document.querySelectorAll("[data-multiplier]");
    if (multiplier.length > 0) {
        multiplier.forEach((one) => {
            const number = one.getAttribute("data-multiplier");
            one.style.removeProperty("height");
            one.style.setProperty("--elm-multiplier", `${number}px`);
        });
        return true;
    } else {
        return false;
    }
};

wpEditorDone(3, init)
