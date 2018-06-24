<?php

use app\models\Clients;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ClientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clients';
?>
<div class="clients-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Clients', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'username',
            [
                'attribute' => 'country_id',
                'filter' => Clients::getCountries(),
                'options' => [
                    'width' => 170,
                ],
                'content' => function($model) { return $model->country->name_en; },
            ],
            'note',
            [
                'attribute' => 'status',
                'filter' => [1 => "Active", 0 => "Inactive", -1 => "Blacklisted"],
                'options' => [
                    'width' => 170,
                ],
                'content' => function($model) { return Clients::getStatus($model->status); },
            ],
            [
                'attribute' => 'payment_id',
                'filter' => Clients::getPayments(),
                'options' => [
                    'width' => 170,
                ],
                'content' => function($model) { return $model->payment ? $model->payment->name : '(Not Set)'; },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
