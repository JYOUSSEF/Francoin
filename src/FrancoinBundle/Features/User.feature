Feature: Checking User Controller
  Testing the User Rest Controller "/api/user"

  Scenario: Checking the response type of the user's list
  	Given I send a "GET" request to "http://localhost:8000/api/user"
    Then the response should be in JSON
    Then the header "Content-Type" should be equal to "application/json"
    Then the response status code should be "200"

  Scenario: Testing the url to add new User
  	Given I send a "POST" request to "http://localhost:8000/api/user/new" with body:
	"""
	{
	    "username": "test",
	    "email": "test@gmail.com",
	    "password": "test",
	    "roles": ["ROLE_USER"],
	    "firstname": "Youssef",
	    "lastname": "Jalal",
	    "adresse": "27 rue leon fontaine",
	    "phone": "0755430983"
	}
	"""
	Then the response should be in JSON
	Then the header "Content-Type" should be equal to "application/json"
	Then the response status code should be "200"
	Then the JSON node "id" should exist
	And I save it into "ID"

  Scenario: Testing the url to get a User
  	Given I send a "GET" request to "http://localhost:8000/api/user/<<ID>>"
  	Then the response should be in JSON
	Then the header "Content-Type" should be equal to "application/json"
	Then the response status code should be "200"
	Then the JSON node "id" should exist
	Then the JSON should be equal to:
	"""
	{
		"id": <<ID>>,
		"username": "test",
		"username_canonical": "test",
		"email": "test@gmail.com",
		"email_canonical": "test@gmail.com",
		"enabled": false,
		"password": "test",
		"roles": [],
		"firstname": "Youssef",
		"lastname": "Jalal",
		"adresse": "27 rue leon fontaine",
		"phone": "0755430983"
	}
	"""

  Scenario: Testing the url to update a User
  	Given I send a "PUT" request to "http://localhost:8000/api/user/<<ID>>" with body:
	"""
	{
	    "adresse": "27 rue leon fontaine, 95210"
	}
	"""
	Then the response should be in JSON
	Then the header "Content-Type" should be equal to "application/json"
	Then the response status code should be "200"
	And the JSON node "adresse" should be equal to "27 rue leon fontaine, 95210"
	Then the JSON should be equal to:
	"""
	{
		"id": <<ID>>,
		"username": "test",
		"username_canonical": "test",
		"email": "test@gmail.com",
		"email_canonical": "test@gmail.com",
		"enabled": false,
		"password": "test",
		"roles": [],
		"firstname": "Youssef",
		"lastname": "Jalal",
		"adresse": "27 rue leon fontaine, 95210",
		"phone": "0755430983"
	}
	"""

  Scenario: Testing the url to delete a User
  	Given I send a "DELETE" request to "http://localhost:8000/api/user/<<ID>>"
	Then the response should be in JSON
	Then the header "Content-Type" should be equal to "application/json"
	Then the response status code should be "200"
