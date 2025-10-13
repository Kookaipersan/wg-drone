# WG-Drone- Projet de Nettoyage par Drone

## Description

Site web pour une entreprise proposant des services de nettoyage tel Toitures, Façades,
Panneaux solaire, par Drone.
Ce projet inclus une interface utilisateur , un système de gestion de devis et de messages, une base de donnéeMySQL, et une administration sécurisée.

## Technologies utilisées

- HTML5, CSS3, Tailwind CSS
-PHP8, PDO pour la gestion de la base de donnée
-MySQL pour la base de données
-Javascript pour interactions (menu Burger, Faq)
-Apache (XAMPP) en local

## Installation

1- Cloner le dépôt :
'''bash
git clone https://github.com/Kookaipersan/wg-drone.git
2- Pacr le projet dans Ht-docs de XAMPP.
3- Importer la base de données MySQL via phpMyAdmin.
4- Configurer le fichier db.php avec les identifiants Mysql
5- Lancer le serveur Apache via XAMPP.
6- Accèder à http://localhost/wg-drone dans un navigateur.

Fonctionnalités
* Formulaire de contact et demande de devis, savegarde en base.
* Tableau d'administration sécurisé pour consulter devis et messages client.
* Menu responsive avec Tailwind.
* Validation et sécurité des formulaires coté serveur.

Structure du projet 

wg-drone/
├── src/css/output.css  (feuille de style compilée Tailwind)
├── db.php              (connexion base de données)
├── process_form.php    (traitement formulaire contact)
├── process_devis.php   (traitement formulaire devis)
├── admin.php           (interface administration)
├── login.php           (connexion admin)
├── index.html          (page d'accueil)
├── contact.html        (page contact)
├── devis.html          (page devis)
└── ... autres fichiers

Auteur 
* William Germain
* Formation Webmaster Full-stack OCT-24
* Contact Kookaipersan@gmail.com
