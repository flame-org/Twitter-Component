<?php
/**
 * TwitterRSSFeedControl.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Portfolio
 *
 * @date    30.08.12
 */

namespace Flame\Components\Twitter;

class TwitterControl extends \Flame\Application\UI\Control
{

	/**
	 * @var array
	 */
	protected $items;

	/**
	 * @param $items
	 */
	public function __construct(array $items)
	{
		parent::__construct();
		$this->items = \Nette\ArrayHash::from($items);
	}

	public function render()
	{
		$this->template->setFile(__DIR__ . '/TwitterControl.latte');
		$this->template->items = $this->items;
		$this->template->render();
	}

	/**
	 * @param null $class
	 * @return \Nette\Templating\ITemplate
	 */
	public function createTemplate($class = null)
	{
		$template = parent::createTemplate($class);
		$template->registerHelperLoader(\Nette\Callback::create(new TwitterFormatter(), 'loader'));
		return $template;
	}

}
