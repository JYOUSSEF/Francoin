<?php

namespace Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class TestContext implements Context
{

    /**
     * @When I Add :arg1 to :arg2
     */
    public function iAddTo($arg1, $arg2)
    {
        $this->total = $arg1 + $arg2;
    }

    /**
     * @Then I should see total equal to :arg1
     */
    public function iShouldSeeTotalEqualTo($arg1)
    {
        if ($this->total != $arg1) {
            throw new \Exception($this->total . " is not Equal to " . $arg1);
        }
    }

}
