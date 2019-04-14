<?php

use app\models\Materials;
use app\models\Products;
use app\models\Units;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RecipesRelation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recipes-relation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->dropDownList(Products::getList(),['disabled' => true]) ?>

    <?= $form->field($model, 'materials_id')->widget(Select2::className(),['data'=>Materials::getList()]); ?>
    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'unit_id')->widget(Select2::className(),['data'=>Units::getList()]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
