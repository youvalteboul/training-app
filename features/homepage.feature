Feature: Test homepage
  I need to be able to see the homepage

  Scenario: I can go the the homepage
    Given I go to "/"
    And I should see "Welcome"
    Then the response status code should be 200

  Scenario: I can go the the homepage
    Given I go to "/dsd"
    Then the response status code should be 404
