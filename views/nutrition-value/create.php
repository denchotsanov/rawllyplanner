<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NutritionValue */

$this->title = 'Create Nutrition Value';
$this->params['breadcrumbs'][] = ['label' => 'Nutrition Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nutrition-value-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
