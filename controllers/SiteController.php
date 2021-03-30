<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Posts;
use app\models\Users;
use app\models\Comments;

class SiteController extends Controller
{
    

    
    /**
     * Displays posts page.
     *
     * @return post
     */
    public function actionIndex()
    {
        $post = Posts::find()->one();
		$commentsWithUsers = $post->getCommentsWithUsers($post->id);
		return $this->render('index', [
				'comments' => $commentsWithUsers,
				'post' => $post
			]
		);
    }
	
	
	/**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

        
    
}
