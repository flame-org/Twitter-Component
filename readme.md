# TwitterControl for Nette Framework [![Build Status](https://secure.travis-ci.org/flame-org/Twitter-Component.png?branch=master)](https://travis-ci.org/flame-org/Twitter-Component)

## About

TwitterControl is a simple but very powerful visual component for
Nette Framework for displaying tweets on your site.


## Installation

Preferred way of installation is using [Composer](http://getcomposer.org).
Add the following dependency to your `composer.json` file and you're ready to go.

```json
{
	"require": {
		"flame/twitter-component": "dev-master"
	}
}
```

## Usage

### In the config.neon

	common:
		parameters:
			twitter:
				screenName: JSifalda
				tweetCount: 10

				...


	services:
		Cache: Nette\Caching\Cache
		TwitterLoader: \Flame\Components\Twitter\TwitterLoader
			TwitterControlFactory:
				class: Flame\Components\Twitter\TwitterControlFactory
				setup:
					- setConfig(%twitter%)

### In presenter:

```php
<?php
	/**
	 * @var \Flame\Components\Twitter\TwitterControlFactory $twitterControlFactory
	 */
	private $twitterControlFactory;

	/**
	 * @param \Flame\Components\Twitter\TwitterControlFactory $twitterControlFactory
	 */
	public function injectTwitterControlFactory(\Flame\Components\Twitter\TwitterControlFactory $twitterControlFactory)
	{
		$this->twitterControlFactory = $twitterControlFactory;
	}

	/**
	 * @return \Flame\Components\Twitter\TwitterControl
	 */
	protected function createComponentTwitter()
	{
		return $this->twitterControlFactory->create();
	}
```

###In template

	{control twitter}

## Available config options

	screenName  Twitter screen name (either screenName or userId is required)
	userId      Twitter user ID (takes precedence over screenName, if both specified)
	tweetCount 		Number of tweets to load (max. 200)
	retweets    Include retweets
	replies     Include replies
