<?php
require("connex.php");

require_once('verificationUser.php');
verificationConnex();
verificationAdminO();
$title="Dashboard";
$annee=(isset($_POST['anneeDashboard']) && !empty($_POST['anneeDashboard']))?$_POST['anneeDashboard']:"2020";
$annee=(isset($_GET['a']) && !empty($_GET['a']))?$_GET['a']:$annee;
$pdostat = $pdo->prepare(
    "select sum(consomMensuelle), zonegeo.id as sommeConsomm from clients left join zonegeo on clients.idZoneGeo=zonegeo.id left join consommations on clients.idClient=consommations.idClient where annee=? group by zonegeo.id order by zonegeo.id; ;"); 
    $pdostat->bindValue(1, $annee);
    $pdostat->setFetchMode(PDO::FETCH_NUM);
    $pdostat->execute();
    $T=[0,0,0];
    $i=0;
    // print_r($pdostat->fetchAll());
    foreach($pdostat->fetchAll() as $tab){
        if(isset($tab[0]) && isset($tab[1])){
            $T[$tab[1]-1]=$tab[0];
    }
  }
    $pdostat2=$pdo->prepare("select nomzone from zonegeo");
    $pdostat2->setFetchMode(PDO::FETCH_NUM);
    $pdostat2->execute();
    $i=0;
    $T2;
    foreach($pdostat2->fetchAll() as $tab2){
        $T2[$i]="\"".$tab2[0]."\"";
        $i++;
    }
    // var barColors = ["#00004a", "#6466CA","#0F3CDF"];
$part1='<canvas id="myChart"></canvas>

<script>
var xValues = ['.implode(', ',$T2).'];
var yValues = ['.implode(', ',$T).'];
var barColors = ["#00004a", "#6466CA","#0F3CDF"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Les sommes des consommations (en kw) par zone géographique"
    }
  }
});
</script>';
$pdostat2 = $pdo->prepare(
    "select count(consommations.id) as nbrFactureNonPayees from clients left join consommations on clients.idClient=consommations.idClient where state=0 and annee='".$annee."' group by clients.idZoneGeo order by clients.idZoneGeo"); 
    $pdostat2->setFetchMode(PDO::FETCH_NUM);
    $pdostat2->execute();
    $T3=[];
    $i=0;
    foreach($pdostat2->fetchAll() as $tab){
        if($tab[0] == null){
            $T3[$i]=0;
        }else{
            $T3[$i]=$tab[0];
        }
        $i++;
    }

    $part2='<canvas id="myChart2"></canvas>

<script>
var xValues = ['.implode(', ',$T2).'];
var yValues = ['.implode(', ',$T3).'];
var barColors = ["#00004a", "#6466CA","#0F3CDF"];

new Chart("myChart2", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Le nombre des factures non payées par zone géographique"
    }
  }
});

</script>';

$pdostat2 = $pdo->prepare(
    "select count(consommations.id) as nbrFactureNonPayees from consommations where state=-1 and annee='".$annee."'"); 
    $pdostat2->setFetchMode(PDO::FETCH_NUM);
    $pdostat2->execute();
    $nbnnTrait=$pdostat2->fetchAll()[0][0];
    $pdostat2 = $pdo->prepare(
        "select count(consommations.id) as nbrFactureNonPayees from consommations where state=0 and annee='".$annee."'"); 
        $pdostat2->setFetchMode(PDO::FETCH_NUM);
        $pdostat2->execute();
        $nbTraite=$pdostat2->fetchAll()[0][0];
        $pdostat2 = $pdo->prepare(
            "select count(consommations.id) as nbrFactureNonPayees from consommations where state=1 and annee='".$annee."'"); 
            $pdostat2->setFetchMode(PDO::FETCH_NUM);
            $pdostat2->execute();
            $nbPayee=$pdostat2->fetchAll()[0][0];
            $part3='<canvas id="myChart3"></canvas>
