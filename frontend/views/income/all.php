<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Список всех доходов';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered baseTable'
    ],
    'layout'=>"{items}",
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute'=>'sum',
            'label' =>'Сумма'
        ],
        [
            'attribute'=>'data',
            'label'=>'Дата'
        ],
        [
            'attribute'=>'title',
            'label'=>'Комментарий'
        ],
        [
            'attribute'=>'category_id_inc',
            'label'=>'Категория',
            'value'=>'categoryIncome.name'
        ],
        ['class' => 'yii\grid\ActionColumn'],
    ],

]);?>
