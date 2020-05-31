<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\Moneycard;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IncomeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $allIncomeSum app\models\Income */
/* @var $categorySum app\models\Income */

$this->title = 'Доходы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="income-index">
    <div class="layout__header">
        <h1 class="layout__caption"><?= Html::encode($this->title) ?></h1>
        <div>
            <?= Html::a('Категории', ['/category-income'], ['class' => 'layout__button']) ?>
            <?= Html::a('Создать', ['create'], ['class' => 'layout__button layout__button_light']) ?>
        </div>
    </div>
    <div class="layout__body">
        <div class="row">
            <div class="col-4">
                <?= Moneycard::widget(['sum' => '10 240','category'=>'Остаток','userCssClass' => 'moneycard_balance']) ?>
                <?= Moneycard::widget(['sum' => $allIncomeSum,'userCssClass'=>'moneycard_all-sum']) ?>
            </div>
            <div class="col-8">
                <div class="income-slider owl-carousel owl-theme">
                    <?= Moneycard::widget(['data' => $categorySum,'type'=>'array']) ?>
                </div>
            </div>
        </div>

        <p>
            <?= Html::a('Просмотреть все', ['all'], ['class' => 'btn btn-primary']) ?>
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
</div>
