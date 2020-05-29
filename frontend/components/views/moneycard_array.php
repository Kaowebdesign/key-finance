<?php

use yii\helpers\Html;
use app\components\Moneycard;

/* @var $data app\components\Moneycard */
/* @var $currency app\components\Moneycard */

?>
<?php foreach ($data as $item){ ?>
<div class="moneycard">
    <h2 class="moneycard__caption mb-0"><?= $item['SUM(sum)']?> <?= $currency; ?></h2>
    <span class="moneycard__label mb-0"><?= $item['name']?></span>
</div>
<?php } ?>