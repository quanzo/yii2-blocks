<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use \Yii;

/* @var $this yii\web\View */
/* @var $model x51\yii2\modules\blocks\models\Blocks */
/* @var $form yii\widgets\ActiveForm */
$module = $this->context->module;

$allowAutocomplete = class_exists('\yii\jui\AutoComplete');
/*******************************************************/
?>
<div class="blocks-form">
<?php $form = ActiveForm::begin(); ?>
<?php
// code
if ($allowAutocomplete) {
    echo $form->field($model, 'code')->widget('\yii\jui\AutoComplete', [
        'model' => $model,
        'attribute' => 'code',
        'clientOptions' => [
            'source' => Url::to(['/' . $module->id . '/autocomplete/code']),
            'minLength' => 1,
        ],
    ])->hint(Yii::t('module/blocks', 'HINT_BLOCK_CODE'));
} else {
    echo $form->field($model, 'code')->textInput(['maxlength' => true]);
}

// sort
echo $form->field($model, 'sort')->input('number');

// group
if ($allowAutocomplete) {
    echo $form->field($model, 'bgroup')->widget('\yii\jui\AutoComplete', [
        'model' => $model,
        'attribute' => 'bgroup',
        'clientOptions' => [
            'source' => Url::to(['/' . $module->id . '/autocomplete/group']),
            'minLength' => 1,
        ],
    ])->hint(Yii::t('module/blocks', 'HINT_BLOCK_GROUP'));
} else {
    echo $form->field($model, 'bgroup')->textInput(['maxlength' => true]);
}
?>
    

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'intro')->textarea(['rows' => 3]) ?>
    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'epilog')->textarea(['rows' => 3]) ?>
    <?= $form->field($model, 'callback')->textInput(['maxlength' => true])->hint(Yii::t('module/blocks', 'HINT_BLOCK_CALLBACK')) ?>
	<?= $form->field($model, 'active')->dropDownList([
		0 => Yii::t('module/blocks', 'no'),
		1 => Yii::t('module/blocks', 'yes')], []);?>
	<?= $form->field($model, 'permission')->textInput(['maxlength' => true])->hint(Yii::t('module/blocks', 'HINT_BLOCK_PERMISSION'))?>
    <?= $form->field($model, 'route')->textInput(['maxlength' => true])->hint(Yii::t('module/blocks', 'HINT_BLOCK_ROUTE'))  ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('module/blocks', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
//echo '<pre>';print_r(Yii::$app->i18n->translations);echo '</pre>';