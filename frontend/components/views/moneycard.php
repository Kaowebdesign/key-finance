<?php

use yii\helpers\Html;
use app\components\Moneycard;

/* @var $sum app\components\Moneycard */
/* @var $currency app\components\Moneycard */
/* @var $category app\components\Moneycard */
/* @var $userCssClass app\components\Moneycard */

?>
<div class="moneycard moneycard_all <?= HTML::encode($userCssClass)?>">
    <h2 class="moneycard__caption mb-0"><?= $sum; ?> <?= $currency; ?></h2>
    <span class="moneycard__label mb-0"><?= $category; ?></span>
</div>