<?php

require_once 'model.php';

// Include the main TCPDF library (search for installation path).
require_once('TCPDF-main/tcpdf.php');
if (isset($_SESSION['email']) && isset($_SESSION['mdp'])) {
// create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('');
    $pdf->SetSubject('Facture');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins (adjust as needed)
    $pdf->SetMargins(1, 2, 3); // Left, Top, Right
// set header margin (if needed)
    $pdf->SetHeaderMargin(5); // Header margin
// set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set default font subsetting mode
    $pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
    $pdf->AddPage();

// set text shadow effect
    $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

    //Création de table des vols avec forfait
    $vol_forfait = '';

    $compte = ComptesModel::getCom($_SESSION['id']);
    $seqData = SeqVolModel::getSeqByMem($_SESSION['id']);
    if ($seqData) {
        // Concaténe le début du tableau
        $vol_forfait .= '<table>';
        $vol_forfait .= '<thead>';
        $vol_forfait .= '<tr>';
        $vol_forfait .= '<th>N°Seq</th>';
        $vol_forfait .= '<th>Avion</th>';
        $vol_forfait .= '<th>Date du Vol</th>';
        $vol_forfait .= '<th>Durée</th>';
        $vol_forfait .= '<th>Instruction</th>';
        $vol_forfait .= '<th>Taux</th>';
        $vol_forfait .= '<th>Réd. semaine</th>';
        $vol_forfait .= '<th>Prix Spé</th>';
        $vol_forfait .= '<th>Motif</th>';
        $vol_forfait .= '<th>Forfaits</th>';
        $vol_forfait .= '<th>Reste</th>';
        $vol_forfait .= '<th>Initiation</th>';
        $vol_forfait .= '</tr>';
        $vol_forfait .= '</thead>';
        $vol_forfait .= '<tbody>';

        // Parcour les données et les ajoute à la variable HTML
        foreach ($seqData as $seq) {
            $avion = AvionModel::getAvionById($seq['id_av']);
            $forfait = OpeForModel::getOpeForBySeq($seq['num_seq']);
            $vol_forfait .= '<tr>';
            $vol_forfait .= '<td>' . $seq['num_seq'] . '</td>';
            $vol_forfait .= '<td>' . $avion['type'] . '</td>';
            $vol_forfait .= '<td>' . $seq['date'] . '</td>';
            $vol_forfait .= '<td>' . $seq['temps'] . '</td>';
            $vol_forfait .= '<td>' . $seq['taux_instructeur'] * $seq['taux'] . '</td>';
            $vol_forfait .= '<td>' . $seq['taux'] . '</td>';
            $vol_forfait .= '<td>' . $seq['reduction_semaine'] . '</td>';
            $vol_forfait .= '<td>' . $seq['prix_special'] . '</td>';
            $vol_forfait .= '<td>' . $seq['motif'] . '</td>';
            $vol_forfait .= '<td>' . $forfait['forfait'] . '</td>';
            $vol_forfait .= '<td>' . $forfait['reste'].'</td>';
            if ($seq['forfait_initiation']) {
                $vol_forfait .= '<td><input type="checkbox" checked disabled ></td>';
            } else {
                $vol_forfait .= '<td><input type="checkbox" disabled ></td>';
            }
            $vol_forfait .= '</tr>';
        }

        // Concaténe la fin du tableau
        $vol_forfait .= '</tbody>';
        $vol_forfait .= '</table>';
    } else {
        // Si aucune donnée n'a été retournée, ajoute un message approprié à la variable HTML
        $vol_forfait .= "Pas de vol effectué.";
    }


    //Création de la table de ope_compte avec l'id du membre

    $op_compte = '';

    $opeco = OpeComModel::getOpeByCo($compte['id_compte']);
    if ($opeco) {
        $op_compte .= '<table>
                    <thead>
                        <tr>
                            <th>N° Seq</th>
                            <th>Date</th>
                            <th>Commentaire</th>
                            <th>Crédit</th>
                            <th>Débit</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($opeco as $ope) {
            $op_compte .= '<tr>';
            $op_compte .= '<td>' . $ope['id_seq'] . '</td>';
            $op_compte .= '<td>' . $ope['date'] . '</td>';
            $op_compte .= '<td>' . $ope['commentaire'] . '</td>';
            $op_compte .= '<td>' . ($ope['credit'] ?? 0) . '</td>';
            $op_compte .= '<td>' . ($ope['debit'] ?? 0) . '</td>';
            $op_compte .= '</tr>';
        }
        $op_compte .= '</tbody>
                </table>';
    }


    //Calcul du solde créditeur ou débiteur
    $solde = '';
    if ($compte) {
        if ($compte['debit'] > $compte['credit']) {
            $solde .= 'Solde débiteur : ' . $compte['debit'] - $compte['credit'] . ' !';
            $solde .= ' Rappel : Il est interdit de voler avec un solde Débiteur !!!';
        } else if ($compte['debit'] < $compte['credit']) {
            $solde .= 'Solde créditeur : ' . $compte['credit'] - $compte['debit'] . ' !';
        } else if ($compte['debit'] == $compte['credit']) {
            $solde .= 'Solde : ' . $compte['debit'] - $compte['credit'] . ' !';
        }
    }
// Set some content to print
    $html = '<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Facture</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 950px;
                margin: 20px auto;
                padding: 20px;
                border: 1px solid #ccc;
            }
            .logo {
                width: 100px;
                height: 100px;
                position: absolute;
                top: 3.5%;
                left: 25%;
            }
            .table-container {
                margin-top: 50px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: center;
            }
            th {
                background-color: #f2f2f2;
            }
            .situation-container {
                margin-top: 20px;
            }
            p ,h2{
                color:blue;
            }
            


        </style>
    </head>
    <body>
        <div class="container">
            <img src="/asset/cva.jpg" alt="Logo Aeroclub" class="logo">
            <h2 style="text-align: center;">Aeroclub - ' . $_SESSION['nom'] . ' ' . $_SESSION['prenom'] . '</h2>
            <div class="table-container">
                <p style="text-align: center;">Liste des vols avec la situation des éventuels Forfaits</p>
                ' . $vol_forfait . '
            </div>
            <div class="situation-container">
                <p style="text-align: center;">Situation de Votre Compte :</p>
                 ' . $op_compte . '
                <p style="text-align: right;">'.$solde.'</p>
            </div>
        </div>
    </body>
</html>';

// Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
    $pdf->Output('facture.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
}

header('Location: index.php?url=login');
