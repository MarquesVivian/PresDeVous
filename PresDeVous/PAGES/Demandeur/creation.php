<?php
session_start(); // Démarre la session

include "../../RESSOURCES/general/BDD.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomActivite = $_POST['nomAction'] ?? '';
    $description = $_POST['description'] ?? '';
    $dateActivite = $_POST['dateActivite'] ?? '';
    $horaireActivite = $_POST['horaireActivite'] ?? '';
    $idCat = $_POST['idCategorie'];
    $idSousCat = $_POST['idSousCategorie'];
    $userId = $_SESSION["user_id"];

    // Insertion dans la base de données
    $stmt = $pdo->prepare("INSERT INTO action (NomAction, DescriptionAccomp, DateAction, HoraireAction,IdCategorie,IdSousCategorieAction) VALUES (:nomActivite, :description, :dateActivite, :horaireActivite, :idCat, :idSousCat)");
    $stmt->execute([
        'nomActivite' => $nomActivite,
        'description' => $description,
        'dateActivite' => $dateActivite,
        'horaireActivite' => $horaireActivite,
        'idCat' => $idCat,
        'idSousCat' => $idSousCat,
    ]);


        // Récupérer l'ID de la dernière action insérée
        $idAction = $pdo->lastInsertId();

        // Insertion dans la table Activite
        $stmtActivite = $pdo->prepare("INSERT INTO Activite (IdDemandeur, IdAction) VALUES (:idDemandeur, :idAction)");
        $stmtActivite->execute([
            'idDemandeur' => $_SESSION["user_id"],
            'idAction' => $idAction,
        ]);

    // Redirection ou message de succès
    header("Location: index.php"); // Redirige vers la liste des activités après l'ajout
    exit;
}
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

    <h1>Créer une Activité</h1>
    <form method="post" action="">
        <input type="text" name="nomAction" placeholder="Nom de l'action" required>
        <textarea name="description" placeholder="Description de l'action" required></textarea>
        <input type="date" name="dateActivite" placeholder="Date de l'action" required>
        <input type="time" name="horaireActivite" placeholder="Horaire de l'action" required>
        <input type="hidden" name="idCategorie" value="<?php echo $_GET["idCategorie"] ?>">
        <input type="hidden" name="idSousCategorie" value="<?php echo $_GET["idSousCategorie"] ?>">
        <button type="submit">Créer Activité</button>
    </form>
    <a href="listeActivites.php">Retour à la liste des activités</a>
</body>
</html>