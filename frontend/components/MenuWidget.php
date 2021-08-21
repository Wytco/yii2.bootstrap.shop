<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 07.05.2016
 * Time: 10:35
 */

namespace frontend\components;
use Yii;
use yii\base\Widget;
use frontend\models\Category;

class MenuWidget extends Widget
{

    public $template;
    public $data;
    public $tree;
    public $menuHtml;
    public $params;

    public function init()
    {
        parent::init();
        if ($this->template === null) {
            $this->template = 'menu';
        }
        $this->params = Yii::$app->params['languages'];
        $this->template .= '.php';
    }

    public function run()
    {
        //get cache
        if($this->tree == 'menu.php'){
            $menu = Yii::$app->cache->get('menu');
            if($menu) {
                return $menu;
            }
        }

        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);

        //set cache
        if($this->tree == 'menu.php'){
            //set cache 1 minute
            Yii::$app->cache->set('menu',$this->menuHtml,60);
        }


        return $this->menuHtml;
    }

    protected function getTree()
    {
        $tree = [];
        foreach ($this->data as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
            } else {
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
            }

        }
        return $tree;
    }

    protected function getMenuHtml($tree)
    {
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category);
        }
        return $str;
    }

    protected function catToTemplate($category)
    {
        ob_start();
        include __DIR__ . '/menu_template/' . $this->template;
        return ob_get_clean();
    }

}
