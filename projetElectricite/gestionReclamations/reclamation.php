<?php
require_once("../connex.php");
if(session_status()===PHP_SESSION_ACTIVE)
session_start();
require_once('../verificationUser.php');
verificationConnex();
$title="Afficher une consommation";

$content="";

if($consomm=valider($_GET['r'])){
    if($_SESSION['isAdmin']==1){
        $lien="listReclamationByF.php";
    }else if($_SESSION['isAdmin']==0){
        $lien="listReclamationByC.php";
    }
    $pdostat = $pdo->prepare(
    "select * from reclamations where id=".$consomm); 
    $pdostat->execute();
    $T1=$pdostat->fetchAll()[0];
    $content="<div class='bgNew'>".'
    <div class="d-flex justify-content-center gap-3 mb-5" style="position:absolute; top:10px; right:40px;">
        <div class="d-flex gap-5 justify-content-center mt-3">
            <div class="modifier">
                <a href='.$lien.'>Revenir à la liste des réclamations</a>
            </div>
        </div>
    </div>'."
    <div class='conteneur d-flex flex-column justify-content-center align-items-center gap-3'><div class='reclamation mt-5'><table class='table .table-striped'>
    <thead>
      <tr><th scope='row'>Type</th><td>".$T1['type']."</td></tr><tr><th scope='row'>Objet</th><td>".$T1['objet']."</td></tr><tr><th>Description</th><td>".$T1['description']."</td></tr></table></div>";
    $pdostat2=$pdo->prepare("select * from reponses where idReclamation=? order by date");
    $pdostat2->bindValue(1,$T1['id']);
    $pdostat2->execute();
    $position="";
    foreach($pdostat2 as $reponse){
            if(($reponse['idAdmin']==$_SESSION['id'] && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1)  || ($reponse['idClient']==$_SESSION['id'] && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==0) ){
                $qui="De votre part";
                $position="align-self-end mx-5";
            }else if($reponse['idAdmin']!=null){
                $qui="Re par M Fournisseur";
                $position="align-self-start ml-5";
            }else if($reponse['idClient']!=null){
                $qui="Re par M client";
                $position="align-self-start ml-5";
            }
       
        $content.='<div class="reponse '.$position.'"><table class="table .table-striped"><tr><th>'.$qui.'</th></tr><tr><td>'.$reponse['reponse'].'</td></tr></table></div>';
    }
   
    if($T1['state'] ==0){
        $content.='<div class="littleFrm formu formu2 d-flex justify-content-center align-items-center gap-5 flex-row-reverse">
                        <form method="POST" action="traitAddReponse.php" class="d-flex  align-items-center flex-column">
                            <div class="betS form-floating d-flex justify-content-center align-items-center flex-column">
                                <div class="beT form-floating mb-3 ml-3">
                                    <textarea class="form-control" placeholder="Envoyer une réponse?" id="floatingTextarea" name="reponse"></textarea>
                                    <label for="floatingTextarea">Réponse</label>
                                </div> 
                                <input type="hidden" name="idReclamation" value="'.$T1['id'].'">
                                <div class="mybtns form-floating mb-3 ml-3 d-flex gap-3">
                                    <div class="mb-3 me-2">
                                        <input type="submit" value="Envoyer">
                                    </div>
                                    <div class="mb-3 d-flex justify-content-center align-items-center" id="annuler"><a  href="'.$lien.'">Annuler</a></div>

                                </div>
                            </div>
                            
                        </form>';
    
      if(($T1['idClient']==$_SESSION['id']) && isset($_SESSION['isAdmin']) && ($_SESSION["isAdmin"] == 0)){
        $content.='     <div class="lien3 justify-">
                            <a href="resoudreReclamation.php?r='.urlencode($T1['id']).'">Marquer cette réclamation comme résolue?</a>
                        </div>';
      }
      
    }else{
       
        $content.="     <div class='d-flex justify-content-around mb-3 gap-5'>
                            <div class='info px-3'><p>Réclamation résolue</p></div>
                        </div>
                    </div>";
    }
    
    require_once("../layout.php");
}
