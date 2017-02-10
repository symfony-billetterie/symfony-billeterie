## BILLETERIE (SYMFONY 3)

### Wiki and Post-installation

   go to https://github.com/symfony-billetterie/symfony-billeterie/wiki

### Installattion

- $git clone git@github.com:symfony-billetterie/symfony-billeterie.git

- in your project folder run `composer install`

- add `192.168.33.33    billeterie.sf` in your hosts file
    - `/etc/hosts` on Linux and MAC
    - `C:\WINDOWS\system32\drivers\etc\hosts` on Windows

- in your project folder run `vagrant up`

- in your project folder run `vendor/bin/phing update:dev`

- go to http://billeterie.sf/app_dev.php/

- accces to vm phpmyadmin : http://billeterie.sf/phpmyadmin
### Pre-production

    go to http://billeterie.corentinregnier.fr

### Pull Request
    Pour mettre votre PR sur github il faut avant tout, tester les fonctionnalités, avoir faits toutes les 
    traductions de vos pages, avoir faire un jeu d'essai, et des controles de validations pour les formulaires. Quand
     une PR est faites et que c'est la votre consulter 
    le Insight pour voir cest votre branche en sort indemne, c'est à dire Platinium
