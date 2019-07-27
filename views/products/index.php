<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'product_name',
            ['label' => 'Delivery price',
                'filter' => false,
                'attribute' => 'id',
                'format' => 'currency',
                'value' => function ($data) {
                    return $data->deliveryPrice;
                }
            ],
            [
                'attribute' => 'updated_at',
                'filter' => false,
                'format' => 'datetime'
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
