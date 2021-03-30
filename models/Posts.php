<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Posts model
 *
 */
class Posts extends \yii\db\ActiveRecord
{
   
   public static function tableName()
	{
		return 'posts';
	}

   /**
     * Finds comments by [[(post_id)]]
     *
     * @return Comments collection|null
     */
    public function getComments()
	{
		return $this->hasMany(Comments::className(), ['post_id' => 'id']);
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
	
	 /**
     * Finds comments with users by [[(post_id)]]
     *
     * @return Comments collection|null
     */
    public function getCommentsWithUsers($post_id)
	{
		$comments = Yii::$app->db->createCommand('select cm.id, cm.content, cm.create_at, cm.comment_id, u.name from comments cm left join users u on cm.author_id = u.id where cm.post_id ='.$post_id)->queryAll();
		usort($comments,function ($x, $y) {
		if ($x['comment_id'] > $y['comment_id']) {
			return 1;
		} else if ($x['comment_id'] < $y['comment_id']) {
			return 0;
		} else {
			return 0;
		}
	});	
		$comments = self::rebuildComments($comments);
		return $comments;
	}
	
	function rebuildComments ($tree) {

		$rebuildTree = [];

		foreach ($tree as $keyTree => $itemTree) {
			if(empty($rebuildTree[$itemTree['comment_id']])) {
				$rebuildTree[$itemTree['comment_id']] = array();
			}
			$rebuildTree[$itemTree['comment_id']][] = $itemTree;
		}
		return $rebuildTree;
	}

}
