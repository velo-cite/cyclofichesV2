# cyclofichesV2

### Instruction installation ###

=> installation de Wamp pour la BDD

=> installation symfony server
    https://symfony.com/download

    - permet la création de nouveau projet symfony
    - lancer un serveur local 
    - vérifie la sécurité du projet
    - MAJ des version

=> installation de composer
    - gestionnaire de dépendence pour PHP (sous Windows utiliser le .exe)
    https://getcomposer.org/download/

=> clone du projet depuis github
    -> dans un terminel 
        $: git clone https://github.com/velo-cite/cyclofichesV2-back.git

=> mise en place en local 
    -> dans le dossier
        $: composer install
        $: php bin/console doctrine:database:create
        $: php bin/console doctrine:migrations:migrate

=> lancement du serveur en local
        $: symfony server:start
    dans un nivagateur:
        - 127.0.0.1:8000 adresse de l'application en local
        - localhost adresse du phpMyAdmin username: root, pas de mpd