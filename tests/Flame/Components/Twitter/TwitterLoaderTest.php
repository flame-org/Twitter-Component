<?php
/**
 * TwitterLoaderTest.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame
 *
 * @date    04.11.12
 */

namespace Flame\Tests\Components\Twitter;

class TwitterLoaderTest extends \Flame\Tests\TestCase
{

	/**
	 * @var \Flame\Components\Twitter\TwitterLoader
	 */
	private $twitterLoader;

	public function setUp()
	{
		$this->twitterLoader = new \Flame\Components\Twitter\TwitterLoader();
	}

	public function testDefaultConfig()
	{
		$config = array(
			'userId' => null,
			'screenName' => null,
			'tweetCount' => 10,
			'retweets' => true,
			'replies' => true
		);

		$this->assertAttributeEquals($config, 'config', $this->twitterLoader);
	}

	public function testGetTweets()
	{
		$this->assertNotNull($this->twitterLoader->getTweets(array('screenName' => 'JSifalda')));
		$this->assertNotSame(false, $this->twitterLoader->getTweets(array('screenName' => 'JSifalda')));
	}

}
