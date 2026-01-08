import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


















document.addEventListener("DOMContentLoaded", () => {
    const toggle = document.getElementById("themeToggle");
    const html = document.documentElement;

    // Load saved theme
    if (localStorage.getItem("theme") === "dark") {
        html.classList.add("dark");
    }

    toggle?.addEventListener("click", () => {
        html.classList.toggle("dark");

        if (html.classList.contains("dark")) {
            localStorage.setItem("theme", "dark");
        } else {
            localStorage.setItem("theme", "light");
        }
    });
});
