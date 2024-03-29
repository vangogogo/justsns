<?php
/**
 * BootTopBar class file.
 * @author Herbert Maschke<thyseus@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version 0.1-test
 * 
 * The Navigation Menu is a modified variant of the CMenu Widget of
 * Qiang Xue.
 */

Yii::import('ext.bootstrap.widgets.BootWidget');

class BootTopbar extends BootWidget
{
	public $template = '{dt} {dti} {c} {title} {nav1} {search} {nav2} {cdt} {cdti} {cc}';
	public $search = '<form class="pull-left" action=""><input type="text" placeholder="Search"></form>';

	public $items = array();
	public $items2 = array();

	public $homeUrl = array('//site/index');

    public $container_class = 'container';
	public $menu_nav1 = null;
	public $menu_nav2 = null;
	public $activeCssClass = 'active';
	public $firstItemCssClass = '';
	public $lastItemCssClass = '';
	public $linkLabelWrapper = null;
	public $submenuHtmlOptions = array('class' => 'dropdown-menu');
	public $encodeLabel = true;

	public function init()
	{

		// Load the necessary javascript
		Yii::app()->clientScript->registerScriptFile(
				Yii::app()->getAssetManager()->publish(
					Yii::getPathOfAlias(
						'ext.bootstrap.vendors.bootstrap.js').'/bootstrap-dropdown.js'));

		Yii::app()->clientScript->registerScript('topbar-dropdown', "
				$('#topbar').dropdown()
				");

		// prepare the Navigation, if available
		$route=$this->getController()->getRoute();
		$this->items=$this->normalizeItems($this->items,$route,$hasActiveChild);

		if(count($this->items))
		{
			$this->menu_nav1 = '<ul class="nav">';
			$this->menu_nav1 .= $this->renderMenuRecursive($this->items);
			$this->menu_nav1 .= '</ul>';
		}

		if(count($this->items2))
		{
			$this->menu_nav2 = '<ul class="nav secondary-nav">';
			$this->menu_nav2 .= $this->renderMenuRecursive($this->items2);
			$this->menu_nav2 .= '</ul>';
		}


	}

	protected function renderMenuRecursive($items)
	{
		if(!isset($return))
			$return = '';
		$count=0;
		$n=count($items);
		foreach($items as $item)
		{
			$count++;
			$options=isset($item['itemOptions']) ? $item['itemOptions'] : array();
			$class=array();
			if(@$item['active'] && $this->activeCssClass!='')
				$class[]=$this->activeCssClass;
			if($count===1 && $this->firstItemCssClass!='')
				$class[]=$this->firstItemCssClass;
			if($count===$n && $this->lastItemCssClass!='')
				$class[]=$this->lastItemCssClass;
			if($class!==array())
			{
				if(empty($options['class']))
					$options['class']=implode(' ',$class);
				else
					$options['class'].=' '.implode(' ',$class);
			}

			if(isset($item['items']) && count($item['items']))  {
				if(isset($options['class']))
					$options['class'] .= ' dropdown';
				else
					$options['class'] = 'dropdown';
				$options['data-dropdown'] = 'dropdown';
			}
			$return .= CHtml::openTag('li', $options);

			$menu=$this->renderMenuItem($item);
			if(isset($item['items']) && count($item['items']))
			{
				$return .= sprintf('<a class="dropdown-toggle" href="#">%s</a>',
						$item['label']);
				$return .= "\n".CHtml::openTag('ul',isset($item['submenuOptions']) ? $item['submenuOptions'] : $this->submenuHtmlOptions)."\n";
				$return .= $this->renderMenuRecursive($item['items']);
				$return .= CHtml::closeTag('ul')."\n";
			} else if(isset($this->itemTemplate) || isset($item['template']))
			{
				$template=isset($item['template']) ? $item['template'] : $this->itemTemplate;
				$return .= strtr($template,array('{menu}'=>$menu));
			}
			else
				$return .= $menu;


			$return .= CHtml::closeTag('li')."\n";
		}
		return $return;
	}

	protected function renderMenuItem($item)
	{
		if(isset($item['url']))
		{
			$label=$this->linkLabelWrapper===null ? $item['label'] : '<'.$this->linkLabelWrapper.'>'.$item['label'].'</'.$this->linkLabelWrapper.'>';
			return CHtml::link($label,$item['url'],isset($item['linkOptions']) ? $item['linkOptions'] : array());
		}
		else
			return CHtml::tag('span',isset($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
	}

	protected function normalizeItems($items,$route,&$active)
	{
		foreach($items as $i=>$item)
		{
			if(isset($item['visible']) && !$item['visible'])
			{
				unset($items[$i]);
				continue;
			}
			if(!isset($item['label']))
				$item['label']='';
			if($this->encodeLabel)
				$items[$i]['label']=CHtml::encode($item['label']);
			$hasActiveChild=false;
			if(isset($item['items']))
			{
				$items[$i]['items']=$this->normalizeItems($item['items'],$route,$hasActiveChild);
				if(empty($items[$i]['items']) && $this->hideEmptyItems)
					unset($items[$i]['items']);
			}
			if(!isset($item['active']))
			{
				if($hasActiveChild || $this->isItemActive($item,$route))
					$active=$items[$i]['active']=true;
				else
					$items[$i]['active']=false;
			}
			else if($item['active'])
				$active=true;
		}
		return array_values($items);
	}

	/**
	 * Checks whether a menu item is active.
	 * This is done by checking if the currently requested URL is generated by the 'url' option
	 * of the menu item. Note that the GET parameters not specified in the 'url' option will be ignored.
	 * @param array $item the menu item to be checked
	 * @param string $route the route of the current request
	 * @return boolean whether the menu item is active
	 */
	protected function isItemActive($item,$route)
	{
		if(isset($item['url']) && is_array($item['url']) && !strcasecmp(trim($item['url'][0],'/'),$route))
		{
			if(count($item['url'])>1)
			{
				foreach(array_splice($item['url'],1) as $name=>$value)
				{
					if(!isset($_GET[$name]) || $_GET[$name]!=$value)
						return false;
				}
			}
			return true;
		}
		return false;
	}


	/**
	 * Runs the widget.
	 */
	public function run()
	{

		echo strtr($this->template, array(
					'{dt}' => '<div class="topbar">',
					'{dti}' => '<div class="topbar-inner">',
					'{c}' => '<div class="'.$this->container_class.'">',
					'{title}' => CHtml::link(Yii::app()->name, 
						$this->homeUrl, array('class' => 'brand')),
					'{nav1}' => $this->menu_nav1,
					'{nav2}' => $this->menu_nav2,
					'{search}' => $this->search,
					'{cdt}' => '</div> <!-- topbar -->',
					'{cdti}' => '</div> <!-- topbar-inner -->',
					'{cc}' => '</div> <!-- '.$this->container_class.' -->',
					));

		parent::run();
	}

}
