Feature: Checking User Controller
  Checking if the page "/api/user" will show the user's list
 
  Scenario: Checking the status code of the user's list
  	Given I am on the homepage
  	When I go to "http://localhost:8000/api/user"
    Then the response status code should be "200"

  Scenario: Checking the response type of the user's list
  	Given I am on the homepage
  	When I go to "http://localhost:8000/api/user"
    Then the response should be in JSON