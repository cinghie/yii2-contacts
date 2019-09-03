<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model cinghie\contacts\models\Messages */

$this->title = Yii::t('contacts', 'Create Contact Form');
$this->params['breadcrumbs'][] = ['label' => Yii::t('contacts', 'Contact Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
