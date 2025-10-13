<?php

// Démarrage de la session PHP pour gérer l'état de connexion
session_start();

// Inclusion du fichier de connexion à la base de données PDO
require_once 'db.php'; 

// Si admin déjà connecté, redirige vers admin.php
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin.php');  // Redirection vers admin.php
    exit;                           // Stopper l’exécution du script après redirection
}


$error = '';  // Initialisation d’une variable pour stocker les messages d’erreur

// Vérifie si le formulaire a été soumis en méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération sécurisée des valeurs du formulaire (identifiant et mot de passe)
    $username = $_POST['username'] ?? '';  // Récupère le username ou chaîne vide si absent
    $password = $_POST['password'] ?? '';  // Récupère le password ou chaîne vide si absent

    // Requête pour chercher l'admin dans la base
    $sql = "SELECT * FROM admins WHERE username = :username";
    $stmt = $pdo->prepare($sql);                               // Prépare la requête pour éviter injection SQL
    $stmt->execute([':username' => $username]);                // Exécute la requête avec la valeur de l’utilisateur
    $admin = $stmt->fetch();                                   // Récupère la ligne de résultat (ou false si aucun)


    // Vérifie si un admin a été trouvé et si le mot de passe saisi correspond au hash stocké
    if ($admin && password_verify($password, $admin['password'])) {
     // Si authentification réussie, création d’une session indiquant que l’admin est connecté   
        $_SESSION['admin_logged_in'] = true;
        // Redirection vers la page admin sécurisée
        header('Location: admin.php');
        exit;   // On arrête le script après redirection
    } else {
        // Sinon, message d’erreur pour informer que les identifiants sont incorrects
        $error = 'Identifiant ou mot de passe incorrect.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Connexion Admin</title>
    <style>
        body { font-family: Arial, sans-serif; background: #134074; color: #fff; display: flex; justify-content: center; align-items: center; height: 100vh; }
        form { background: #fff; color: #134074; padding: 20px; border-radius: 8px; width: 300px; }
        label, input { display: block; width: 100%; margin-bottom: 10px; }
        input { padding: 8px; }
        button { background: #134074; color: #fff; border: none; padding: 10px; width: 100%; cursor: pointer; border-radius: 4px; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>
    <!-- Formulaire de connexion administrateur -->
    <form method="POST" action="">
        <h2>Connexion Administrateur</h2>
         <!-- Affiche un message d'erreur si $error est défini -->
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <label for="username">Identifiant</label>
        <input type="text" id="username" name="username" required />

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required />

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
