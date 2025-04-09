// Define SVG icons
const sunIcon = `
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-sun-fill" viewBox="0 0 16 16">
  <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 0a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1-.707.707L13.657 11.3a.5.5 0 0 1 0-.707m-9.193-9.193a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1-.707.707L3.05 2.343a.5.5 0 0 1 0-.707"/>
</svg>
`;

const moonIcon = `
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-moon-stars-fill" viewBox="0 0 16 16">
  <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278"/>
  <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162h1.234a.217.217 0 0 1 .158.37l-1 .725.387 1.162a.217.217 0 0 1-.328.218L12 8.268l-1 .724a.217.217 0 0 1-.328-.218l.387-1.162-1-.724a.217.217 0 0 1 .158-.37h1.234zM13.794 7.148a.217.217 0 0 1 .412 0l.387 1.162h1.234a.217.217 0 0 1 .158.37l-1 .725.387 1.162a.217.217 0 0 1-.328.218L16 12.268l-1 .724a.217.217 0 0 1-.328-.218l.387-1.162-1-.724a.217.217 0 0 1 .158-.37h1.234z"/>
</svg>
`;

// Find all theme toggle buttons using the class
const themeToggleButtons = document.querySelectorAll(".theme-toggle-trigger");
const body = document.body;

// Function to update icons on all buttons
const updateButtonIcons = (theme) => {
    themeToggleButtons.forEach((btn) => {
        btn.innerHTML = theme === "light" ? moonIcon : sunIcon;
        btn.title =
            theme === "light" ? "Switch to dark mode" : "Switch to light mode";
    });
};

// Check for saved theme preference or default to dark
let currentTheme = localStorage.getItem("theme") || "dark";
body.classList.toggle("light-theme", currentTheme === "light");
updateButtonIcons(currentTheme); // Set initial icons

// Add click listener to each button
themeToggleButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
        body.classList.toggle("light-theme");
        currentTheme = body.classList.contains("light-theme")
            ? "light"
            : "dark";
        localStorage.setItem("theme", currentTheme); // Save preference
        updateButtonIcons(currentTheme); // Update icons on all buttons
    });
});

// Exporting something (even if null) signals the module has loaded
export default null;
