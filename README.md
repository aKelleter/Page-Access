# Access Page

Ce projet est une page d'accès sécurisée pour héberger du contenu privé. Il utilise PHP pour gérer les sessions et les requêtes POST.

## Prérequis

- PHP 7.4 ou supérieur
- Un serveur web (Apache, Nginx, etc.)

## Installation

1. Clonez le dépôt :
    ```sh
    git clone https://votre-repo.git
    cd access-page
    ```

2. Configurez votre serveur web pour pointer vers le répertoire du projet.

## Configuration

Assurez-vous que les constantes `APP_TITLE`, `APP_SUBTITLE`, et `SECRET_CODE` sont définies dans le fichier [conf.php](http://_vscodecontentref_/0).

## Utilisation

1. Accédez à la page d'accueil de votre projet via votre navigateur web.
2. Entrez le code secret pour accéder aux services disponibles.
3. Utilisez le bouton "sign out" pour vous déconnecter.

## Structure du projet

- [index.php](http://_vscodecontentref_/1) : Le point d'entrée principal de l'application.
- [conf.php](http://_vscodecontentref_/2) : Fichier de configuration contenant les constantes de l'application.
- [functions.php](http://_vscodecontentref_/3) : Fichier contenant les fonctions utilitaires pour l'application.
- [vendors](http://_vscodecontentref_/4) : Répertoire contenant les dépendances installées via Composer.

## Sécurité

- Les sessions sont sécurisées avec des paramètres de cookie stricts.
- Les en-têtes de sécurité HTTP sont définis pour renforcer la sécurité.

Contribuer
Les contributions sont les bienvenues ! Veuillez soumettre une pull request ou ouvrir une issue pour discuter des changements que vous souhaitez apporter.

Licence
Ce projet est sous licence GPLv3. Voir le fichier LICENSE pour plus de détails.
