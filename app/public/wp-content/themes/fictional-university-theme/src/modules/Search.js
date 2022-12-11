class Search {
  // 1. Describe and create/initiate our object
  constructor() {
    this.openButton = document.querySelector(".js-search-trigger");
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.searchField = document.querySelector("#search-term");
    this.typingTimer;
    this.isOverlayOpen = false;
    
    this.events();
  }

  // 2. Events
  events() {
    this.openButton.addEventListener("click", this.openOverlay.bind(this));
    this.closeButton.addEventListener("click", this.closeOverlay.bind(this));
    document.addEventListener("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.addEventListener("keydown", this.typingLogic.bind(this));
  }

  // 3. Methods
  typingLogic(event) {
    clearInterval(this.typingTimer);

    this.typingTimer = setTimeout(() => {
      console.log("doSearch");
    }, 500);

    event.preventDefault();
    event.stopPropagation();
  }

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
