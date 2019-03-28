<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model x51\yii2\modules\blocks\models\Blocks */

$this->title = Yii::t('module/blocks', 'Update Blocks: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('module/blocks', 'Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('module/blocks', 'Update');
?>
<div class="blocks-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('module/blocks', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('module/blocks', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('module/blocks', 'List'), ['index'], ['class' => 'btn btn-success']);?>
    </p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
