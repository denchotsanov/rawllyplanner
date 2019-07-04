<?php
/**
 * User: dencho
 */

use app\models\Products;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'Cooking Orders';
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
                        }
                    ],
                    'quantity',
                    [
                        'label' => 'Delivery price',
                        'format' => 'currency',
                        'value' => function ($data) {
                            if (!$data->deliveryPrice) {
                                return '';
                            }
                            return $data->deliveryPrice;
                        }
                    ],

                    [
                        'attribute' => 'ready_to',
                        'filter' => false,
                        'format' => 'datetime',
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'urlCreator' => function ($action, $model) {
                            return Url::to(['products/' . $action, 'id' => $model->product_id]);
                        },
                    ],
                ],
            ]); ?>
        </div>
        <div class="col-xs-12">
            <h3>Materials</h3>

        </div>
    </div>
</div>
