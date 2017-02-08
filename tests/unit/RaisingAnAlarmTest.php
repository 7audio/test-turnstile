<?php

/**
 * User Story: Raising an alarm
 * SCENARIO
 * Given the turnstile is locked
 * When I pass
 * An alarm is triggered
 * And If I add a coin
 * The alarm will end
 */

class RaisingAnAlarmTest extends \Codeception\Test\Unit
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

    public function testRaisingAlarm()
    {
        $this->turnstile->turn();

        $this->assertTrue($this->turnstile->getIsAlarmRinging());

        $this->turnstile->acceptCoin();

        $this->assertFalse($this->turnstile->getIsAlarmRinging());
    }
}