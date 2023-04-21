<?php


function genererFacture($idConsom, $idClient, $mois, $annee, $pdo, $valMois){
    // require_once('connex.php');
    try{
        $TVA=0.14;
        if($valMois <=100){
            $prixUnitaire=0.91;
        }else if($valMois >= 101 && $valMois <= 200){
            $prixUnitaire=1.01;
        }else{
            $prixUnitaire=1.12;
        }
        
       
        $pdostat = $pdo->prepare(
    
        "SELECT * FROM clients join zonegeo on clients.idZoneGeo=zonegeo.id where idClient=?") ;
        $pdostat->bindValue(1,  $idClient);
        $pdostat->execute();
    
        // $pdostat2 = $pdo->prepare(
    
        //     "SELECT * FROM consommations where id=?") ;
        //     $pdostat2->bindValue(1,  $idConsom);
        //     $pdostat2->execute();
    
        $client= $pdostat->fetchAll()[0];
        // $consomm=$pdostat2->fetchAll()[0];
       
            $prixHT= $valMois* $prixUnitaire;
            $prixTTC=$prixHT * (1 + $TVA);
            $fileName=$idClient."_".$mois."_".$annee.".pdf";
    //    $file=fopen('../factures/'.$fileName, "w");
       require('fpdf185/fpdf.php');
       $pdf=new FPDF();
       $pdf->AddPage();
       $pdf->SetFont('Arial', 'B', 16);
       $cell_width = 90;
        $cell_height = 10;
        
        $pdf->Cell(160,10,"Facture N: ".$idConsom, 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50,10,"Date: ".$mois."/".$annee." Zone geographique: ".$client['nomZone'],0,1);
        $pdf->Line(10, 30, 200, 30);
        $pdf->Ln();
        $pdf->Cell(50,10,"Fournisseur Gestion_Electricite:",0,1);
        $pdf->Cell(50,10,"MM ".$client['lastName']." ".$client['firstName'],0,1);
        $pdf->Cell(50,10,"Adresse: ".$client["adressResid"],0,1);
        $pdf->Ln();
        $pdf->Cell($cell_width, $cell_height, 'Consommation en Kw:', 1);
        $pdf->Cell($cell_width, $cell_height, $valMois, 1);
        $pdf->Ln();
        $pdf->Cell($cell_width, $cell_height, 'Prix Unitaire en DH:', 1);
        $pdf->Cell($cell_width, $cell_height, $prixUnitaire, 1);
        $pdf->Ln();
        $pdf->Cell($cell_width, $cell_height, "TVA: ", 1);
        $pdf->Cell($cell_width, $cell_height, $TVA, 1);
        $pdf->Ln();
        $pdf->Cell($cell_width, $cell_height, "Prix HT en DH: ", 1);
        $pdf->Cell($cell_width, $cell_height, $prixHT, 1);
        $pdf->Ln();
        $pdf->Cell($cell_width, $cell_height, "Prix TTC en DH: ", 1);
        $pdf->Cell($cell_width, $cell_height, $prixTTC, 1);
        $pdf->Ln();
        $pdf->Output('F', '../factures/'.$fileName);
  
       $pdostat3 = $pdo->prepare(
    
        "update consommations set prixHT=?, prixTTC=?, state=?, urlFacture=?, consomMensuelle=? where id=?") ;
        // print("./factures/$fileName");
        $pdostat3->bindValue(1, $prixHT); 
        $pdostat3->bindValue(2, $prixTTC); 
        $pdostat3->bindValue(3, 0); //it means that the facture has been generated
        $pdostat3->bindValue(4, "./factures/$fileName"); 
        $pdostat3->bindValue(5, $valMois); 
        $pdostat3->bindValue(6, $idConsom); 
        $pdostat3->execute();
    //    fclose($file);
    
    }catch(Exception $e){
        print($e->getMessage());
    }
    


}