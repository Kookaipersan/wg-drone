<?php
session_start();

require_once 'db.php'; // ta connexion PDO, adapte le chemin si besoin

// Si admin déjà connecté, redirige vers admin.php
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Requête pour chercher l'admin dans la base
    $sql = "SELECT * FROM admins WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
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
    <form method="POST" action="">
        <h2>Connexion Administrateur</h2>
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
