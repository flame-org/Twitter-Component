<?php
/**
 * TwitterControlTest.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame
 *
 * @date    04.11.12
 */

namespace Flame\Tests\Components\Twitter;

class TwitterControlTest extends \Flame\Tests\TestCase
{

	/**
	 * @var \Flame\Components\Twitter\TwitterControl
	 */
	private $twitterControl;

	public function setUp()
	{
		$this->twitterControl = new \Flame\Components\Twitter\TwitterControl(array());
	}

	public function testItems()
	{
		$this->assertAttributeCount(0, 'items', $this->twitterControl);
		$this->assertAttributeInstanceOf('\Nette\ArrayHash', 'items', $this->twitterControl);
	}

}
