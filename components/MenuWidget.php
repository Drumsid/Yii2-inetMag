<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 25.08.2019
 * Time: 21:40
 */

namespace app\components;


use app\models\Category;
use yii\base\Widget;

class MenuWidget extends Widget {

	public $tpl;
	public $data;
	public $tree;
	public $menuHtml;

	public function init() {
		parent::init(); // TODO: Change the autogenerated stub
		if ($this->tpl === null){
			$this->tpl = 'menu';
		}
		$this->tpl .= '.php';
	}

	public function run() {

		$this->data = Category::find()->indexBy('id')->asArray()->all();
		$this->tree = $this->getTree();
		$this->menuHtml = $this->getMenuHtml($this->tree);
//		debug($this->tree);

		return $this->menuHtml;
	}

	public function getTree() {
		$tree = [];
		foreach ($this->data as $id => &$node) {
			if (!$node['parent_id']) {
				$tree[$id] = &$node;
			}
			else {
				$this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
			}
		}
		return $tree;
	}

	public function getMenuHtml ($tree) {
		$str = '';
		foreach ($tree as $category) {
			$str .= $this->CatToTemplate($category);
		}
		return $str;
	}

	public function CatToTemplate ($category) {
		ob_start();
		include __DIR__ . '/menu_tpl/' . $this->tpl;
		return ob_get_clean();
	}
}