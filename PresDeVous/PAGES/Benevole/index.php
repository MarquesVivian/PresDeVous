<?php
session_start(); // Démarre la session

include "../../RESSOURCES/general/BDD.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
</head>
<body>
    <?php
    include "../../RESSOURCES/general/NavBar.php"
    ?>

    <style>
        #contenaire{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #grid{
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 4 colonnes de tailles égales */
            grid-gap: 10px; /* Espace entre les cellules */
            padding: 20px;
            width: 80%; /* Largeur ajustée pour les écrans plus petits */
            border: solid 1px green;
        }
        .card{
            display: flex;
            flex-direction: column;
            border: 3px black solid;
            background-color: lightgray;
            color: black;
            font-size: larger;
            width: inherit;
            height: 100%;
            border-radius: 8px;
        }
        .top{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            border-bottom: 3px solid black;
        }
        .Title{
            border-right: 3px solid black;
            padding-right: 2px;

        }
        .activiter{}
        .TimeStamp{
            border-bottom: 3px solid black;
 
        }
        .Desc{
            max-height: 70px;
            overflow-y: scroll;
            scrollbar-width: thin;
            scrollbar-color: black transparent;
        }

        .btnAjout {
            position: fixed; /* Fixe le bouton à l'écran */
            bottom: 20px; /* Distance depuis le bas de l'écran */
            right: 20px; /* Distance depuis le côté gauche */
            width: 80px; /* Largeur du bouton */
            height: 80px; /* Hauteur du bouton */
            background-color: #4CAF50; /* Couleur de fond verte */
            border-radius: 50%; /* Rend le bouton rond */
            display: flex;
            justify-content: center; /* Centre horizontalement le contenu */
            align-items: center; /* Centre verticalement le contenu */
            color: white; /* Couleur du texte */
            font-size: 36px; /* Taille de la croix */
            font-weight: bold;
            text-decoration: none; /* Supprime le soulignement du lien */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3); /* Ajoute une ombre pour un effet de profondeur */
            cursor: pointer;
        }

        .btnAjout a {
            color: white; /* Crois en blanc */
            text-decoration: none; /* Supprime le soulignement */
            font-size: 48px; /* Taille de la croix */
            line-height: 1; /* Pour s'assurer que la croix est bien centrée */
        }
    </style>
    <div id="contenaire">
    <div id="grid">
    <?php 
    $stmt = $pdo->query("SELECT NomAction,IdSousCategorieAction,NomSousCategorie,DescriptionAccomp,DateAction, HoraireAction 
                            FROM action 
                            INNER JOIN souscategorieaction on souscategorieaction.IdSousCategorie = action.IdSousCategorieAction
                            WHERE IdBenevole = ".$_SESSION["user_id"]."");
    $actions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($actions as $action) {
            $libelle = $action["NomAction"];
            $sousCat = $action["NomSousCategorie"];
            $desc = $action["DescriptionAccomp"];
            $date = $action["DateAction"];
            $horaire = $action["HoraireAction"];

            echo'
                        <div class="card">
                <div class="top">
                    <div class="Title">'.$libelle.'</div>
                    <div class="activiter">'.$sousCat.'</div>
                </div>
                <div class="TimeStamp">'.$date.' '.$horaire.'</div>
                <div class="Desc">'.$desc.'</div>
            </div>

            ';
        }

    ?>


        </div>
    </div>
    <div class="btnAjout"> <a href="listeDemande.php">+</a> </div>
</body>
</html>