<script>
var xValues = ["Les consommations non traitées", "Les factures non payées", "Les factures payées"];
var yValues = ['.$nbnnTrait.', '.$nbTraite.', '.$nbPayee.'];
var barColors = ["#00004a", "#6466CA","#0F3CDF"];
new Chart("myChart3", {
    type: "doughnut",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      title: {
        display: true,
        text: "Visualisation des états de factures"
      }
    }
  });
  </script>';
  $pdostat3 = $pdo->prepare(
    "select sum(consomMensuelle) as sommeConsomm, consommations.mois from consommations where annee='".$annee."' group by consommations.mois order by consommations.mois;"); 
    $pdostat3->setFetchMode(PDO::FETCH_NUM);
    $pdostat3->execute();
    // $T3=$pdostat3->fetchAll();
   $T3=[];
    $i=0;
    $j=0;
    $tab=$pdostat3->fetchAll();
    if(!empty($tab) && !empty($tab[0])){
      for ($i = 0; $i < 12; $i++) {
        if(isset($tab[$j][1]) && $tab[$j][1] == ($i+1)){
          $T3[$i]=$tab[$j][0];
          $j++;
        }else{
          $T3[$i]=0;
        }
    }
    }
    

    $pdostat4 = $pdo->prepare(
        "select distinct consommations.mois from consommations where annee='".$annee."' order by consommations.mois;"); 
        $pdostat4->setFetchMode(PDO::FETCH_NUM);
        $pdostat4->execute();
        $T4=$pdostat4->fetchAll();
        if(!empty($T4)){
          $T4=$T4[0];
        }
        // print_r($T3);
        $i=0;
        
        // print_r($T3);

    $part4='<canvas id="myChart4"></canvas>

<script>
var xValues = ["Janv", "Fev", "Mars", "Avr", "MAI", "Juin", "Juill","Aout", "Sept", "Oct", "Nov","Dec"];
var yValues = ['.implode(', ',$T3).'];

new Chart("myChart4", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      label: \'La somme des consommations mensuelle par mois\',
      fill: false,
      lineTension: 0,
      backgroundColor: "#BE955B",
      borderColor: "#8F939E",
      data: yValues
      
    }]
  },
  options: {
    legend: {display: true,
      text: \'La somme des consommations mensuelle par mois\',
    },
    plugins: {
      title: {
          display: true,
          text: \'La somme des consommations mensuelle par mois\'
      }
  }
    
  }
});
</script>';
$pdostat6 = $pdo->prepare(

  "SELECT * FROM zonegeo") ;
 $options="";
  $pdostat6->execute();
  foreach($pdostat6->fetchAll() as $zone){
      $options.='<option value="'.$zone['id'].'">'.$zone['nomZone'].'</option>';
  }
$content='
<div class="full6 d-flex">
  <div class="left d-flex flex-column justify-content-around gap-5">'."
    <div style='height:50%;' class='d-flex flex-column justify-content-around'>
      <form action='dashboard.php' method='post' class='d-flex justify-content-center gap-2'>
        <div style='width:40%;'><input type='number' style='width:100%;' min='2018' id='anneeDashboard'name='anneeDashboard' value='".$annee."'></div>
        <div style='width:40%;' class='btnN'><input type='submit' value='Appliquer'></div>
      </form>
      <form action='gestionConsommations/genererFileConsommAnn.php' method='post' class='d-flex flex-column justify-content-around gap-2'>
        <input type='hidden'  id='annee'name='annee' value='".$annee."'>
        <select name='idZone'>
          <option disabled>Choisissez la zone pour le téléchargement</option>".$options."
        </select>
        <div class='btnN'><input type='submit' value='Consommation annuelle'></div>
      </form>
    </div>
   
    <div style='height:50%' class='d-flex flex-column justify-content-center gap-3'>
      <div class='lien3'><a href='gestionConsommations/consommAnnuelle.php'>Vérifier la consommation annuelle</a></div>
      <div class='lien3'><a href='espaceAdmin.php'>Revenir à votre espace</a></div>
    </div>
  </div>".'
  <div class="right d-flex flex-column justify-content-center align-items-center">

    <div class="halfUp d-flex justify-content-around">
      <div class="col cadre1 mt-3 ml-3 mb-3">'.$part1.'</div>
      <div class="col cadre2 mt-3 ml-3 mb-3">'.$part2.'</div>
    </div>
    <div class="halfDown d-flex justify-content-around">
        <div class="cadre3 ml-3 mb-3">'.$part3.'</div>  
        <div class="col cadre4 ml-3 mb-3">'.$part4.'</div>
    </div>
  </div>
  <script>
  function changeDashboard(){
    let annee=document.getElementById("anneeDashboard").value;
    console.log(annee); 
    const url = "http://gestion_electricite/dashboard.php";

let xhr = new XMLHttpRequest();

xhr.open("POST", url, true);

xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");

xhr.send(annee);

xhr.onload = function () {

    if(xhr.status === 201) {

        console.log("dashboard updated!");

    }

}

  }
  </script>
  
  
  
  ';
require_once('layout.php');