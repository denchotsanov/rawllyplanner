<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NutritionValueRelation */

$this->title = 'Create Nutrition Value Relation';
$this->params['breadcrumbs'][] = ['label' => 'Materials', 'url' => ['materials/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nutrition-value-relation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
