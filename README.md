## INSTALLATION

Il faut d'abord vider les caches de Laravel en éxecutant les commandes 
    
    php artisan cache:clear
    php artisan config:clear
    php artisan config:cache

Ensuite, il faut créer une base de données nomée Laravel dans votre serveur MariaDB.

Après la création de la base de données, il faut modifier les environnement de la base de données dans le fichier .env dans le dossier racine du projet

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=USERNAME_DE_VOTRE_SERVEUR
    DB_PASSWORD=MOT_DE_PASSE

Puis, éxecuter les commandes suivantes pour créer les tables et l'utilisateur:
    
    php artisan migrate
    php artisan db:seed

Pour lancer le projet, il faut éxecuter la commande : 
    
    php artisan serve

La partie front est accessible par le lien http://127.0.0.1:8000.

Le partie admin est accessible sur le lien http://127.0.0.1:8000/admin en utilisant le login
    email : company@company.com
    password : company
