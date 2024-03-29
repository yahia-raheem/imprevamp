let isOpen = false;
const sideBar = document.getElementById("wkSideNar");
document.addEventListener("DOMContentLoaded", () => {
  if (sideBar !== null) {
    const togglebtn = document.querySelector(".imp-side-menu-icon");
    const closebtn = document.querySelector(".imp-close-button");
    const sidemenuItems = document.querySelectorAll(".fullscreen-menu-wrap .menu-item");

    sidemenuItems.forEach((item) => {
      item.addEventListener("click", (e) => {
        e.stopPropagation();
        if (item.classList.contains("menu-item-has-children")) {
          const submenu = item.querySelector(".sub-menu");
          if (submenu.classList.contains("opened")) {
            item.classList.remove("child-menu-opened");
            submenu.classList.remove("opened");
            submenu.style.maxHeight = 0;
            openMenu();
          } else {
            item.classList.add("child-menu-opened");
            submenu.classList.add("opened");
            submenu.style.maxHeight = `${submenu.scrollHeight}px`;
            openMenu();
          }
        }
      });
    });

    togglebtn.addEventListener("click", () => {
      openNav();
      document.addEventListener("click", outsideClickListener);
      setTimeout(() => {
        isOpen = true;
      }, 1000);
    });
    closebtn.addEventListener("click", () => {
      closeNav();
    });

  }
});

const openNav = () => {
  sideBar.style.width = "100vw";
  sideBar.classList.add("sidebar-open");
  hideBodyScroll();
};

const closeNav = () => {
  sideBar.style.width = "0";
  isOpen = false;
  sideBar.classList.remove("sidebar-open");
  removeClickListener();
  retrieveBodyScroll();
};

const hideBodyScroll = () => {
  document.body.style.overflow = "hidden";
};

const retrieveBodyScroll = () => {
  document.body.style.overflow = "auto";
};
const outsideClickListener = (event) => {
  if (!sideBar.contains(event.target) && isOpen) {
    closeNav();
  }
};

const removeClickListener = () => {
  document.removeEventListener("click", outsideClickListener);
};
