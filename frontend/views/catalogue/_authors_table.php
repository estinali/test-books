<?php
use yii\helpers\Html;

/* @var $authors \app\models\Author[] */
/* @var $year int */

?>

<?php if (!empty($books)): ?>
    <h2>Top-10 authors for <?= Html::encode($year) ?></h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Books</th>
            <th>Books quantity</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($authors as $author): ?>
            <tr>
                <td><?= Html::encode($author->name) ?></td>
                <td><?= Html::encode($author->getStringFromArray('books')) ?></td>
                <td><?= Html::encode($author->bookQuantity) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No books found for the year <?= Html::encode($year) ?>.</p>
<?php endif; ?>
