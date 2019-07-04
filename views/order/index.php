<?php

use app\models\Order;
use app\models\Products;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

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
<div class="body-content">
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <h3>Today Orders</h3>
            <?= GridView::widget([
                'dataProvider' => $dataProviderOrder,
                'filterModel' => $searchModelOrder,
                'rowOptions' => function ($models) {
                    $class = 'success';
                    if (strtotime($models->ready_to) < (strtotime('2 hours'))) {
                        $class = 'warning';
                    }
                    if (strtotime($models->ready_to) < time()) {
                        $class = 'danger';
                    }

                    return ['class' => $class];
                },
                'columns' => [
                    'id',
                    'name',
                    'phone',
                    [
                        'attribute' => 'status',
                        'filter'=>Order::$statuses,
                        'value' => function ($data) {
                            return Order::$statuses[$data->status];
                        }
                    ],
                    'price:currency',

                    [
                        'attribute' => 'ready_to',
                        'filter'=>false,
                        'format' => 'datetime',
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'controller' => 'order'],
                ],
            ]); ?>
        </div>
        <div class="col-sm-6 col-xs-12">
            <h3>Today Cooking products</h3>
            <?= GridView::widget([
                'dataProvider' => $dataProviderOrder,
                'filterModel' => $searchModelOrder,
                'rowOptions' => function ($models) {
                    $class = 'success';
                    if (strtotime($models->ready_to) < (strtotime('2 hours'))) {
                        $class = 'warning';
                    }
                    if (strtotime($models->ready_to) < time()) {
                        $class = 'danger';
                    }

                    return ['class' => $class];
                },
                'columns' => [
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
                            if(!$data->deliveryPrice){
                                return '';
                            }
                            return $data->deliveryPrice;
                        }],

                    [
                        'attribute' => 'ready_to',
                        'filter'=>false,
                        'format' => 'datetime',
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{view}',
                        'urlCreator' => function($action, $model) {
                            return Url::to(['products/'.$action,'id'=>$model->product_id]);},
                    ],
                ],
            ]); ?>
        </div>
        <div class="col-xs-12">
            <h3>Materials</h3>

        </div>
    </div>
</div>