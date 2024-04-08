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
        // Empêche le comportement par défaut du lien
        event.preventDefault();

        // Récupére toutes les informations à partir des attributs de données
        var avionType = event.target.getAttribute('data-type');
        var avionImgSrc = event.target.src;
        var taux = event.target.getAttribute('data-taux');
        var reductionSemaine = event.target.getAttribute('data-red');
        var immatriculation = event.target.getAttribute('data-im');
        var forfait1 = event.target.getAttribute('data-f1');
        var forfait2 = event.target.getAttribute('data-f2');
        var forfait3 = event.target.getAttribute('data-f3');
        var heuresForfait1 = event.target.getAttribute('data-h1');
        var heuresForfait2 = event.target.getAttribute('data-h2');
        var heuresForfait3 = event.target.getAttribute('data-h3');

        // Construit le tableau des forfaits avec les heures correspondantes
        var forfaitsTable = `
        <table>
            <tr>
                <td style="color : #18f98f ;>Forfait 1 : </td>
                <td style="color : #18f98f ;>${forfait1} pour ${heuresForfait1} heures</td>
            </tr>
            <tr>
                <td style="color : #18f98f ;>Forfait 2 : </td>
                <td style="color : #18f98f ;>${forfait2} pour ${heuresForfait2} heures</td>
            </tr>
            <tr>
                <td style="color : #18f98f ;>Forfait 3 : </td>
                <td style="color : #18f98f ;>${forfait3} pour ${heuresForfait3} heures</td>
            </tr>
        </table>
    `;

        modalImg.src = avionImgSrc;
        modalImg.alt = avionType;
        modalType.textContent = avionType;
        modalTaux.textContent = "Taux: " + taux;
        modalReduction.textContent = "Réduction semaine: " + reductionSemaine;
        modalImmatriculation.textContent = "Immatriculation: " + immatriculation;
        modalForfaits.innerHTML =forfaitsTable;

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