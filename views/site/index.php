<?php

/* @var $this yii\web\View */

use app\models\Order;
use app\models\Products;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::$app->name;
?>
<div class="site-index">
    <div class="row">
        <a href="<?php echo Url::to(['order/create']) ?>" class="btn btn-default btn-lg">New Order</a>
        <a href="<?php echo Url::to(['products/index']) ?>" class="btn btn-default btn-lg">Products</a>
        <a href="<?php echo Url::to(['materials/index']) ?>" class="btn btn-default btn-lg">Matrials</a>
        <a href="<?php echo Url::to(['units/index']) ?>" class="btn btn-default btn-lg">Units</a>
        <a href="<?php echo Url::to(['user/index']) ?>" class="btn btn-default btn-lg">Users</a>
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
</div>
