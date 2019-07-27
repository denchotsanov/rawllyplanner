<?php

use app\models\Units;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Materials */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="materials-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'unit_id',
                'value' => function ($data) {
                    return \app\models\Units::getByID($data->unit_id)->name;
                }
            ],
            'delivery_price:currency',
            'updated_at:datetime',
            'created_at:datetime',
        ],
    ]) ?>

    <div class="row">
        <p>
            <?= Html::a('Add NV', ['nutrition-value-relation/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        </p>
        <p>
            Values valid for 100 g
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProviderNVR,

            'columns' => [
                [
                    'label' => 'Name',
                    'filter' => false,
                    'attribute' => 'nutrition_value_id',
                    'value' => function ($data) {
                        return \app\models\NutritionValue::getByID($data->nutrition_value_id)->name;
                    }
                ],
                [
                    'label' => 'Value',
                    'filter' => false,
                    'attribute' => 'value',
                    'value' => function ($data) {
                        return $data->valueOnSto . ' ';
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}{delete}',
                    'controller' => 'nutrition-value-relation'
                ],
            ],
        ]); ?>
    </div>
</div>
