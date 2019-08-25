<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 25.08.2019
 * Time: 21:35
 */

namespace app\models;


use yii\db\ActiveRecord;

class Product extends ActiveRecord {

	public static function tableName() {
		return 'product';
	}

	public function getProducts (){
		return $this->hasOne(Category::className(), ['id' => 'category_id']);
	}
}