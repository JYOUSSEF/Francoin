## Description
Francoin est une Web Application des petites annonces en France.

## Stack Technique
Symfony : 3.4

FOSUserBundle

FOSRestBundle

Behat

PHPUnit


## Steps To Do After Cloning The Project

composer install


## Unit Test

vendor/bin/simple-phpunit


## Functional Test

### Running Selenium server :

java -Dwebdriver.chrome.driver="selenium/chromedriver" -jar selenium/selenium.jar

### Running Behat Test :

vendor/bin/behat --suite=francoin_suite --append-snippets


