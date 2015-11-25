<?php

use Behat\MinkExtension\Context\MinkContext as Context;

/**
 * Features context.
 */
class FeatureContext extends Context {

    /**
     * @Given /^I am authenticated as "([^"]*)" using "([^"]*)"$/
     */
    public function iAmAuthenticatedAs($username, $password) {
        $this->visit('/login');
        $this->fillField('_username', $username);
        $this->fillField('_password', $password);
        $this->pressButton('_submit');
    }

    /**
     * @When /^I look for the repos of "([^"]*)"$/
     */
    public function iLookForTheReposOf($user) {
        $this->fillField('q', $user);
        $this->pressButton('_submit');
        $this->clickLink($user);
        $this->assertPageAddress('/'.$user.'/comment');
        $this->assertPageContainsText('Repositories of '.$user);
    }
}
