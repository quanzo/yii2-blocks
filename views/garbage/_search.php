<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model x51\yii2\modules\blocks\models\BlocksGarbageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blocks-garbage-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'sort') ?>

    <?= $form->field($model, 'group') ?>

    <?= $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'callback') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'garbage_id') ?>

    <?php // echo $form->field($model, 'garbage_date') ?>

    <?php // echo $form->field($model, 'garbage_op') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
