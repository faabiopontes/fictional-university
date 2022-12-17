class Search {
  // 1. Describe and create/initiate our object
  constructor() {
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
    this.openButtons.forEach((button) =>
      button.addEventListener("click", this.openOverlay.bind(this))
    );
    this.closeButton.addEventListener("click", this.closeOverlay.bind(this));
    document.addEventListener("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.addEventListener("keyup", this.typingLogic.bind(this));
  }

  // 3. Methods
  typingLogic(event) {
    clearInterval(this.typingTimer);
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

    this.typingTimer = setTimeout(async () => {
      this.isSpinnerVisible = false;
      console.log("calling getResults");
      const results = await this.getResults(inputValue);
      console.log({ results });
      this.resultsDiv.innerHTML = results[0].title.rendered;
    }, 1500);

    this.previousValue = inputValue;

    event.stopPropagation();
  }

  async getResults(searchTerm) {
    const response = await fetch(`/wp-json/wp/v2/posts?search=${searchTerm}`, {
      headers: {
        "Content-Type": "application/json",
      },
    });
    return response.json();
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
