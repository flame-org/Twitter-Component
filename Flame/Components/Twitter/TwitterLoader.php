<?php
/**
 * TwitterLoader.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame
 *
 * @date    12.10.12
 */

namespace Flame\Components\Twitter;

use Nette\Http\Url;
use Nette\Utils\Json;
use Nette\Utils\JsonException;


class TwitterLoader extends \Nette\Object
{

	/**
	 * Defaults config
	 * @var array
	 */
	private $config = array(
		'userId' => null,
		'screenName' => null,
		'tweetCount' => 10,
		'retweets' => true,
		'replies' => true
	);

	/**
	 * @param array $config
	 * @return mixed
	 * @throws TwitterException
	 */
	public function getTweets(array $config)
	{

		$this->config = $config + $this->config;

		$path = (string) $this->generateRequestUrl();
		$content = @file_get_contents($path);

		if($content){
			try{
				return Json::decode($content);
			} catch(JsonException $e){
				throw new TwitterException($e->getMessage(), $e->getCode(), $e);
			}
		}
	}

	/**
	 * Generate URL for Twitter JSON API request.
	 * @return Url
	 */
	protected function generateRequestUrl(){
		$url = new Url('https://api.twitter.com/1/statuses/user_timeline.json');

		if($this->config['userId'])
			$url->appendQuery('user_id=' . $this->config['userId']);
		elseif($this->config['screenName'])
			$url->appendQuery('screen_name=' . $this->config['screenName']);

		if($this->config['tweetCount'])
			$url->appendQuery('count=' . $this->config['tweetCount']);
		if($this->config['retweets'])
			$url->appendQuery('include_rts=true');
		if(!$this->config['replies'])
			$url->appendQuery('exclude_replies=true');

		$url->appendQuery('include_entities=true');
		return $url;
	}

}

class TwitterException extends \Exception {}