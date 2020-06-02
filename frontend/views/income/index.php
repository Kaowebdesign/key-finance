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

$incomeCategorySum = json_encode($categorySum,JSON_UNESCAPED_UNICODE);

$js = <<< JS
   var incomeCtx = document.getElementById('incomeChart').getContext('2d');

    var incomeCategorySum = $incomeCategorySum;
    
    var incomeSum = incomeCategorySum.map(function(item) {
      return item['SUM(sum)'];
    });
    
    var incomeLabel = incomeCategorySum.map(function(item) {
      return item['name'];
    });
    
    console.log(incomeSum);
    
    var myDoughnutChart = new Chart(incomeCtx, {
        type: 'doughnut',
        data: {
            datasets: [{
                backgroundColor: ['#5ED1BA','#00A383','#006A55'],
                data: incomeSum
            }],
            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: incomeLabel
        }
    });
JS;

$this->registerJs( $js, $position = yii\web\View::POS_END, $key = null );
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
            <div class="col-8 d-flex pl-0">
                <?= Html::a('', ['/#'], ['class' => 'income-slider__arrow income-slider__arrow_prev']) ?>
                <div class="income-slider owl-carousel owl-theme">
                    <?= Moneycard::widget(['data' => $categorySum,'type'=>'array']) ?>
                </div>
                <?= Html::a('', ['/#'], ['class' => 'income-slider__arrow income-slider__arrow_next']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <canvas id="incomeChart"></canvas>
            </div>
            <div class="col-6">
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
                <p>
                    <?= Html::a('Просмотреть все', ['all'], ['class' => 'btn btn-primary']) ?>
                </p>
            </div>
        </div>
    </div>
</div>
