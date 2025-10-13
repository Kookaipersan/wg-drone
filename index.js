// Récupération des éléments HTML nécessaires pour le menu mobile
const menuButton = document.getElementById("menu-button");   // Bouton qui déclenche l'ouverture/fermeture du menu
const mobileMenu = document.getElementById("mobile-menu");   // Conteneur du menu mobile (menu déroulant)
const menuIcon = document.querySelector(".menu-icon");       // Icône du menu burger (trois barres)
const closeIcon = document.querySelector(".close-icon");     // Icône de fermeture (croix)

   // Ajout d’un écouteur d’événement sur le bouton menu pour gérer les clics
menuButton.addEventListener("click", () => {
   // Vérifie si le menu est actuellement ouvert (aria-expanded à true)
  const isExpanded = menuButton.getAttribute("aria-expanded") === "true";
   // Inverse l’état aria-expanded pour améliorer l’accessibilité (indique si menu est ouvert ou fermé)
  menuButton.setAttribute("aria-expanded", !isExpanded);
   // Alterne la classe "hidden" sur le menu mobile pour l'afficher ou le cacher
  mobileMenu.classList.toggle("hidden");
   // Alterne la visibilité des icônes burger et croix
  menuIcon.classList.toggle("hidden");
  closeIcon.classList.toggle("hidden")
});
