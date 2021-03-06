<?php

namespace app\components;

use yii\base\Widget;

class Moneycard extends Widget
{
    public $sum;
    public $date_enable;
    public $category;
    public $currency;
    public $type;
    public $userCssClass;
    public $data;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub

        if($this->sum === null)
        {
            $this->sum = "0";
        }
        if($this->date_enable === null)
        {
            $this->date_enable = false;
        }
        if($this->type === null)
        {
            $this->type = 'single';
        }
        if($this->category === null)
        {
            $this->category = "Общая сумма";
        }
        if($this->currency === null)
        {
            $this->currency = "грн";
        }
        if($this->userCssClass === null)
        {
            $this->userCssClass = "moneycard_single";
        }
        if($this->data === null)
        {
            $this->data = [];
        }
    }

    public function run()
    {
        if( $this->type == 'single'){
            return $this->render('moneycard',[
                'sum' => $this->sum,
                'currency' => $this->currency,
                'category' => $this->category,
                'userCssClass' => $this->userCssClass
            ]);
        }else{
            return $this->render('moneycard_array',[
                'data' => $this->data,
                'currency' => $this->currency
            ]);
        }
    }
}