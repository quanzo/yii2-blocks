<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel x51\yii2\modules\blocks\models\BlocksGarbageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blocks Garbages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blocks-garbage-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Blocks Garbage', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'sort',
            'bgroup',
            //'content:ntext',
            'comment',
            'callback',
            //'user_id',
            //'garbage_id',
            'garbage_date',
            'garbage_op',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
