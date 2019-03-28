<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model x51\yii2\modules\blocks\models\BlocksGarbage */

$this->title = 'Update Blocks Garbage: ' . $model->garbage_id;
$this->params['breadcrumbs'][] = ['label' => 'Blocks Garbages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->garbage_id, 'url' => ['view', 'id' => $model->garbage_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="blocks-garbage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
