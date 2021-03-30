<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Users model
 *
 */
class Users extends \yii\db\ActiveRecord
{
   
   public static function tableName()
	{
		return 'users';
	}

    /**
     * Finds posts by [[user ID (author_id)]]
     *
     * @return Posts collections|null
     */
    public function getPosts()
	{
		return $this->hasMany(Posts::className(), ['author_id' => 'id']);
	}
}
