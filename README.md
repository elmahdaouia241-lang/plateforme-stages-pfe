# Plateforme de gestion de stages et PFE

Projet de fin d'études (PFE) du **DUT Génie Informatique** — École Supérieure de Technologie de Sidi Bennour (EST Sidi Bennour), Université Chouaib Doukkali — année universitaire 2025 – 2026.

Application web qui centralise le suivi des **stages** et des **projets de fin d'études** : les étudiants déposent leurs demandes et leurs documents, les encadrants suivent leurs étudiants, et l'administration valide les demandes et affecte les encadrants.

## Vidéo de démonstration

🎥 [Voir la démonstration de l'application (Google Drive)](https://drive.google.com/file/d/1jKJgWGwOz4Q5BBhGRnXltxNT768_3Q3F/view?usp=sharing)

## Fonctionnalités

- **Authentification** par rôle : étudiant, encadrant, administrateur
- **Étudiant** : inscription (cycle, filière, niveau, CNE), demande de stage, dépôt de documents, consultation des sujets de PFE
- **Encadrant** : espace dédié pour suivre ses étudiants et consulter les documents déposés
- **Administrateur** : tableau de bord, validation ou rejet des demandes, gestion des utilisateurs, affectation des encadrants
- **Messagerie** interne entre utilisateurs

## Technologies

| Couche | Outils |
|---|---|
| Back-end | PHP 8.1+, Laravel 10, Laravel Sanctum |
| Base de données | MySQL |
| Front-end | HTML, CSS, JavaScript (Blade) |
| Architecture | MVC |

## Modèle de données

| Table | Rôle |
|---|---|
| `users` | Comptes et rôles |
| `etudiants` | Profil étudiant (cycle, filière, niveau, CNE) |
| `encadrants` | Profil encadrant (spécialité) |
| `demandes_stage` | Demandes de stage (entreprise, ville, période, sujet, statut) |
| `documents` | Documents déposés et leur statut de validation |
| `student_encadrants` | Affectation encadrant / étudiant |
| `sujets_pfe` | Catalogue des sujets de PFE |
| `messages` | Messagerie interne |

## Installation

Prérequis : PHP 8.1+, Composer, MySQL (XAMPP convient).

```bash
git clone https://github.com/elmahdaouia241-lang/plateforme-stages-pfe.git
cd plateforme-stages-pfe

composer install
cp .env.example .env
php artisan key:generate
```

Créer une base MySQL, renseigner `DB_DATABASE`, `DB_USERNAME` et `DB_PASSWORD` dans `.env`, puis :

```bash
php artisan migrate
php artisan serve
```

L'application est disponible sur http://127.0.0.1:8000.

## Comptes de démonstration

L'interface crée au premier chargement un administrateur et quelques comptes de test **dans le navigateur (localStorage)**. Ces valeurs sont uniquement destinées à la démonstration :

| Rôle | Email | Mot de passe |
|---|---|---|
| Administrateur | `admin@example.com` | `admin123` |

Ne jamais réutiliser ces identifiants dans un environnement réel.

## Limites connues

Projet académique, non prévu pour la production :

- l'inscription publique accepte le rôle `admin` : à restreindre avant tout déploiement ;
- une partie de la logique (comptes de test, sujets) est gérée côté client dans `resources/views/welcome.blade.php` ;
- seules les routes d'authentification sont déclarées côté Laravel pour l'instant.

## Licence

Projet réalisé dans un cadre pédagogique.
