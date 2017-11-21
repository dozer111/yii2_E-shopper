<?php
/**
 * Created by PhpStorm.
 * User: dest2r4
 * Date: 24.10.2017
 * Time: 14:08
 */

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;

class ProductController extends AppController
{
    public function actionView ($id)
    {
        # get id from GET parameters
        $id=Yii::$app->request->get('id');
        $product=Product::findOne($id);

        # error Handler
        if(empty($product))throw new \yii\web\HttpException(404, 'OOPS, this Item  was not found');

        $hits=Product::find()->where(['hit'=>'1'])->limit(6)->all();
        $this->setMeta("E-Shopper |{$product['name']}",$product["keywords"],$product['description']);
        return $this->render('view',compact('product','hits'));

    }














}