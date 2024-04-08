document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("contactForm");

    form.addEventListener("submit", function(event) {
        // Empêche la soumission du formulaire par défaut
        event.preventDefault();

        // Vérifie si tous les champs requis sont valides
        if (form.checkValidity()) {
            // Si les champs sont valides, cachez le formulaire
            form.style.display = "none";
        }
    });
});
