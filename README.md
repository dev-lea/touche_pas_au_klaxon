# Touche pas au klaxon (TPAK)

Application MVC PHP pour favoriser le covoiturage inter-sites (intranet).

## 🎯 Fonctionnalités
- Liste des trajets **à venir** avec **places disponibles** (accueil).
- Authentification (user/admin), gestion des rôles.
- Proposer/éditer/supprimer ses trajets (user).
- Dashboard admin : utilisateurs, agences (CRUD), trajets (liste + suppression).
- Messages flash, thème Bootstrap + Sass.

## 🧰 Prérequis
- PHP 8.3+ (PDO MySQL activé)
- Composer
- MySQL/MariaDB
- Node + npm (pour Sass)

## ⚙️ Installation
```bash
composer install
npm install
npm run sass:dev
