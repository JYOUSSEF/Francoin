Feature: User List
  Test de la page api/user qui est sensée afficher la liste des utilisateurs

  Scenario: La page d'accueil affiche bien la liste des utilisateurs
    When I send a "GET" request to "/user"
    Then I should see "Hello World"