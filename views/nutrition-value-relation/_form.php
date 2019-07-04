<?php

use app\models\Materials;
use app\models\Products;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NutritionValueRelation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nutrition-value-relation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->dropDownList(Materials::getList(),['disabled' => true]) ?>
  <?= $form->field($model, 'nutrition_value_id')->widget(Select2::className(),['data'=>\app\models\NutritionValue::getList()]); ?>
    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
