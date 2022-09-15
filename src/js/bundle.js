// Components
import "./components/sidebar";
// Blocks
import "./blocks/home-slider";
import "./blocks/accordion";
import "./blocks/clients-slider";
import "./blocks/imp-content";
import "./paymob/paymob";
import "../../node_modules/bootstrap/js/dist/tab"

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