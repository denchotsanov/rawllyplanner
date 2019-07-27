<?php
/**
 * User: dencho
 */
/** @var \yii\data\ActiveDataProvider $dataProviderOrder */
/** @var \app\models\OrderSearch $searchModelOrder */

use app\models\Order;
use yii\grid\GridView;
use yii\helpers\Html;
$this->title = 'Today Orders';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="body-content">
    <div class="row">
        <div class="col-xs-12">
            <h3><?= $this->title; ?></h3>
            <p>
                <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a('Today Order', ['today'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Cooking Order', ['cooking'], ['class' => 'btn btn-warning']) ?>
            </p>
            <?=
            GridView::widget([
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
    </div>
</div>
