<?php

/**
 * User Story: Locking the turnstile
 * SCENARIO
 * Given the turnstile is unlocked
 * When I pass trough the turnstile
 * The turnstile will lock
 */

class LockingTest extends \Codeception\Test\Unit
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

        // make sure the turnstile is unlocked, otherwise put coin to unlock
        if ($this->turnstile->getIsLocked()) {
            $this->turnstile->acceptCoin();
        }
    }

    protected function _after()
    {
    }

    public function testAutoLocking()
    {
        $this->turnstile->turn();

        $this->assertTrue($this->turnstile->getIsLocked());
    }
}