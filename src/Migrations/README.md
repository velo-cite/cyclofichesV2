commande à lancer au démarrage, et à tout moment pour mise à jour des données nécessaires au bon fonctionnement de l'appli :
`php bin/console doctrine:migrations:execute --up Version0`

exécute toutes les migrations (si pas déjà executées)
`php bin/console doctrine:migrations:migrate`

exécute une seule migration 
`php bin/console doctrine:migrations:execute --up version_numero_migration
`
ajoute une migrations à la base pour ne plus l'exécuter 
`php bin/console doctrine:migrations:version numero_migration --add
`