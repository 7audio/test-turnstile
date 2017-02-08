<?php

/**
 * User Story: Unlocking the turnstile
 * SCENARIO
 * Given the turnstile is locked
 * When I add a coin
 * The turnstile will unlock
 */

class UnlockingTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \Turnstile
     */
    protected $turnstile;

    protected function _before()
    {
        $this->turnstile = new Turnstile;

        // make sure the turnstile is locked, otherwise lock it
        if (!$this->turnstile->getIsLocked()) {
            $this->turnstile->turn();
        }
    }

    protected function _after()
    {
    }

    public function testUnlockingWithCoin()
    {
        $this->turnstile->acceptCoin();

        $this->assertFalse($this->turnstile->getIsLocked());
    }
}