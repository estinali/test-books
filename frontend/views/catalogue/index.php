<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            'name',
            [
                'label' => 'Authors',
                'value' => function ($model) {
                    return implode(', ', array_map(function ($author) {
                        return $author->name_on_book;
                    }, $model->authors));
                },
            ],
            'description',
            'year',
            'isbn',
            [
                'attribute' => 'photo_url',
                'format'    => ['image', ['width' => '100', 'height' => '100']],
                'value'     => function ($model) {
                    return $model->photo_url;
                },
            ],
            [
                'class'          => 'yii\grid\ActionColumn',
                'template'       => '{view} {update} {delete} {subscribe}',
                'buttons'        => [
                    'subscribe' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-bell"></i>', $url, [
                            'title'      => 'Subscribe',
                            'aria-label' => 'Subscribe',
                            'class'      => 'btn btn-sm btn-success',
                        ]);
                    },
                ],
                'urlCreator'     => function ($action, $model) {
                    if ($action === 'subscribe') {
                        return Url::to(['subscribe', 'id' => $model->id]);
                    }
                    return Url::to([$action, 'id' => $model->id]);
                },
                'visibleButtons' => [
                    'view'   => function ($model, $key, $index) {
                        return Yii::$app->user->can('crud');
                    },
                    'update' => function ($model, $key, $index) {
                        return Yii::$app->user->can('crud');
                    },
                    'delete' => function ($model, $key, $index) {
                        return Yii::$app->user->can('crud');
                    },
                ],
            ],
        ],
    ]); ?>


</div>
