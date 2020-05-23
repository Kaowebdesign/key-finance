<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class Moneycard extends Widget
{
    public $sum;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        if($this->sum === null){
            $this->sum = "0";
        }
    }
}