<?php
/**
 * TwitterControlFactoryTest.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame
 *
 * @date    04.11.12
 */

namespace Flame\Tests\Components\Twitter;

class TwitterControlFactoryTest extends \Flame\Tests\TestCase
{

	/**
	 * @var \Flame\Components\Twitter\TwitterControlFactory
	 */
	private $twitterControlFactory;

	public function setUp()
	{
		$this->twitterControlFactory = new \Flame\Components\Twitter\TwitterControlFactory();
	}

	/**
	 * @expectedException \Nette\InvalidStateException
	 */
	public function testSetConfigFalse()
	{
		$this->twitterControlFactory->setConfig(false);
	}

	/**
	 * @expectedException \Nette\InvalidStateException
	 */
	public function testSetConfigWithoutRequired()
	{
		$this->twitterControlFactory->setConfig(array());
	}

	public function testSetConfigWithoutArray()
	{
		$this->twitterControlFactory->setConfig('335345');
		$this->assertAttributeEquals(array('userId' => '335345'), 'config', $this->twitterControlFactory);

		$this->twitterControlFactory->setConfig('name');
		$this->assertAttributeEquals(array('screenName' => 'name'), 'config', $this->twitterControlFactory);
	}

	/**
	 * @expectedException \Nette\InvalidStateException
	 */
	public function setGetTwitterItemsWithoutConfig()
	{
		$createComponentMethod = new \ReflectionMethod('\Flame\Components\Twitter\TwitterControlFactory', 'getTwitterItems');
		$createComponentMethod->setAccessible(true);

		$createComponentMethod->invoke($this->twitterControlFactory);
	}

	public function testGetTwitterItemsWithoutCache()
	{
		//TODO: create Cache mock

//		$this->twitterControlFactory->setConfig('screenName');
//
//		$twitterLoaderMock = $this->getMock('\Flame\Components\Twitter\TwitterLoader');
//		$twitterLoaderMock->expects($this->once())
//			->method('getTweets')
//			->with($this->equalTo(array('screenName' => 'screenName')))
//			->with(array());
//
//		$this->twitterControlFactory->injectTwitterLoader($twitterLoaderMock);
//
//		$createComponentMethod = new \ReflectionMethod('\Flame\Components\Twitter\TwitterControlFactory', 'getTwitterItems');
//		$createComponentMethod->setAccessible(true);
//
//		$this->assertEquals(array(), $createComponentMethod->invoke($this->twitterControlFactory));

	}

}
