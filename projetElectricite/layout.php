<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>

<body>
<style>
  
    body{
        min-height: 100vh;
        background-image: url('images/im3.jpg');
        background-repeat: repeat;
        background-size: cover;
        backdrop-filter: blur(8px);
        background-position:  bottom -70px right 0px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .bgNew{
        min-height: 100vh;
        width: 100%;
        background-image: url('images/im6.jpg');
        background-repeat: no-repeat;
        background-size: cover;
       
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap:40px;
    }
    .full6 {
        min-height: 100vh;
        width: 100%;
    }
    .left {
        height: 100vh;
        background-color: #000316;
        width:20%;
        padding: 40px;
        box-shadow: 15px 15px 5px #000316;
    }
    .right {
        width:80%;
        background-color: #C8CDD3;
    }
    .cadre1, .cadre2, .cadre3, .cadre4 {
        background-color: white;
        height: min-content;
        padding: 20px;
        border: 10px solid #000316;
        border-radius: 10px;
    }
    .cadre1,.cadre2, .cadre4{
        max-width: 40% !important;
        min-width: 30% !important;
       
    }
  
    .cadre3{
        max-width: 60% !important;
        min-width: 30% !important;
    }
   
    
    .halfUp, .halfDown {
        width:90%;
        height:50%;
    }
    .reclamation, .reponse {
        width: 60%;
        background-color: white;
       justify-self: start;
       padding: 20px;
       border-radius: 20px;
    }
    .reponse {
        width: 20%;
    }
    .body2, .body3{
        width:70%;
        height:80%;
        background-repeat: no-repeat;
        background-image: url('images/im3.jpg');
        background-position:  bottom -80px right 0px;
        background-size: cover;
       display: flex;
       align-items: center;
       box-shadow: 10px 5px 15px rgb(1,4,31);   
    }
    .body3 {
        background-image: url('images/im4.jpg');
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .conteneur {
        width: 70%;
    }
    #zoneForm{
        padding: 10px;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        align-items: center;
        width: 60%;
        height: 70%;

    }
    #zoneForm input {
        background-color: transparent;
        width: 90%;
        border-width: 0 0 2px !important;
        box-shadow: none;
        border-radius: 0;
        color: white;
    }
    .btnWhite{
        background-color: rgb(80,207,248);
        
        border:1px transparent;
        border-radius: 5px;
        padding: 10px;
        width: 90%;
    }
    .btnWhite input {
        border: none;
        color: rgb(1,4,31) !important;
        font-weight: bold;
    }
    h2, h1 {
        font-size: xx-large;
        font-weight: bolder;
    }
    .full{
        height: 100vh;
        width: 100%;
        background-image: url('images/im4.jpg');
        background-repeat: no-repeat;
        background-size: cover;
    }
    .full3{
        height: 100vh;
        width: 100%;
        background-image: none;
    
        background-color: rgb(44,242,255) !important;
        display: flex;
        justify-content: center;
        align-items: center;
         /* background-color: black !important; */
         /* z-index: -1; */
       
    }
    .full h2, h1 {
        font-size: xx-large;
        font-weight: bolder;
        color: rgb(44,242,255);
    }
    .btnN{
        all:unset;
        width: fit-content !important;
        border-radius: 5px;
    }
    .btnN input {
        background-color: transparent !important;
        
    }
    .lien, .lien2, .lien3, .info{
        padding: 5px;
        border-radius: 5px;
        background-color: rgb(44,242,255);
    }
    
    .lien a , .lien2 a, .lien3 a, .info p, .btnN input{
        text-decoration: none !important;
        color:rgb(14,53,96);
        font-weight: bold;
    }
    
    .lien2{
        background-color: rgb(11,67,175);
    }
    .lien2 a{
        background-color: rgb(11,67,175);
        color:white;
    }
    .lien3, .info,.btnN {
        background-color: rgb(255, 224, 102) !important;
        text-align: center;
    }
    .lien3 a, .btnN input{
        color:rgb(11,67,175);
    }
    .lien4 label{
        padding :10px;
        background-color: rgb(255, 224, 102)!important;
        color:rgb(11,67,175)!important;
        width: fit-content;
        border-radius: 10px;
    }
    .fixSize {
        max-width: 500px;
    }
    .formu{
        background-color: transparent;
        width:50%;
        
    }
    .formu form {
        width: 70%;
        background-color: rgba(9,35,72,0.6);
        padding: 100px 20px 20px;
        border-radius: 20px;
      
    }
    .formu2 form{
        background-color: rgba(255, 224, 102, 0.6)!important;
    }
    .formu input{
        outline: none!important;
        border-width: 0 0 2px !important;
        border-color: white;
        border-radius: 0;
        width: 100%;
        height: 50px !important;
        font-size: small;
        background-color: transparent;
        color: white;
    }
    .formu input:focus {
        border-width: 2px!important;
        background-color: transparent;
        color: white;
        box-shadow: none;
    }
    .formu label, .formu label:focus {
        font-size: small;
        color: rgb(227,252,252);
    }
    .formu div, .form select, .formu textarea, .formu textarea:focus{
        width: 70%;
        background-color: transparent;
        color: white;

    }
    .formu select:active {
        color:rgb(9,35,72);
    }
    .mybtns input, #annuler, .modifier{
        background-color: rgb(227,252,252);
        color:rgb(9,35,72);
        border-radius: 5px;
        font-weight: bold;
    }
    .modifier {
        padding: 3px;
    }
    #annuler  a, .modifier a{
       text-decoration: none;
       color:rgb(9,35,72);
       text-align: center;
    }
    .profil {
        color: rgb(227,252,252);
    }
    #specialS {
        width:70%;
    }
    .client {
        background-color: rgb(227,252,252);
        
        padding: 5px;
        border-radius: 5px;
        margin-bottom: 10px;
        margin-left: 50px;
        width: 35%; 
        text-align: center;
    }
    .client a {
        color:rgb(9,35,72);
        text-decoration: none;
        
    }
    .myTab {
        width:55%;
    }
    .myTab table {
        background-color: rgba(255, 224, 102, 0.4);
        border-radius: 10px;
        
    }
    .myTab td {
        color: black;
    }
    .mibtn {
        width:fit-content;
    }
    .beT{
        background-color: transparent !important;
    }
    .beT input{
        background-color: transparent !important;
    }
    #proof{
        max-width: 60%;
        max-height: 60% !important;
    }
    .lienInput {
        background-color: rgba(255, 224, 102);
        color:rgb(17,74,138);
        padding: 5px;

    }
    .littleFrm {
        width: 80%;
        
    }
    .littleFrm textarea{
        width:90%;
        height:20%;
    }
    .betS, .betS:focus {
        width: 100% !important;
    }
    .betS div {
        width: 80%;
    }
    .betS textarea, .betS textarea:focus {
        width: 100% !important;
        
    }
    .dec {
        justify-self: end !important;
    }
</style>
    <?=$content?>
  
</body>
</html>