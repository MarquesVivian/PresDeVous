<?php
    session_start(); // Démarre la session

    include "../../RESSOURCES/general/BDD.php";

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';
    $hashed_password = hash('sha256', $mot_de_passe);
    echo $hashed_password;



    // Prépare et exécute la requête
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifie si l'utilisateur existe et si le mot de passe est correct
    if ($utilisateur && hash('sha256', $mot_de_passe) === $utilisateur['motDePasse'] && $utilisateur["IdRole"] == 1) {
        // Authentification réussie
        $_SESSION['user_id'] = $utilisateur['IdUtilisateur'];
        header("Location: ../Demandeur"); // Redirige vers la liste des utilisateurs
        exit;
    }elseif($utilisateur && hash('sha256', $mot_de_passe) === $utilisateur['motDePasse'] && $utilisateur["IdRole"] >= 2) {
                // Authentification réussie
                $_SESSION['user_id'] = $utilisateur['IdUtilisateur'];
                header("Location: ../Benevole"); // Redirige vers la liste des utilisateurs
                exit;
    }else {
        $erreur = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../../CSS/connection.css">
    <link href="../../RESSOURCES/general/button.css" rel="stylesheet">
</head>
<body>


    <div id="logo">
        <img src="../../RESSOURCES/img/logo.png" alt="logo">
        <span><h2>Près de vous</h2></span>
    </div>
    <form method="post" action="">
        <h2 style="display: flex; justify-content: center">Connexion</h2>
        <?php if (isset($erreur)): ?>
            <p style="color: red;"><?= $erreur; ?></p>
        <?php endif; ?>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        
        <div class="buttons" style="flex-direction: row-reverse; justify-content : center">
        <button id="BTN1" class="buttonLink" type="submit">Valider</button>
            <div id="BTN2" class="buttonLink">
                <a href="switchCoEtIns.php">
                    Retour
                </a>
            </div>
    </div>
    </form>

</body>
</html>
