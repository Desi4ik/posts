<?php
namespace app\commands;

use Yii;
use yii\console\ExitCode;
use app\models\Posts;
use app\models\Users;
use app\models\Comments;


class SeederController extends \yii\console\Controller {
	
	public function actionIndex ( ) {
		$faker = \Faker\Factory::create();

        for ( $i = 1; $i <= 10; $i++ ) {
			$user = new Users();
			$user->name = $faker->username;
			$user->save();
        }
		$userMaxId = Yii::$app->db->createCommand('select max(id) from users')->queryScalar();
		
		$post = new Posts ();
		$post->title = $faker->text(100);
		$post->content = $faker->text;
		$post->author_id = \Faker\Provider\Base::numberBetween(1,$userMaxId);
		$post->save();
		
		$prefix = 0;
		for ( $i = 1; $i <= 100; $i++ ) {
			$comments = new Comments();
			$comments->content = $faker->text(1000);
			$comments->author_id = \Faker\Provider\Base::numberBetween(1,$userMaxId);
			if (($i % 4) == 0) {
				$comments->post_id = $post->id;
				$prefix = $i+4;
			}
			else {
				$comments->post_id = $i;
				$prefix = $i+1;
			}
			if (($i % 6) == 0) {
				$comments->comment_id = 0;
			}
			else {
				//$comments->comment_id = \Faker\Provider\Base::numberBetween(1,100);
				$comments->comment_id = $prefix;
			}
			$comments->save();
		}
		
		
		echo "End process";
	}
	
}
?>
