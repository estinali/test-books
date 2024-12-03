<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $authors \app\models\Author[] */
/* @var $year int|null */

$this->title = 'Report TOP-10 authors for specific year';
?>

<div class="report-container">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(['id' => 'books-report-pjax']); ?>

    <div class="form-group">
        <?= Html::label('Year', 'year-input', ['class' => 'control-label']) ?>
        <?= DatePicker::widget([
            'name' => 'year',
            'options' => [
                'id' => 'year-input',
                'placeholder' => 'Select a year',
                'class' => 'form-control',
            ],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy',
            ],
            'pluginEvents' => [
                'changeDate' => "function(e) {
                    $.pjax.reload({
                        container: '#books-report-pjax',
                        url: window.location.href,
                        data: { year: $('#year-input').val() },
                        timeout: 1000,
                    });
                }",
            ],
        ]); ?>
    </div>

    <div id="authors-table-container">
        <?php if (isset($authors)): ?>
            <?= $this->render('_authors_table', ['authors' => $authors, 'year' => $year]) ?>
        <?php endif; ?>
    </div>

    <?php Pjax::end(); ?>
</div>
