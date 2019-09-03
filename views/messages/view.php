<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model cinghie\contacts\models\Messages */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('traits', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
Yii\webYiiAsset::register($this);
?>

<div class="contact-form-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('traits', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('traits', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('traits', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email:email',
            'phone',
            'mobile',
            'message:ntext',
            'ip',
        ],
    ]) ?>

</div>
