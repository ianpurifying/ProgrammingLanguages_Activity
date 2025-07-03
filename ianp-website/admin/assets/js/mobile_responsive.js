// Mobile menu toggle functionality
document.addEventListener("DOMContentLoaded", function () {
  const mobileMenuBtn = document.getElementById("mobileMenuBtn");
  const mobileMenu = document.getElementById("mobileMenu");
  const menuIcon = mobileMenuBtn.querySelector("i");

  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener("click", function () {
      mobileMenu.classList.toggle("hidden");

      // Toggle icon between hamburger and X
      if (mobileMenu.classList.contains("hidden")) {
        menuIcon.className = "fas fa-bars text-lg";
      } else {
        menuIcon.className = "fas fa-times text-lg";
      }
    });
  }
});
