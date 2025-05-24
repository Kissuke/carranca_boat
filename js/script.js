const hamburger = document.getElementById("hamburger");
const navList = document.getElementById("nav-list");

hamburger.addEventListener("click", (e) => {
  navList.classList.toggle("active");
  e.stopPropagation();
});

document.addEventListener("click", (e) => {
  if (
    navList.classList.contains("active") &&
    !navList.contains(e.target) &&
    e.target !== hamburger
  ) {
    navList.classList.remove("active");
  }
});
