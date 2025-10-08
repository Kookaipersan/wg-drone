<?php

require 'db.php';

//AUTHETIFICATION

session_start();
if(!isset($_SESSION ['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

//RECUPERATION DES DEVIS 
$sql = "SELECT d.*, c.nom, c.prenom, c.email, c.telephone
FROM devis d
JOIN clients c ON d.client_id = c.id
ORDER BY d.date_demande DESC";

$stmt = $pdo->query($sql);
$devis = $stmt->fetchAll();

// RECUPERATION DES MESSAGES
$sql_messages = "SELECT nom, prenom, email, message FROM clients
WHERE message IS NOT NULL AND message !='' ORDER BY id DESC";
$stmt_messages = $pdo->query($sql_messages);
$messages = $stmt_messages->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Admin - Liste des devis</title>
     <link rel="stylesheet" href="./src/css/output.css">
</head>

    <h1 class="max-w-6xl mx-auto bg-[#134074] py-6 text-white text-4xl text-center  rounded-md font-semibold mt-10">Liste des devis</h1>
    <table class="table-auto w-full  border-collapse border border-gray-300 text-center mt-10 ">
      
        <thead class="bg-[#eef4ed]">
            <tr>
                <th class="border border-gray-300">Client</th>
                <th class="border border-gray-300">Email</th>
                <th class="border border-gray-300">Téléphone</th>
                <th class="border border-gray-300">Surface Toiture</th>
                <th class="border border-gray-300">Surface Façade</th>
                <th class="border border-gray-300">Surface Panneaux</th>
                <th class="border border-gray-300">Hauteur</th>
                <th class="border border-gray-300">Emplacement</th>
                <th class="border border-gray-300">Matériau</th>
                <th class="border border-gray-300">Accessibilité</th>
                <th class="border border-gray-300">Description</th>
                <th class="border border-gray-300">Date Demande</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($devis as $d): ?>
                <tr>
                    <td class="border border-gray-300"><?= htmlspecialchars($d['nom']) ?> <?= htmlspecialchars($d['prenom']) ?></td>
                    <td class="border border-gray-300"><?= htmlspecialchars($d['email']) ?></td>
                    <td class="border border-gray-300"><?= htmlspecialchars($d['telephone']) ?></td>
                    <td class="border border-gray-300"><?= htmlspecialchars($d['surface_toiture']) ?></td>
                    <td class="border border-gray-300"><?= htmlspecialchars($d['surface_facade']) ?></td>
                    <td class="border border-gray-300" ><?= htmlspecialchars($d['surface_panneaux']) ?></td>
                    <td class="border border-gray-300" ><?= htmlspecialchars($d['hauteur']) ?></td>
                    <td class="border border-gray-300"><?= htmlspecialchars($d['emplacement']) ?></td>
                    <td class="border border-gray-300"><?= htmlspecialchars($d['materiau']) ?></td>
                    <td class="border border-gray-300"><?= htmlspecialchars($d['accessibilite']) ?></td>
                    <td class="border border-gray-300"><?= htmlspecialchars($d['description']) ?></td>
                    <td class="border border-gray-300"><?= htmlspecialchars($d['date_demande']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="max-w-6xl mx-auto bg-[#134074] py-6 text-white text-4xl text-center  rounded-md font-semibold mt-10">Messages Contacts</h2>
    <table class="table-auto w-full  border-collapse border border-gray-300 text-center mt-10 ">
        <thead class="bg-[#eef4ed]">
          <tr>
            <th class="border border-gray-300">Nom</th>
            <th class="border border-gray-300">Prénom</th>
            <th class="border border-gray-300">Email</th>
            <th class="border border-gray-300">Message</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $msg): ?>
                <tr>
                    <td class="border border-gray-300"><?= htmlspecialchars($msg['nom']) ?></td>
                    <td class="border border-gray-300"><?= htmlspecialchars($msg['prenom']) ?></td>
                    <td class="border border-gray-300"><?= htmlspecialchars($msg['email']) ?></td>
                    <td class="border border-gray-300"><?= htmlspecialchars($msg['message']) ?></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>

