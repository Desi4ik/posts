<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%posts}}`.
 */
class m210327_170111_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%posts}}', [
            'id' => $this->primaryKey(),
			'title' => $this->string(150)->notNull()->comment('Заголовок'),
			'content' => $this->text()->defaultValue(null)->comment('Текст статьи'),
			'author_id' => $this->integer(15)->notNull()->defaultValue('0')->comment('ID автора'),
			'create_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP')
        ]);
		
		$this->createIndex(
            'idx-posts-author_id',
            'posts',
            'author_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-posts-author_id',
            'posts'
        );
		
		$this->dropTable('{{%posts}}');
    }
}