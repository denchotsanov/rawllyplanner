<?php

use app\models\Order;
use app\models\Products;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                'label' => 'Delivery price',
                'format' => 'currency',
                'value' => function ($data) {
                    return $data->deliveryPrice;
                }],
            'price:currency',
            'ready_to:datetime',
            'delivered:datetime',
            'created_at:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>



</div>
