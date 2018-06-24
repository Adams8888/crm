<?php

use app\models\Clients;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'username',
            'name',
            'email:email',
            'type',
            'company_name',
            [
                'attribute' => 'country_id',
                'filter' => Clients::getCountries(),
                'options' => [
                    'width' => 170,
                ],
                'content' => function($model) { return $model->country->name_en; },
            ],
            [
                'attribute' => 'status',
                'filter' => [10 => "Active", 0 => "Inactive"],
                'options' => [
                    'width' => 170,
                ],
                'content' => function($model) { return \app\models\User::getStatus($model->status); },
            ],
        ],
    ]); ?>
</div>
