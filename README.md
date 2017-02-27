## BILLETTERIE (SYMFONY 3)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/2ae52ad7-6225-4680-a715-37e8d7ee20fb/mini.png)](https://insight.sensiolabs.com/projects/2ae52ad7-6225-4680-a715-37e8d7ee20fb)
[![License: GPL v3](https://img.shields.io/badge/License-GPL%20v3-blue.svg)](https://github.com/symfony-billetterie/symfony-billetterie/blob/master/LICENSE.md)
[![Build Status](http://jenkins.corentinregnier.fr/job/Billeterie/badge/icon)](http://jenkins.corentinregnier.fr/job/Billeterie/)
### Wiki and Post-installation

   go to https://github.com/symfony-billetterie/symfony-billetterie/wiki

### Installattion

- $git clone git@github.com:symfony-billetterie/symfony-billetterie.git

- in your project folder run `composer install`

- add `192.168.33.33    billetterie.sf` in your hosts file
    - `/etc/hosts` on Linux and MAC
    - `C:\WINDOWS\system32\drivers\etc\hosts` on Windows

- in your project folder run `vagrant up`

- in your project folder run `vendor/bin/phing update:dev`

- go to http://billetterie.sf/app_dev.php/

- accces to vm phpmyadmin : http://billetterie.sf/phpmyadmin
### Pre-production

    go to http://billetterie.corentinregnier.fr

### Pull Request
    Pour mettre votre PR sur github il faut avant tout, tester les fonctionnalités, avoir faits toutes les 
    traductions de vos pages, avoir faire un jeu d'essai, et des controles de validations pour les formulaires. Quand
    une PR est faites et que c'est la votre consulter le Insight pour voir cest votre branche en sort indemne, 
    c'est à dire Platinium.

###Comptes

####admin
    email: admin@gmail.com
    username: admin
    password: 1234
    
####observator
    email: observatory@gmail.com
    username: observatory
    password: 1234
    
####agent
    email: agent@gmail.com
    username: agent
    password: 1234

####beneficiary
    email: beneficiary@gmail.com
    username: beneficiary
    password: 1234
