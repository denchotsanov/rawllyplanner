<?php

use app\models\Order;
use app\models\Units;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

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
            'product_id',
            'text',
            'name',
            'phone',
            'address:ntext',
            'description:ntext',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return Order::$statuses[$data->status];
                }],
            'quantity',
            'price:currency',
            'ready_to:datetime',
            'delivered:datetime',
            'updated_at:datetime',
            'created_at:datetime',
        ],
    ]) ?>

</div>
