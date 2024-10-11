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
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

    </style>
    <div class="contenaire">
        <h1>Type de besoin</h1>
        <div class="choice">
            <?php 
                $stmt = $pdo->query("SELECT * FROM categorieaction" );
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($categories as $categorie) {
                    $idCat = $categorie["IdCategorie"];
                    $nomCat = $categorie["NomCategorie"];
                    echo '            <form action="choixAccompagnement.php" method="get" >
                <input type="hidden" name="idCategorie" value="'.$idCat.'">
                <input type="submit" value="'.$nomCat.'" class="card">
            </form>';
                }

?>
        </div>
    </div>
    
</body>
</html>