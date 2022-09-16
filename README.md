# Laravel TripAdvisor

Le projet a pour but de reproduire certains aspects de TripAdvisor avec le framework PHP Laravel

J'ai fait une base de donnée sur docker

Le .env est déjà configuré pour faire tourner la bdd docker

Sinon il faut changer le .env

Pour le lancer en local: 
```bash
  docker-compose up -d
  composer install
  npm install
  php artisan migrate
  npm run build
  php artisan serv
```
   

Voici les features : 
```bash
    1. Login\Register\Reset-password
    2. Créer une place
    3. Modifier\Supprimer ses propres places
    4. Supprimer n'importe quel commentaire sous ses propres places
    5. Créer un commentaire avec une note sous n'importe quelle place et pouvoir le supprimer
```

