<?php 
if (isset($_SESSION['email']) && isset($_SESSION['mdp'])) {


$compte = ComptesModel::getCom($_SESSION['id']); ?>
<div class="wrapper">
    <div class="container">
        <h1><?php echo CivilModel::Civil($_SESSION['num_civilite']) . $_SESSION['nom'] . " " . $_SESSION['prenom']; ?>:</h1>
    </div>
</div>
<div class="contenu">
    <div class="content-wrapper">
        <div class="info">
            <h2>Vos informations : </h2><br>
            <?php
            echo '-> ' . $_SESSION['nom'] . $_SESSION['prenom'];
            echo '<br>';
            echo '-> ' . $_SESSION['email'];
            echo '<br>';
            echo '-> ' . $_SESSION['adresse'] . $_SESSION['code_postal'] . $_SESSION['ville'];
            echo '<br>';
            echo '-> ' . $_SESSION['tel'];
            ?>
            <br>
            <br>
            <button onclick="ouvrirModal()">Modifier les informations</button>
            <br>
            <br>
        </div>
        <div id="modal" class="modal">
            <div class="modal-content">
                <form action="update.php" method="POST">
                    <h2>Modifier les informations : </h2><br>
                    <input type="text" id="nouveau-nom" name="nouveau-nom" placeholder="Nom" value="<?php echo $_SESSION['nom']; ?>" required><br>
                    <input type="text" id="nouveau-prenom" name="nouveau-prenom" placeholder="Prénom" value="<?php echo $_SESSION['prenom']; ?>" required><br>
                    <input type="email" id="nouveau-email" name="nouveau-email" placeholder="email" value="<?php echo $_SESSION['email']; ?>" required><br>
                    <input type="password" id="nouveau-mdp" name="nouveau-mdp" placeholder="mdp" value="" required><br>
                    <input type="text" id="nouveau-ad" name="nouveau-ad" placeholder="Adresse" value="<?php echo $_SESSION['adresse']; ?>" required><br>
                    <input type="number" id="nouveau-cp" name="nouveau-cp" placeholder="Code_Postal" value="<?php echo $_SESSION['code_postal']; ?>" required><br>
                    <input type="text" id="nouveau-ville" name="nouveau-ville" placeholder="Ville" value="<?php echo $_SESSION['ville']; ?>" required><br>
                    <input type="text" id="nouveau-tel" name="nouveau-tel" placeholder="Tel" value="<?php echo $_SESSION['tel']; ?>" required><br>
                    <button type="submit">Confirmer</button>
                </form>
            </div>
        </div>

        <div class="forfaits">
            <h2>Forfaits restant par avion :</h2><br>
            <?php
            $avions = AvionModel::getAll();
            if ($compte) {
                echo "<table>";
                foreach ($avions as $avion) {
                    echo "<th>{$avion['type']}</th>";
                }
                echo "</tr>";
                foreach ($avions as $avion) {
                    $forfait = $compte[$avion['num_avion']] ?? 0;
                    echo "<td>$forfait</td>";
                }
                echo "</tr>";
                echo "</table>";
            } else {
                echo "Aucun compte trouvé pour cet identifiant.";
            }
            ?>
            <br>
            <h4 style="color: orange;">Pour recharger vos forfaits, veuillez nous contacter !</h4>
        </div>
        <div class="vol">
            <h2>Vos séquences de vols :</h2><br>
            <?php
            $compte = ComptesModel::getCom($_SESSION['id']);
            $seqData = SeqVolModel::getSeqByMem($_SESSION['id']);
            if ($seqData) {
                // Concaténer le début du tableau
                echo'<table>';
                echo'<thead>';
                echo'<tr>';
                echo'<th>N°Seq</th>';
                echo'<th>Avion</th>';
                echo'<th>Date du Vol</th>';
                echo'<th>Durée</th>';
                echo'<th>Instruction</th>';
                echo'<th>Taux</th>';
                echo'<th>Réd. semaine</th>';
                echo'<th>Prix Spé</th>';
                echo'<th>Motif</th>';
                echo'<th>Forfaits</th>';
                echo'<th>Reste</th>';
                echo'<th>Initiation</th>';
                echo'</tr>';
                echo'</thead>';
                echo'<tbody>';

                // Parcourir les données et les ajouter à la variable HTML
                foreach ($seqData as $seq) {
                    $avion = AvionModel::getAvionById($seq['id_av']);
                    $forfait = OpeForModel::getOpeForBySeq($seq['num_seq']);
                    echo'<tr>';
                    echo'<td>' . $seq['num_seq'] . '</td>';
                    echo'<td>' . $avion['type'] . '</td>';
                    echo'<td>' . $seq['date'] . '</td>';
                    echo'<td>' . $seq['temps'] . '</td>';
                    echo'<td>' . $seq['taux_instructeur'] * $seq['taux'] . '</td>';
                    echo'<td>' . $seq['taux'] . '</td>';
                    echo'<td>' . $seq['reduction_semaine'] . '</td>';
                    echo'<td>' . $seq['prix_special'] . '</td>';
                    echo'<td>' . $seq['motif'] . '</td>';
                    echo'<td>' . $forfait['forfait'] . '</td>';
                    echo'<td>' . $forfait['reste'] . '</td>';
                    if ($seq['forfait_initiation']) {
                        echo'<td><input type="checkbox" checked disabled ></td>';
                    } else {
                        echo'<td><input type="checkbox" disabled ></td>';
                    }
                    echo'</tr>';
                }

                // Concaténer la fin du tableau
                echo'</tbody>';
                echo'</table>';
            } else {
                // Si aucune donnée n'a été retournée, ajouter un message approprié à la variable HTML
                "Pas de vol effectué.";
            }
            ?>
        </div>
    </div>
    <br><br>
    <a href="pdf.php">Télécharger la facture</a>
</div>

<script>
// Fonction pour ouvrir la modal de modification
    function ouvrirModal() {
        document.getElementById('modal').style.display = 'block';
    }

// Fonction pour confirmer la modification
    function confirmerModification() {
        document.getElementById('modal-confirm').style.display = 'block';
    }

// Fonction pour annuler la modification
    function annulerModification() {
        document.getElementById('modal-confirm').style.display = 'none';
        document.getElementById('modal').style.display = 'block';
    }
</script>

<?php }
