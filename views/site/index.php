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
    </div>
</div>
