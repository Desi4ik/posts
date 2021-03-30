<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m210327_173654_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
			'post_id' => $this->integer(15)->notNull()->defaultValue('0')->comment('ID статьи'),
			'author_id' => $this->integer(15)->notNull()->defaultValue('0')->comment('ID автора'),
			'comment_id' => $this->integer(15)->notNull()->defaultValue('0')->comment('ID комментария'),
			'content' => $this->string(150)->defaultValue(null)->comment('Текст комментария'),
			'create_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP')
        ]);
		
		
		$this->createIndex(
            'idx-comments-author_id',
            'comments',
            'author_id'
        );
		
		 $this->createIndex(
            'idx-comments-post_id',
            'comments',
            'post_id'
        );
    }
	
	

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropIndex(
            'idx-comments-author_id',
            'comments'
        );
		
		$this->dropIndex(
            'idx-comments-post_id',
            'comments'
        );
		
        $this->dropTable('{{%comments}}');
    }
}
