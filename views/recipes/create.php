<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RecipesRelation */

$this->title = 'Create Recipes Relation';
$this->params['breadcrumbs'][] = ['label' => 'Recipes Relations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipes-relation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
