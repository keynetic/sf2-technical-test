@javascript
Feature: Log in
  In order use app
  As a app user
  I need to be able to log in

  Scenario: Successful log in
    Given I am on "/login"
    When I fill in "_username" with "xtrmbkke"
    And I fill in "_password" with "Start666"
    And I press "_submit"
    Then I should be on "/search"

  Scenario: Unsuccessful log in
    Given I am on "/login"
    When I fill in "_username" with "error"
    And I fill in "_password" with "error"
    And I press "_submit"
    Then I should be on "/login"
