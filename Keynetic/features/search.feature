@javascript
Feature: Search users on Github
  In order to find a Github user
  As a app user
  I need to be able to search for a user

  Scenario: Access denied
    Given I am on the homepage
    Then I should be on "/login"

  Scenario: Unsuccessful search
    Given I am authenticated as "xtrmbkke" using "Start999"
    When I fill in "q" with "CachedHttpClient"
    And I press "_submit"
    Then I should see "No results"

  Scenario: Successful search
    Given I am authenticated as "xtrmbkke" using "Start999"
    When I fill in "q" with "ornicar"
    And I press "_submit"
    Then I should see "Results"
    And I should see "ornicar"