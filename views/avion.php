<main>
    <div id="card-area">
        <div class="wrapper">
            <div class="box-area">
                <?php $avions = AvionModel::getAll();
                foreach ($avions as $avion) {
                    echo '<div class="box">';
                    echo '<img class="openModal" alt="" src="/asset/'.$avion['num_avion'].'.jpg" data-type="' . $avion['type'] . '" data-taux="' . $avion['taux'] . '"
                    data-f1="' . $avion['forfait1'] . '" data-f2="' . $avion['forfait2'] . '"data-f3="' . $avion['forfait3'] . '" data-f2="' . $avion['forfait2'] . '"
                    data-h1="' . $avion['heures_forfait1'] . '"data-h2="' . $avion['heures_forfait2'] . '"data-h3="' . $avion['heures_forfait3'] . '"
                    data-red="' . $avion['reduction_semaine'] . '"data-im="' . $avion['immatriculation'] . '">';
                    echo '</div>';
                } ?>
            </div>
        </div>
    </div>
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-info">
                <img id="modalImg" class="modal-img" src="" alt="">
                <div class="modal-details">
                    <h2 id="modalType"></h2>
                    <p id="modalTaux"></p>
                    <p id="modalReduction"></p>
                    <p id="modalImmatriculation"></p>
                    <div id="modalForfaits"></div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="/js/avion.js"></script>