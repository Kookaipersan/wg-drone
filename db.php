<?php

// Configuration de la connexion à la base de données
$host = '127.0.0.1';  // Adresse du serveur MySQL (localhost)
$db = 'wg_drone';     // Nom de la base de données utilisée
$user = 'root';       // Nom d'utilisateur MySQL (par défaut 'root' sous XAMPP)
$pass = '';           // Mot de passe MySQL (vide par défaut sous XAMPP)
$charset = 'utf8mb4'; // Jeu de caractères utilisé pour la connexion (UTF-8 complet)

// Construction de la chaîne de connexion (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Options pour la connexion PDO
$options = [
    // Mode d'erreur : PDO lance une exception en cas d'erreur SQL
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    // Mode de récupération par défaut : tableau associatif (clé = nom de colonne) 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    // Désactive l'émulation des requêtes préparées pour une meilleure sécurité       
    PDO::ATTR_EMULATE_PREPARES   => false,                   
];
try {
    // Création de l'objet PDO (connexion à la base de données)
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // En cas d’erreur, afficher un message et arrêter le script
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}



