<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NutritionValueRelation */

$this->title = 'Update Nutrition Value Relation: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Nutrition Value Relations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nutrition-value-relation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
