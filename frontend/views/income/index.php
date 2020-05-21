<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IncomeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Доходы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="income-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Просмотреть все', ['all'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Категории', ['/category-income'], ['class' => 'btn btn-info']) ?>
    </p>

    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

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
    <p><?= 'Сумма всех поступлений - '.Html::encode($allIncomeSum) ?></p>


</div>
