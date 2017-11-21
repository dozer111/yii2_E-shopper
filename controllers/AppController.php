<?php
/**
 * Created by PhpStorm.
 * User: dest2r4
 * Date: 20.10.2017
 * Time: 17:24
 */

namespace app\controllers;
use yii\web\Controller;

class AppController extends Controller
{
    protected function setMeta($title=null,$keywords=null,$description=null){

        $this->view->title=$title;
       $this->view->registerMetaTag(['name'=>'keywords','content'=>"$keywords"]);
        $this->view->registerMetaTag(['name'=>'description','content'=>"$description"]);



    }

}