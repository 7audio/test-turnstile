<?php

/**
 * Turnstile that allows you to pass after you insert a coin
 */

class Turnstile
{
	/**
	 * @var bool lock state
	 */
	protected $isLocked = true;

	/**
	 * @var bool alarm state
	 */
	protected $isAlarmRinging = false;

	/**
	 * Accepts a coin from somebody willing to pass
	 */
	public function acceptCoin()
	{
		$this->isLocked = false;
		$this->shutAlarm();
	}

	/**
	 * Turns the turnstile attempting to pass
	 */
	public function turn()
	{
		if ($this->isLocked) {
			$this->raiseAlarm();
		}
		else {
			$this->isLocked = true;
		}
	}

	/**
	 * Gets lock state
	 * @return bool is the turnstile locked
	 */
	public function getIsLocked()
	{
		return $this->isLocked;
	}

	/**
	 * Gets alarm state
	 * @return bool is alarm ringing now
	 */
	public function getIsAlarmRinging()
	{
		return $this->isAlarmRinging;
	}

	/**
	 * Raises alarm
	 */
	protected function raiseAlarm()
	{
		$this->isAlarmRinging = true;
	}

	/**
	 * Shuts alarm off
	 */
	protected function shutAlarm()
	{
		$this->isAlarmRinging = false;
	}
}
