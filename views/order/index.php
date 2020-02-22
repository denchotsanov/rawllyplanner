<?php

use app\models\Order;
use app\models\Products;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поръчки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Нова поръчка', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Поръчки за днес', ['today'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Поръчки за готвене', ['cooking'], ['class' => 'btn btn-warning']) ?>
    </p>
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'phone',
            'address:ntext',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return Order::$statuses[$data->status];
                }],
            [
                'attribute' => 'product_id',
                'value' => function ($data) {
                    return Products::getNameByID($data->product_id);
                }],
            'quantity',
            [
                'label' => 'Доставна цена',
                'format' => 'currency',
                'value' => function ($data) {
                    return $data->deliveryPrice;
                }],
            'price:currency',
            [
                'attribute' => 'ready_to',
                'format' => 'datetime',
                'filter' => false
            ],
            [
                'attribute' => 'delivered',
                'format' => 'datetime',
                'filter' => false
            ],
            'created_at:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>