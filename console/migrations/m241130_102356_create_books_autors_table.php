<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books_autors}}`.
 */
class m241130_102356_create_books_autors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%books_authors}}', [
            'book_id'      => $this->string(36)->notNull(),
            'author_id'    => $this->string(36)->notNull(),
            'author_order' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_books_authors_book_id',
            '{{%books_authors}}',
            'book_id',
            '{{%books}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_books_authors_author_id',
            '{{%books_authors}}',
            'author_id',
            '{{%authors}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addPrimaryKey('pk_books_authors', '{{%books_authors}}', ['book_id', 'author_id']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_books_authors_book_id', '{{%books_authors}}');
        $this->dropForeignKey('fk_books_authors_author_id', '{{%books_authors}}');
        $this->dropTable('{{%books_authors}}');
    }
}
