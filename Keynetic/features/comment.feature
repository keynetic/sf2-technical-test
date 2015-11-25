@javascript
Feature: Comment
  In order use app
  As a app user
  I need to be able to log in

  Scenario: Access denied
    Given I am on "/ornicar/comment"
    Then I should be on "/login"

  Scenario: Github user has repos
    Given I am on homepage
    When I look for the repos of "ornicar"
    Then I should be on "/ornicar/comment"
    And I should see "Repos of ornicar"

  Scenario: Successful comment
    Given I am authenticated as "xtrmbkke" using "Start666"
    And I am on "/ornicar/comment"
    When I fill in "comment[body]" with "new comment"
    And I press "comment[save]"
    Then I should see "new comment"