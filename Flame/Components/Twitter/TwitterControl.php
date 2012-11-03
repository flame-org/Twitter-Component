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
	protected $items = array();

	/**
	 * @param $items
	 */
	public function setItems($items)
	{
		if(is_array($items)){
			$this->items = \Nette\ArrayHash::from($items);
		}else{
			$this->items = $items;
		}
	}

	public function render()
	{
		$this->template->setFile(__DIR__ . '/TwitterControl.latte');
		$this->template->items = $this->items;
		parent::render();
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
