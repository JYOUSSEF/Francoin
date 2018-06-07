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
    Then the header "Content-Type" should be equal to "application/json"

  Scenario: Checking the response type of the cities list
  	Given I am on the homepage
  	When I go to "http://localhost:8000/api/city"
    Then the response should be in JSON
    And the JSON should be equal to: 
    """
	  []
	"""