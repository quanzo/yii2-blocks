<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model x51\yii2\modules\blocks\models\BlocksGarbage */

$this->title = $model->garbage_id;
$this->params['breadcrumbs'][] = ['label' => 'Blocks Garbages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blocks-garbage-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->garbage_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->garbage_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'sort',
            'bgroup',
            'content:ntext',
            'comment',
            'callback',
            'user_id',
            'garbage_id',
            'garbage_date',
            'garbage_op',
        ],
    ]) ?>

</div>
