<?php

require_once 'db.php';

$email = trim($_POST['email'] ?? '');
$nom = trim($_POST['nom'] ?? '');
$prenom = trim($_POST['prenom']  ?? '');
$telephone = trim($_POST['telephone']  ?? '');
$surface_toiture = trim($_POST['surface_toiture']  ?? null);
$surface_facade = trim($_POST['surface_facade']  ?? null);
$surface_panneaux = trim($_POST['surface_panneaux']  ?? null);
$hauteur = trim($_POST['hauteur'] ?? null);
$emplacement = trim($_POST['emplacement'] ?? null);
$materiau = trim($_POST['materiau']  ?? null);
$accessibilite = trim($_POST['accessibilite']  ?? null);
$description = trim($_POST['description']  ?? null);

try{

if ($email === '' || $nom === ''  || $prenom === '') {
    die('Veuillez remplir tous les champs obligatoire.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('email invalide.');
}

foreach (['surface_toiture', 'surface_facade', 'surface_panneaux', 'hauteur'] as $field) {
        if ($$field !== null && (!is_numeric($$field) || $$field < 0)) {
            die(ucfirst(str_replace('_', ' ', $field)) . ' invalide.');
        }
    }

$sql = "SELECT id FROM clients WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => $email]);
$client = $stmt->fetch();

if ($client) {
    $client_id = $client ['id'];
} else {
    $sql = "INSERT INTO clients (nom, prenom, email, telephone) VALUES (:nom, :prenom, :email, :telephone)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':telephone' => $telephone,
    ]);
    $client_id = $pdo->lastInsertId();
}

$sql = "INSERT INTO devis (client_id, surface_toiture, surface_facade, surface_panneaux, hauteur, emplacement, materiau,
accessibilite, description)  VALUES (:client_id, :surface_toiture, :surface_facade, :surface_panneaux, :hauteur, :emplacement, :materiau,
:accessibilite, :description)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
':client_id' => $client_id,
':surface_toiture' => $surface_toiture,
':surface_facade' => $surface_facade,
':surface_panneaux'  => $surface_panneaux,
':hauteur'  => $hauteur,
':emplacement' => $emplacement,
':materiau' => $materiau,
':accessibilite' => $accessibilite,
':description' => $description

]);

header('Location: merci_devis.php');
exit;

} catch (PDOException $e) {
    echo "Une erreur est survenue. Merci de réessayer plus tard.";
    error_log($e->getMessage());
    exit;
}

?>
