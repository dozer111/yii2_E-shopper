<?php
/**
 * Created by PhpStorm.
 * User: dest2r4
 * Date: 19.10.2017
 * Time: 20:56
 */

namespace app\components;
use yii\base\Widget;
use app\models\Category;
use Yii;


class MenuWidget extends Widget
{
    public $tpl;
    public $tree;
    public $dataDb;
    public $menuHtml;




    public function init()
    {
        parent::init();
        if ($this->tpl===null)
        {
            $this->tpl='menu';
        }
        $this->tpl.='.php';

    }

    public function run()
    {
        # get Cache
        $menu=Yii::$app->cache->get('menu');
        if($menu) return $menu;




        $this->dataDb=Category::find()->indexBy('id')->asArray()->all();
        #debug($this->dataDb);
        $this->tree=$this->getTree();
        $this->menuHtml=$this->getMenuHtml($this->tree);
        #debug($this->tree);
        # set Cache
        Yii::$app->cache->set('menu',$this->menuHtml,60);
        return $this->menuHtml;
    }

    # создание дерева с потомками
    protected function getTree(){
        $tree=[];
        foreach ($this->dataDb as $id=>&$node)
        {
            if(!$node['parent_id'])$tree[$id]=&$node;
            else $this->dataDb[$node['parent_id']]['childs'][$node['id']]=&$node;

        }
        return $tree;
    }

    # покдлючить шаблон и поместить в него данные
    protected function callToTemplate ($category){
        ob_start();
        include __DIR__.'/menu_tpl/'.$this->tpl;
        return ob_get_clean();
        # буферизация без вывода
    }

    # получить код готового єлемента навбара сайта
    protected function getMenuHtml ($tree){
        $str='';
        foreach ($tree as $category)
        {
            $str.=$this->callToTemplate($category);
        }
        return $str;
    }













}