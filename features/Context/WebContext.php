<?php

namespace Context;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Definition\Call\Then;
use Behat\Behat\Tester\Exception\SkippedException;
use Behat\Mink\Exception\ElementNotFoundException;

/**
 * Defines application features from the specific context.
 */
class WebContext extends MinkContext implements SnippetAcceptingContext
{
    
    /**
     * @When I fill :arg1 with :arg2
     */
    public function iFillWith($arg1, $arg2)
    {
        //throw new PendingException();
    }

    /**
     * @When I wait :arg1 seconds
     */
    public function iWaitSeconds($arg1)
    {
        $this->getSession()->wait($arg1 * 1000);
    }

}
