<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model cinghie\contacts\models\Messages */

$this->title = Yii::t('contacts', 'Update Contact Form: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('contacts', 'Contact Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('contacts', 'Update');
?>
<div class="contact-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
