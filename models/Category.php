<?php
/**
 * Created by PhpStorm.
 * User: dest2r4
 * Date: 19.10.2017
 * Time: 20:45
 */

namespace app\models;
use yii\db\ActiveRecord;


class Category extends ActiveRecord
{
        public static function tableName()
        {
            return 'category';
        }

        public function getProducts(){
            return $this->hasMany(Product::className(),['category_id'=>'id']);
        }
}