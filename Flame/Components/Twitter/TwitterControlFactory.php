<?php
/**
 * TwitterRSSFeedControlFactory.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Portfolio
 *
 * @date    30.08.12
 */

namespace Flame\Components\Twitter;

class TwitterControlFactory extends \Flame\Application\ControlFactory
{

	/**
	 * @var mixed
	 */
	private $config;

	/**
	 * @var TwitterLoader $twitterLoader
	 */
	private $twitterLoader;

	/**
	 * @var \Nette\Caching\Cache $cache
	 */
	private $cache;

	/**
	 * @var string
	 */
	private $cacheExpire = '+ 10 minutes';

	/**
	 * @param \Nette\Caching\Cache $cache
	 */
	public function injectCache(\Nette\Caching\Cache $cache)
	{
		$this->cache = $cache;
	}

	/**
	 * @param TwitterLoader $twitterLoader
	 */
	public function injectTwitterLoader(TwitterLoader $twitterLoader)
	{
		$this->twitterLoader = $twitterLoader;
	}

	/**
	 * @param $expirationLimit
	 */
	public function setCacheExpire($expirationLimit)
	{
		$this->cacheExpire = $expirationLimit;
	}

	/**
	 * @param $config
	 * @throws \Nette\InvalidStateException
	 */
	public function setConfig($config){
		if(!$config)
			throw new \Nette\InvalidStateException('No configuration given.');
		if(is_scalar($config))
			$config = array((is_numeric($config) ? 'userId' : 'screenName') => $config);

		$this->config = $config;

		if(!isset($this->config['userId']) && !isset($this->config['screenName']))
			throw new \Nette\InvalidStateException('No screenName/userId specified.');
	}

	/**
	 * @param null $data
	 * @return TwitterControl
	 */
	public function create($data = null)
	{
		$items = $this->getTwitterItems();
		return new TwitterControl($items ? $items : array());
	}

	/**
	 * @return mixed
	 * @throws \Nette\InvalidStateException
	 */
	protected function getTwitterItems()
	{
		if($this->config === null)
			throw new \Nette\InvalidStateException('No config specified');

		$key = 'twitter-' . json_encode($this->config);

		if(isset($this->cache[$key])){
			$items = $this->cache[$key];
		}else{
			$items = $this->twitterLoader->getTweets($this->config);
			$this->cache->save($key, $items, array(\Nette\Caching\Cache::EXPIRE => $this->cacheExpire));
		}

		return $items;
	}

}
