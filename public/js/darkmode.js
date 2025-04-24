document.addEventListener("DOMContentLoaded", function() {
    const darkModeToggle = document.getElementById("darkModeToggle");
    const darkModeIcon = document.getElementById("darkModeIcon");

    const currentMode = localStorage.getItem("theme") || "light";

    function applyTheme(mode) {
        const isDark = mode === "dark";

        document.body.classList.toggle("bg-dark", isDark);
        document.body.classList.toggle("text-light", isDark);
        document.body.classList.toggle("text-dark", !isDark);

        darkModeIcon.textContent = isDark ? "dark_mode" : "light_mode";

        document.querySelectorAll(".card").forEach(card => {
            card.classList.toggle("bg-secondary", isDark);
            card.classList.toggle("text-light", isDark);
            card.classList.toggle("border-0", isDark);

            card.classList.toggle("bg-white", !isDark);
            card.classList.toggle("text-dark", !isDark);
        })
    }

    applyTheme(currentMode);

    darkModeToggle.addEventListener("click", function() {
        const newMode = (document.body.classList.contains("bg-dark")) ? "light" : "dark";
        localStorage.setItem("theme", newMode);
        applyTheme(newMode);
    })
})
