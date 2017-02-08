<?php

/**
 * User Story: Gracefuly eating money
 * SCENARIO
 * Given the turnstile is locked
 * When I add a coin
 * And then another coin
 * The turnstile will be unlocked
 * And If I pass The turnstile will be locked
 */

class GracefullyEatingMoneyTest extends \Codeception\Test\Unit
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
        unset($this->turnstile);
    }

    public function testEatingMoney()
    {
        $this->turnstile->acceptCoin();
        $this->turnstile->acceptCoin();

        $this->assertFalse($this->turnstile->getIsLocked());

        $this->turnstile->turn();

        $this->assertTrue($this->turnstile->getIsLocked());
    }
}