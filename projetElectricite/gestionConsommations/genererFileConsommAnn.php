<?php
require_once('../connex.php');

$annee=valider($_POST['annee']);
$zone=valider($_POST['idZone']);

$pdostat = $pdo->prepare(
    "SELECT * FROM consomm_annuelle join zonegeo on zonegeo.id=consomm_annuelle.idZoneGeo join clients on consomm_annuelle.idClient=clients.idClient where  consomm_annuelle.idZoneGeo =? and consomm_annuelle.annee=?") ;
    $pdostat->bindValue(1,  $zone);
    $pdostat->bindValue(2,  $annee);
    $pdostat->execute();
    $T=$pdostat->fetchAll();
    require('fpdf185/fpdf.php');
       $pdf=new FPDF();
       $pdf->AddPage();
       $pdf->SetFont('Arial', 'B', 16);
       $cell_width = 63;
        $cell_height = 10;
        
        $pdf->Cell(160,10,"Consommation annuelle ", 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(30,10,"Annee: ".$annee,0,0);
       
        $pdf->Cell(90,10,"Zone georaphique: ".$T[0]['nomZone'],0,1);
        $pdf->Line(10, 30, 200, 30);
        $pdf->Ln();
        $pdf->Cell($cell_width, $cell_height,"IdClient",1,0,'C');
        $pdf->Cell($cell_width, $cell_height,"Nom Complet",1,0,'C');
        $pdf->Cell($cell_width, $cell_height,"Consommation annuelle",1,0,'C');
        $pdf->Ln();
    foreach( $T as $consomm){
        $pdf->Cell($cell_width, $cell_height,$consomm['idClient'],1);
        $pdf->Cell($cell_width, $cell_height,$consomm['lastName']." ".$consomm['firstName'],1);
        $pdf->Cell($cell_width, $cell_height,$consomm['consommAnnuelle'],1);
        $pdf->Ln();
    }
    $pdf->Output('D', 'consommAnn.pdf');
    // header('Location: ../dashboard.php?a='.$annee);