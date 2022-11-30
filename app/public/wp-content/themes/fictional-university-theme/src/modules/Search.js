class Search {
  // 1. Describe and create/initiate our object
  constructor() {
    this.openButton = document.querySelector(
      ".search-trigger.js-search-trigger"
    );
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.events();
    this.isOverlayOpen = false;
  }

  // 2. Events
  events() {
    this.openButton.addEventListener("click", this.openOverlay.bind(this));
    this.closeButton.addEventListener("click", this.closeOverlay.bind(this));
    document.addEventListener("keydown", this.keyPressDispatcher.bind(this));
  }

  // 3. Methods
  openOverlay() {
    this.searchOverlay.classList.add("search-overlay--active");
    document.body.classList.add("body-no-scroll");
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.classList.remove("search-overlay--active");
    document.body.classList.remove("body-no-scroll");
    this.isOverlayOpen = false;
  }

  keyPressDispatcher(event) {
    if (event.code === "KeyS" && !this.isOverlayOpen) {
      this.openOverlay();
    }
    if (event.code === "Escape" && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }
}

export default Search;
