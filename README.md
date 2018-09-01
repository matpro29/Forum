forum
========================

Jest to mój pierwszy projekt PHP/Symfony, do jego poprawnego działania wymagany jest xampp.

Jak uruchomić?
--------------

Należy wykonać następujące polecenia:

  * cd xampp/htdocs

  * git clone git@github.com:matpro29/forum.git PhpProject1

  * cd PhpProject1

  * composer install
  
  * W app/config/parameters.yml podaj dane twojej bazy danych

  * php app/console doctrine:database:create

  * php app/console doctrine:schema:create
  
  * composer require friendsofsymfony/user-bundle "~1.3"
  
  Teraz możesz przejść do: http://localhost/PhpProject1/web
