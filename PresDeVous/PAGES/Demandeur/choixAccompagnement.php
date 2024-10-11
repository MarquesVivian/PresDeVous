<?php
session_start(); // Démarre la session

include "../../RESSOURCES/general/BDD.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories</title>
</head>
<body>
    <?php
    include "../../RESSOURCES/general/NavBar.php"
    ?>

    <style>
        .contenaire{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 50px;
        }

        .card{
            width: 200px;
            height: 50px;
        }

        .choice{
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* 4 colonnes de tailles égales */
            grid-gap: 10px; /* Espace entre les cellules */
            padding: 20px;
            width: 50%; /* Largeur ajustée pour les écrans plus petits */
        }

        .choice form{
            display: flex;
    justify-content: center;
    align-items: center;
        }

    </style>
    <div class="contenaire">
        <h1>Type de besoin</h1>
        <div class="choice">
            <?php 
            $_GET["idCategorie"];
                $stmt = $pdo->query("SELECT * FROM souscategorieaction where IdCategorie = ".$_GET["idCategorie"]."" );
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($categories as $categorie) {
                    $idSousCat = $categorie["IdSousCategorie"];
                    $nomSousCat = $categorie["NomSousCategorie"];
                    $idCat = $_GET["idCategorie"];
                    echo '
                    <form action="creation.php" method="get" >
                <input type="hidden" name="idCategorie" value="'.$idCat.'">
                <input type="hidden" name="idSousCategorie" value="'.$idSousCat.'">
                <input type="submit" value="'.$nomSousCat.'" class="card">
                
            </form>';
                }

?>
        </div>
    </div>
    
</body>
</html>