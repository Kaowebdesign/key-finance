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

//google charts library registration
$this->registerJsFile('https://www.gstatic.com/charts/loader.js', ['position' => yii\web\View::POS_HEAD],$key = null);
//get income info
$incomeCategorySum = json_encode($categorySum,JSON_UNESCAPED_UNICODE);
$js = <<< JS
   
JS;
//google charts settings
$gChartsSettings = <<< JS
     var incomeCategorySum = $incomeCategorySum;
    
    var incomeSum = incomeCategorySum.map(function(item) {
      return item['SUM(sum)'];
    });
    
    var incomeLabel = incomeCategorySum.map(function(item) {
      return item['name'];
    });
    
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    
    
    
    function drawChart() {
        var data = new google.visualization.DataTable();
        
        data.addRows(incomeSum.length);
        
        data.addColumn('string', 'Категория');
        data.addColumn('number', 'Сумма');
        
        for(var i = 0; i < incomeLabel.length; i++){
             data.setCell(i, 0, incomeLabel[i]);
        }
         
        for(var i = 0; i < incomeSum.length; i++){
             data.setCell(i, 1, incomeSum[i]);
        }
        var options = {
          pieHole: 0.4,
          chartArea:{
              top:0,
              left:0
          },
          colors: ['#5ED1BA', '#6A94D4', '#FFCB73', '#FFAA73', '#1F7A68',,'#284B7E','#BF8A30','#BF6830']
        };

        var chart = new google.visualization.PieChart(document.getElementById('income-chart'));
        chart.draw(data, options);
    }
JS;

$this->registerJs( $gChartsSettings, $position = yii\web\View::POS_END, $key = null );
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
            <div class="col-8 d-flex px-0">
                <div class="row w-100 justify-content-end">
                        <?= Html::a('', ['/#'], ['class' => 'income-slider__arrow income-slider__arrow_prev']) ?>
                    <div class="col-10">
                        <div class="income-slider owl-carousel owl-theme">
                            <?= Moneycard::widget(['data' => $categorySum,'type'=>'array']) ?>
                        </div>
                    </div>
                        <?= Html::a('', ['/#'], ['class' => 'income-slider__arrow income-slider__arrow_next']) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 d-flex flex-column">
                <h3 class="caption caption_size_h3 mb-5">График месячного дохода</h3>
                <div id="income-chart" style="width: 100%; height: 500px;" class="income-chart"></div>
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
