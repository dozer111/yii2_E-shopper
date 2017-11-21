<?php
/**
 * Created by PhpStorm.
 * User: dest2r4
 * Date: 20.10.2017
 * Time: 17:20
 */

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;


class CategoryController extends AppController
{
    public function actionIndex(){
        $hits=Product::find()->where(['hit'=>'1'])->limit(6)->all();
        #debug($hits);
        $this->setMeta('new Title');
        return $this->render('index',compact('hits'));
    }

    public function actionView($id)
    {
        $id=Yii::$app->request->get('id');

        $category=Category::findOne($id);

        # error Handler
        if(empty($category))throw new \yii\web\HttpException(404, 'OOPS, this Category was not found');

        # pagination
        $query=Product::find()->where(['category_id'=>$id]);
        $pages= new Pagination(['totalCount'=>$query->count(),'pageSize'=>3,
            'forcePageParam'=>false,
            'pageSizeParam'=>false
            ]);
        $products=$query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta("E-Shopper |{$category['name']}",$category["keywords"],$category['description']);
        return $this->render('view',compact('products','pages','category'));

    }


    public function actionSearch ()
    {
        $q=trim(Yii::$app->request->get('q'));
        $this->setMeta('E-Shopper '.$q);
        if(!$q)return $this->render('search');

        $query=Product::find()->where(['like','name',$q]);
        $pages= new Pagination(['totalCount'=>$query->count(),'pageSize'=>3,
            'forcePageParam'=>false,
            'pageSizeParam'=>false
        ]);
        $products=$query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search',compact('products','pages','q'));



    }













}