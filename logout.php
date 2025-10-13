<?php
// Démarrer la session pour pouvoir la manipuler
session_start();
// Supprime toutes les variables de session
session_unset();
// Détruit la session en cours, supprimant toutes les données de session côté serveur
session_destroy();
// Redirige l'utilisateur vers la page d'accueil après déconnexion
header('Location: index.html');  
// Arrête l'exécution du script pour éviter tout comportement indésirable après la redirection
exit;
