<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Wellcome!</h1>
    </div>
    <div class="body-content">
        <div class="row">
            <a href="<?php echo Url::to(['order/index'])?>" class="btn btn-default btn-lg">Orders</a>
            <a href="<?php echo Url::to(['products/index'])?>" class="btn btn-default btn-lg">Products</a>
            <a href="<?php echo Url::to(['materials/index'])?>" class="btn btn-default btn-lg">Matrials</a>
            <a href="<?php echo Url::to(['units/index'])?>" class="btn btn-default btn-lg">Units</a>
        </div>

    </div>
</div>
