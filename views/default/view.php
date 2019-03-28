<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model x51\yii2\modules\blocks\models\Blocks */

$this->title = $model->code.' #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('module/blocks', 'Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blocks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('module/blocks', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('module/blocks', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('module/blocks', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('module/blocks', 'List'), ['index'], ['class' => 'btn btn-success']);?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'sort',
            'bgroup',
            'name',
            'intro:ntext',
            'content:ntext',
            'epilog:ntext',
			'active',
			'permission',
            'user_id',
        ],
    ]) ?>

</div>
