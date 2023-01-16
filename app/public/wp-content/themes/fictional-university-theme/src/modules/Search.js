class Search {
  // 1. Describe and create/initiate our object
  constructor() {
    this.addSearchHTML();
    this.resultsDiv = document.getElementById("search-overlay__results");
    this.openButtons = document.querySelectorAll(".js-search-trigger");
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.searchField = document.getElementById("search-term");
    this.typingTimer;
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue;

    this.events();
  }

  // 2. Events
  events() {
    this.addSearchHTML();
    this.openButtons.forEach((button) =>
      button.addEventListener("click", this.openOverlay.bind(this))
    );
    this.closeButton.addEventListener("click", this.closeOverlay.bind(this));
    document.addEventListener("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.addEventListener("keyup", this.typingLogic.bind(this));
  }

  // 3. Methods
  typingLogic(event) {
    const inputValue = event.target.value;

    if (inputValue === this.previousValue) {
      return;
    }

    if (!inputValue) {
      this.resultsDiv.innerHTML = "";
      this.isSpinnerVisible = false;
      return;
    }

    if (!this.isSpinnerVisible) {
      this.resultsDiv.innerHTML = '<div class="spinner-loader"></div>';
      this.isSpinnerVisible = true;
    }

    clearInterval(this.typingTimer);
    this.typingTimer = setTimeout(async () => {
      this.isSpinnerVisible = false;
      console.log("calling getResults");
      const results = await this.getResults(inputValue);
      console.log({ results });
      this.resultsDiv.innerHTML = `
        <h2 class="search-overlay__section-title">General Information</h2>
        ${results}
      `;
    }, 750);

    this.previousValue = inputValue;

    event.stopPropagation();
  }

  async getResults(searchTerm) {
    const response = await fetch(`/wp-json/wp/v2/posts?search=${searchTerm}`, {
      headers: {
        "Content-Type": "application/json",
      },
    });
    const results = await response.json();

    if (!results.length) {
      return `<p>No general information matches that search.</p>`;
    }

    return `
      <ul class="link-list min-list">
        ${results
          .map(
            ({ link, title: { rendered } }) =>
              `<li><a href="${link}">${rendered}</a></li>`
          )
          .join("")}
      </ul>`;
  }

  openOverlay() {
    this.searchOverlay.classList.add("search-overlay--active");
    document.body.classList.add("body-no-scroll");
    this.searchField.value = "";
    setTimeout(() => this.searchField.focus(), 301);
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

  addSearchHTML() {
    document.body.insertAdjacentHTML(
      "beforeend",
      `
      <div class="search-overlay">
          <div class="search-overlay__top">
              <div class="container">
                  <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
                  <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term" autocomplete="off">
                  <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
              </div>
          </div>
          <div class="container">
              <div id="search-overlay__results"></div>
          </div>
      </div>
      `
    );
  }
}

export default Search;
