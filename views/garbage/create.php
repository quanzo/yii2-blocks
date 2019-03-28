<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model x51\yii2\modules\blocks\models\BlocksGarbage */

$this->title = 'Create Blocks Garbage';
$this->params['breadcrumbs'][] = ['label' => 'Blocks Garbages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blocks-garbage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
