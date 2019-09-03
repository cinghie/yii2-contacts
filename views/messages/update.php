<?php

/* @var $this yii\web\View */
/* @var $model cinghie\contacts\models\Messages */

$this->title = Yii::t('contacts', 'Update Messages').': '.$model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('traits', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('traits', 'Update');

?>

<div class="contact-form-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
