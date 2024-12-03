<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%authors}}`.
 */
class m241130_083145_create_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%authors}}', [
            'id' => $this->string(36)->notNull(), // uuid
            'name_on_book' => $this->string()->notNull(), //not normalized because of 'pseudonim' may be used
            'civil_fullname' => $this->string(), //optional, if author uses 'pseudonim'
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);
        $this->addPrimaryKey('pk_authors_id', '{{%authors}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%authors}}');
    }
}
