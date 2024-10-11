<?php

?>

<style>
    body{
        margin : 0px
    }
    .Appli{
        width: 100%; 
        height: 50px;  
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        color: black;
        border: solid 3px black;

    }

    .Logo{
        width: 45px;
        display: flex;
        margin: 5px;
    }

    .Titre{
        align-items: center;
        gap: 10px;
        display: flex;
        margin: 5px;
        width: 45px;
    }

</style>
<div class="Appli" >
  <div class="Titre">
    <img src="../../RESSOURCES/img/logo.png" alt="Accueil" style="width : inherit;">
    <h1>PrèsDeVous</h1>
  </div>
  <div>
    <li><a href="./">Home</a> </li>
  </div>
  <a href="../Login/logout.php">

  <div class="Logo">
    <img src="../../RESSOURCES/img/logout.png" alt="Deconnexion" style="width: inherit;">
</div>
</a>

</div>