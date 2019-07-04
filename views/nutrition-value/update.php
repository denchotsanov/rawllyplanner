<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NutritionValue */

$this->title = 'Update Nutrition Value: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Nutrition Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nutrition-value-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
