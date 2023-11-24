'use strict';

// Selecting the necessary elements
const nav = document.querySelector('.navbar-nav');
const navLinks = document.querySelectorAll('.nav-link');
const navToggleBtn = document.querySelector('.menu-toggle-btn');

// Adding event listener to the menu toggle button
navToggleBtn.addEventListener('click', function () {
  // Toggling the 'active' class on the navigation menu
  nav.classList.toggle('active');
});

// Adding event listeners to each navigation link
for (let i = 0; i < navLinks.length; i++) {
  navLinks[i].addEventListener('click', function () {
    // Removing the 'active' class from the navigation menu
    nav.classList.remove('active');
  });
}
