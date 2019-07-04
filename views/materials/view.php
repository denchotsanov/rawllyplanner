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
            <?= Html::a('Add NV', ['recipes/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProviderNVR,
            'filterModel' => $searchModelNVR,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'label' => 'Materials',
                    'filter' => false,
                    'attribute' => 'materials_id',
                    'value' => function ($data) {
                        return \app\models\Materials::getByID($data->materials_id)->name;
                    }
                ],
                [
                    'label' => 'Unit',
                    'filter' => false,
                    'attribute' => 'unit_id',
                    'value' => function ($data) {
                        return $data->quantity . ' ' . Units::getByID($data->unit_id)->name;
                    }
                ],
                [
                    'label' => 'price',
                    'filter' => false,
                    'attribute' => 'unit_id',
                    'format' => 'currency',
                    'value' => function ($data) {
                        return $data->totalPrice;
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}{delete}',
                    'controller' => 'recipes'
                ],
            ],
        ]); ?>
    </div>
</div>
