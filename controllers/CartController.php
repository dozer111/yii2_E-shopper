<?php
/**
 * Created by PhpStorm.
 * User: dest2r4
 * Date: 25.10.2017
 * Time: 12:01
 */

namespace app\controllers;
use app\models\Product;
use app\models\Cart;
use Yii;


class CartController extends AppController
{
    public function actionAdd ()
    {
        $id=Yii::$app->request->get('id');
        $product=Product::findOne($id);
        if(empty($product))return false;
        $session=Yii::$app->session;
        $session->open();
        $cart= new Cart();
        $cart->addToCart($product);
        #отключить шаблон для таблицы
        $this->layout=false;
        return $this->render('cart-modal',compact('session'));
     /*   debug($session['cart']);
        debug($session['cart.qty']);
        debug($session['cart.sum']);*/
    }

    public function actionDelItem()
        {

        $id=Yii::$app->request->get('id');
        $session=Yii::$app->session;
        $session->open();
        $cart=new Cart();
        $cart->recalc($id);
        $this->layout=false;
        return $this->render('cart-modal',compact('session'));
            #return  "<script>alert('lskdfmlsdifsi')</script> ";
}


    public function actionShow()
    {
        $id=Yii::$app->request->get('id');
        $session=Yii::$app->session;
        $session->open();
        $this->layout=false;
        return $this->render('cart-modal',compact('session'));
    }






































}