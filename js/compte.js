    // Sélection des éléments nécessaires
    var openModalLinks = document.getElementsByClassName("openModal");
    var modal = document.getElementById("modal");
    var modalContent = document.querySelector(".modal-content");
    var closeModalBtn = document.querySelector(".close");
    var modalImg = document.getElementById("modalImg");
    var modalType = document.getElementById("modalType");
    var modalTaux = document.getElementById("modalTaux");
    var modalReduction = document.getElementById("modalReduction");
    var modalImmatriculation = document.getElementById("modalImmatriculation");
    var modalForfaits = document.getElementById("modalForfaits");

    // Fonction pour ouvrir la modal
    function openModal(event) {
        // Empêcher le comportement par défaut du lien
        event.preventDefault();
        modal.style.display = "block";

        closeModalBtn.addEventListener("click", closeModal);
    }

    function closeModal() {
        modal.style.display = "none";
    }


    for (var i = 0; i < openModalLinks.length; i++) {
        openModalLinks[i].addEventListener("click", openModal);
    }

    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            closeModal();
        }
    });