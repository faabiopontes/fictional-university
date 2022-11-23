class Search {
  // 1. Describe and create/initiate our object
  constructor() {
    this.openButton = document.querySelector(".search-trigger.js-search-trigger");
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.events();
  }

  // 2. Events
  events() {
    console.log("events");
    debugger;
    this.openButton.addEventListener('click', this.openOverlay.bind(this));
    this.closeButton.addEventListener('click', this.closeOverlay.bind(this));
  }

  // 3. Methods
  openOverlay() {
    console.log("openOverlay");
    this.searchOverlay.classList.add("search-overlay--active");
  }

  closeOverlay() {
    console.log("closeOverlay");
    this.searchOverlay.classList.remove("search-overlay--active");
  }
}

export default Search;
