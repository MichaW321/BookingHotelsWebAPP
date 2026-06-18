window.addEventListener("scroll", function () {
  const footer = document.querySelector(".footer");
  if (window.scrollY > 200) {
    footer.classList.add("footer-visible");
  } else {
    footer.classList.remove("footer-visible");
  }
});
