<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Comments model
 *
 */
class Comments extends \yii\db\ActiveRecord
{
   
   public static function tableName()
	{
		return 'comments';
	}

    /**
     * Finds user by [[(author_id)]]
     *
     * @return User|null
     */
    public function getUsers()
	{
		return $this->hasOne ( Users::className ( ) , [ 'id' => 'author_id' ] );
	}
}
