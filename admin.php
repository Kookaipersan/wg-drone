<?php

require 'db.php';

//AUTHETIFICATION

session_start();
if(!isset($_SESSION ['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

//RECUPERATION DES DEVIS AVEC INFOS CLIENTS
$sql = "SELECT d.*, c.nom, c.prenom, c.email, c.telephone
FROM devis d
JOIN clients c ON d.client_id = c.id
ORDER BY d.date_demande DESC";

$stmt = $pdo->query($sql);
$devis = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Admin - Liste des devis</title>
    <link href="chemin/vers/output.css" rel="stylesheet">
</head>
<body>
    <h1>Liste des devis</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Client</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Surface Toiture</th>
                <th>Surface Façade</th>
                <th>Surface Panneaux</th>
                <th>Hauteur</th>
                <th>Emplacement</th>
                <th>Matériau</th>
                <th>Accessibilité</th>
                <th>Description</th>
                <th>Date Demande</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($devis as $d): ?>
                <tr>
                    <td><?= htmlspecialchars($d['nom']) ?> <?= htmlspecialchars($d['prenom']) ?></td>
                    <td><?= htmlspecialchars($d['email']) ?></td>
                    <td><?= htmlspecialchars($d['telephone']) ?></td>
                    <td><?= htmlspecialchars($d['surface_toiture']) ?></td>
                    <td><?= htmlspecialchars($d['surface_facade']) ?></td>
                    <td><?= htmlspecialchars($d['surface_panneaux']) ?></td>
                    <td><?= htmlspecialchars($d['hauteur']) ?></td>
                    <td><?= htmlspecialchars($d['emplacement']) ?></td>
                    <td><?= htmlspecialchars($d['materiau']) ?></td>
                    <td><?= htmlspecialchars($d['accessibilite']) ?></td>
                    <td><?= htmlspecialchars($d['description']) ?></td>
                    <td><?= htmlspecialchars($d['date_demande']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>