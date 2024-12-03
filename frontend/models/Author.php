<?php

namespace app\models;

use Ramsey\Uuid\Guid\Guid;
use yii\behaviors\TimestampBehavior;
use common\helpers\CommaSeparatedTrait;
use app\models\Book;

/**
 * This is the model class for table "authors".
 *
 * @property string $id
 * @property string $name_on_book
 * @property string|null $civil_fullname
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Book[] $books
 */
class Author extends \yii\db\ActiveRecord
{
    use CommaSeparatedTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord && empty($this->id)) {
                $this->id = Guid::uuid4()->toString();
            }

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name_on_book'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['id'], 'string', 'max' => 36],
            [['name_on_book', 'civil_fullname'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'             => 'ID',
            'name_on_book'   => 'Name On Book',
            'civil_fullname' => 'Civil Fullname',
            'created_at'     => 'Created At',
            'updated_at'     => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])
            ->viaTable('books_authors', ['author_id' => 'id']);
    }

    public function getBooksQuantity()
    {
        return $this->getBooks()->count();
    }

    public static function getMostPopularAuthors($year)
    {
        return $year ?
            Author::find()
                ->select(['authors.id', 'authors.name_on_book', 'COUNT(books_authors.book_id) AS book_count'])
                ->innerJoin('books_authors', 'authors.id = books_authors.author_id')
                ->innerJoin('books', 'books_authors.book_id = books.id')
                ->where(['books.year' => $year])
                ->groupBy(['authors.id', 'authors.name_on_book'])
                ->orderBy(['book_count' => SORT_DESC])
                ->limit(10)
                ->all()
            : null;
    }

}
