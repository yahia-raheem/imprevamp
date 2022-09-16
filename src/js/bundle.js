// Components
import "./components/sidebar.js";
// Blocks
import "./blocks/home-slider.js";
import "./blocks/accordion.js";
import "./blocks/clients-slider.js";
import "./blocks/imp-content.js";
import "./paymob/paymob.js";
import "../../node_modules/bootstrap/js/dist/tab.js"

document.addEventListener("DOMContentLoaded", () => {
    //payment-open
    const LangAction = document.querySelector(".imp-language-action");
    const Langmenu = document.querySelector(".imp-language-menu");

    // Lang Button
    if (LangAction !== null) {
        LangAction.addEventListener("click", (e) => {
            e.preventDefault();
            Langmenu.classList.toggle("active");
        });
    }
});