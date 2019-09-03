<?php

/* @var $this yii\web\View */
/* @var $model cinghie\contacts\models\Messages */

$this->title = Yii::t('contacts', 'Create Message');
$this->params['breadcrumbs'][] = ['label' => Yii::t('traits', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contact-form-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
