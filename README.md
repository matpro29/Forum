symfony-forum
========================

Jest to mój pierwszy projekt PHP z wykorzystanie Symfony, do jego poprawnego działania wymagany jest xampp z PHP 5.6.

Xampp: https://sourceforge.net/projects/xampp/

Jak uruchomić?
--------------

Należy wykonać następujące polecenia:

  * cd xampp/htdocs

  * git clone git@github.com:matpro29/symfony-forum.git

  * cd symfony-forum

  * composer install

  * php app/console doctrine:database:create

  * php app/console doctrine:schema:create
  
  * composer require friendsofsymfony/user-bundle "~1.3"
  
  Teraz możesz przejść do: http://localhost/symfony-forum/web
