<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use \Yii;

/* @var $this yii\web\View */
/* @var $searchModel x51\yii2\modules\blocks\models\BlocksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$formId = 'group-op';
$allowAutocomplete = class_exists('\yii\jui\AutoComplete');

$this->title = Yii::t('module/blocks', 'Blocks');

$this->params['breadcrumbs'][] = $this->title;


?>
<div class="blocks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id'=>'blocks-index']); ?>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php $form = ActiveForm::begin([
	        'options'=>[
		        'data-pjax'=>true,
		        'id'=>$formId,
	        ]
        ]);
        echo Html::hiddenInput('operation', '');
    ?>

    <p>
        <?= Html::a(Yii::t('module/blocks', 'Create Blocks'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
				'class' => '\yii\grid\CheckboxColumn',
				'name' => 'sel[]',
				'checkboxOptions' => function ($model, $key, $index, $column) {
					$opt = [
						'value'=>$key
					];					
					return $opt;
				},
			],
            //'id',
            'code',
            'sort',
            'bgroup',
			'active',
            'comment',
			'permission',
            //'content:ntext',
            //'user_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {duplicate} {delete}',
                'buttons' => [
                    'duplicate' => function ($url, $model, $key) {
                        return Html::a('DD', $url, ['title'=>Yii::t('module/blocks', 'Duplicate')]);
                    },
                ],
            ],
        ],
    ]); ?>
    <p>С отмеченными:
    <p><?= Html::submitButton(
        Yii::t('module/blocks', 'Delete'),
        [
            'data' => [
                'confirm' => Yii::t('module/blocks', 'Are you sure?')
            ],
            'class' => 'btn btn-danger',
            'id'=>'btn-delete'
        ]);?>
<div>
<?php // group
if ($allowAutocomplete) {
    echo \yii\jui\AutoComplete::widget([
        'name' => 'new-group',
        'id' => 'new-group',
        'clientOptions' => [
            'source' => yii\helpers\Url::to(['/' . $this->context->module->id . '/autocomplete/group']),
            'minLength' => 1,
        ],
    ]);
} else {
    echo \yii\helpers\Html::input('text', 'new-group');
    //echo $form->field($model, 'bgroup')->textInput(['maxlength' => true]);
}
echo '<p>'.Html::submitButton(
    Yii::t('module/blocks', 'Set a group for checked.'),
    [
        'data' => [
            'confirm' => Yii::t('module/blocks', 'Are you sure?')
        ],
        'class' => 'btn btn-danger',
        'id'=>'btn-set-group'
    ]
);
?>
</div>
    <?php $form::end(); ?>
<?php $this->registerJs('
    function checked() {
        var checkers = document.querySelectorAll("#'.$formId.' input[type=checkbox][name=\'sel[]\']");
		var checked = false;
		for (var i=0; i<checkers.length; i++) {
			if (checkers[i].checked) {
				checked = true;
				break;
			}
		}
        return checked;
    }
    document.getElementById("btn-delete").onclick = function (){
		checked = checked();
		if (checked) {
			document.querySelector("#'.$formId.' input[name=operation]").value="delete";
			return true;
		} else {
			alert("'.Yii::t('module/blocks', 'Nothing is selected.').'");
		}
		return false;
    };
    document.getElementById("btn-set-group").onclick = function (){
		checked = checked();
		if (checked) {
			document.querySelector("#'.$formId.' input[name=operation]").value="set-group";
			return true;
		} else {
			alert("'.Yii::t('module/blocks', 'Nothing is selected.').'");
		}
		return false;
    };
');?>
    <?php Pjax::end(); ?>
</div>