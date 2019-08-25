<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 25.08.2019
 * Time: 21:29
 */

namespace app\models;


use yii\db\ActiveRecord;

class Category extends ActiveRecord {

	public static function tableName() {
		return 'category';
	}

	public function getProducts (){
		return $this->hasMany(Product::className(), ['category_id' => 'id']);
	}
}