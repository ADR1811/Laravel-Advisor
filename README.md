# Laravel TripAdvisor

Le projet à pour but de reproduire certains aspect de TripAdvisor avec le framework PHP Laravel
J'ai fais une base de donnée sur docker
Le .env est déjà configurer pour faire tourné la bdd docker
Sinon changer le .env

Pour le lancer en local: 
```bash
  docker-compose up -d
  composer install
  npm install
  php artisan migrate
  php artisan serv
  npm run dev
```
   

Voici les features : 
```bash
    1. Login\Register\Reset-password
    2. Créer une place
    3. Modifer\Supprimer ses propres places
    4. Supprimer n'importe quel commentaires sous ses propres places
    5. Créer un commentaire avec une note sous n'importe quelle place et pouvoir le supprimer
```

