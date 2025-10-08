<?php
require_once 'db.php'; // inclure ta connexion PDO

// Récupérer et nettoyer les données POST
$nom = trim($_POST['last-name'] ?? '');
$prenom = trim($_POST['first-name'] ?? '');
$email = trim($_POST['email'] ?? '');
$telephone = trim($_POST['telephone'] ?? '');
$message = trim($_POST['message'] ?? '');

// Simple validation 
if ($nom === '' || $prenom === '' || $email === '') {
    die('Erreur : veuillez remplir tous les champs obligatoires.');
}
// Vérifier si email existe déjà
$sql_check = "SELECT id FROM clients WHERE email = :email";
$stmt_check = $pdo->prepare($sql_check);
$stmt_check->execute([':email' => $email]);
$exists = $stmt_check->fetch();

if ($exists) {
    die("Erreur : cet email est déjà utilisé.");
}
// Préparer la requête SQL pour insérer le client
$sql = "INSERT INTO clients (nom, prenom, email, telephone, message) VALUES (:nom, :prenom, :email, :telephone, :message)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':email' => $email,
    ':telephone' => $telephone,
    ':message' => $message
]);

// Rediriger ou afficher un message
echo "Merci $prenom, votre message a bien été envoyé !";
echo '<p><a href="index.html">Retour à l\'accueil</a></p>';
?>
