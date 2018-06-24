<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Clients */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            [
                'label' => 'Country',
                'value' => $model->country->name_en,
            ],
            'note',
            [
                'label' => 'Status',
                'value' => \app\models\Clients::getStatus($model->status),
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'label' => 'Payment method',
                'value' => $model->payment ? $model->payment->name : '(Not Set)',
            ],
        ],
    ]) ?>

</div>
