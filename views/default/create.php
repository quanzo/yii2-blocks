<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model x51\yii2\modules\blocks\models\Blocks */

$this->title = Yii::t('module/blocks', 'Create Blocks');
$this->params['breadcrumbs'][] = ['label' => Yii::t('module/blocks', 'Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blocks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
