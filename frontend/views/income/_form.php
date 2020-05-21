<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\CategoryIncome;


/* @var $this yii\web\View */
/* @var $model app\models\Income */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="income-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id_inc')->dropdownList(CategoryIncome::find()->select(['name','id'])->indexBy('id')->column(),['prompt'=>'Select Catetgory']) ?>

    <?= $form->field($model, 'data')->textInput(['type' => 'date','value'=> date('Y-m-d')]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
