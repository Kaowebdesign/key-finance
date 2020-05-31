<?php

use yii\helpers\Html;
use app\components\Moneycard;
use yii\web\View;

/* @var $data app\components\Moneycard */
/* @var $currency app\components\Moneycard */

$this->registerJs('

    //get elem width
    function getElemWidth(elem){
        return $(elem).width();
    }
    
    //get width for all sum moneyCard
    var moneyCardAllSumWidth = getElemWidth(".moneycard_all");
    
    //set equal width for each moneyCards in array
    $(".moneycard_item").width(moneyCardAllSumWidth);
    
',View::POS_READY,'moneycard_size');

$this->registerCss("
    .moneycard_item{
        margin-left:30px;
    }
");
?>
<?php foreach ($data as $item){ ?>
    <div class="moneycard moneycard_item">
        <h2 class="moneycard__caption mb-0"><?= $item['SUM(sum)']?> <?= $currency; ?></h2>
        <span class="moneycard__label mb-0"><?= $item['name']?></span>
    </div>
<?php } ?>