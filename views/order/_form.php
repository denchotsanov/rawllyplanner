<?php

use app\models\Order;
use app\models\Products;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'status')->widget(Select2::className(),['data'=>Order::$statuses]) ?>
            <?= $form->field($model, 'ready_to')->widget(DateTimePicker::classname(), [
                'options' => [
                    'placeholder' => 'Enter date & time'
                ],
                'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy hh:ii'
                ]
            ]); ?>
            <?= $form->field($model, 'delivered')->widget(DateTimePicker::classname(), [
                'options' => [
                    'placeholder' => 'Enter date & time'
                ],
                'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd MM yyyy hh:ii'
                ]
            ]); ?>

        </div>

        <div class="col-sm-6 col-xs-12">
            <h3>Contact</h3>
            <div class="row">
                <div class="col-xs-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-sm-6 col-xs-12">
            <h3>Product</h3>
            <?= $form->field($model, 'product_id')->widget(Select2::className(),['data'=>Products::getList()]) ?>
            <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>
            <div class="row">
                <div class="col-xs-6">
                    <?= $form->field($model, 'quantity')->textInput() ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'price')->textInput() ?>
                </div>
            </div>


        </div>

        <div class="col-sm-12 col-xs-12">

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
