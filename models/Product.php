<?php
/**
 * Created by PhpStorm.
 * User: dest2r4
 * Date: 19.10.2017
 * Time: 20:50
 */

namespace app\models;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
public static function tableName()
{
    return 'product';
}

public function getCategory(){
    // 1 продукт == 1 категория
    return $this->hasOne(Category::className(),['id'=>'category_id']);
}

}