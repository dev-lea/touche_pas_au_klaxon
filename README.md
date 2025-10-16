# Touche pas au klaxon

Application PHP MVC de gestion de trajets entre agences.  
Projet réalisé dans le cadre du module **PHP Avancé / MVC**.

---

## Auteur
Nom : Devlea
Année : 2025
Projet : Devoir « Touche pas au Klaxon » — Application PHP MVC

---

## Sommaire

1. [Contexte](#contexte)
2. [Fonctionnalités](#fonctionnalités)
3. [Prérequis](#prérequis)
4. [Installation](#installation)
5. [Configuration](#configuration)
6. [Base de données](#base-de-données)
7. [Lancement](#lancement)
8. [Comptes de test](#comptes-de-test)
9. [Qualité & Tests](#qualité--tests)
10. [Architecture](#architecture)
11. [Captures d’écran](#captures-décran)
12. [Licence](#licence)

---

## Contexte

**Touche pas au klaxon** est une mini-application de covoiturage interne entre agences.

- Développée en **PHP 8.3+**
- Architecture **MVC personnalisée**
- Gestion des rôles (**visiteur**, **utilisateur**, **administrateur**)
- Persistance via **MySQL**
- Routage assuré par **izniburak/router**
- Interface responsive avec **Bootstrap 5** et **Bootstrap Icons**

---

## Fonctionnalités

### Côté visiteur :
- Consultation des trajets publics
- Authentification

### Côté utilisateur :
- Création de trajets
- Édition / suppression de ses trajets
- Consultation détaillée (modale)

### Côté administrateur :
- Tableau de bord
- Gestion des **utilisateurs**
- Gestion des **agences**
- Gestion des **trajets**
- Messages flash et retours visuels

---

## Prérequis

- PHP **8.3+**
- **Composer**
- **MySQL / MariaDB**
- **Node.js + npm** (si tu veux recompiler le SCSS)
- (Optionnel) XAMPP pour Apache + MySQL local

---

##  Installation

Clone le dépôt :

```bash
git clone https://github.com/dev-lea/touche_pas_au_klaxon.git
cd touche_pas_au_klaxon
composer install
```
Installe les dépendances front si besoin :
```bash
npm install
npm run sass:dev
```

---

## Configuration
Crée un fichier .env à la racine (ou copie .env.example) :

```ini
DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=touche_pas_au_klaxon
DB_USERNAME=root
DB_PASSWORD=
APP_DEBUG=1
```
Pour les tests automatiques, copie-le en .env.test.

---

## Base de données
1.Lance ton MySQL (port 3308 si XAMPP)
2.Crée la base :

```sql
CREATE DATABASE touche_pas_au_klaxon CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```
3.Importe les scripts :

```sql
database/migrations/001_create_tables.sql
database/seeds/001_seed.sql
```

---

## Lancement

```bash
composer serve
```

Puis ouvre :
http://localhost:4000

---

## Comptes de test 

| Rôle            | Email                                                         | Mot de passe |
| --------------- | ------------------------------------------------------------- | ------------ |
| **Admin**       | [alexandre.martin@email.fr](mailto:alexandre.martin@email.fr) | Password!23  |
| **Utilisateur** | [sophie.dubois@email.fr](mailto:sophie.dubois@email.fr)       | Password!23  |

---

## Qualité & Tests

PHPStan

Analyse statique :

```bash
composer stan
```

PHPUnit

Exécuter les tests :

```bash
composer test
```

Scripts disponibles

```bash
"scripts": {
  "serve": "php -S localhost:4000 -t public",
  "sass:dev": "sass --no-source-map --load-path=node_modules public/assets/scss/app.scss public/assets/css/app.css",
  "test": "phpunit",
  "stan": "phpstan analyse -l 5 app"
}
```
---

## Architecture

app/
 ├─ Controllers/
 ├─ Core/
 ├─ Models/
 └─ Views/
config/
database/
 ├─ migrations/
 └─ seeds/
public/
 ├─ assets/
 │   ├─ css/
 │   ├─ scss/
 └─ index.php
tests/

---

## Captures d’écran

Les captures se trouvent dans docs/screens/ :

- Accueil visiteur (visiteur.png)
- Accueil utilisateur (accueil_utilisateur.png)
- Détails trajet (details_utilisateur.png)
- Interface admin (header_admin.png)
- Message flash (message_flash.png)
- Agences admin (agences_admin.png)

---

## Licence

Projet pédagogique — Licence MIT
© 2025 — Touche pas au klaxon

```yaml
---

## Étapes à suivre maintenant

1. Crée le fichier :
   ```bash
   notepad README.md
```
colle le contenu ci-dessus

1.Sauvegarde
2.Fais :

```bash
git add README.md
git commit -m "docs: complete README (install, run, db, accounts, quality)"
git push
```

