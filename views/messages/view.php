<?php

/* @var $this yii\web\View */
/* @var $model cinghie\contacts\models\Messages */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('traits', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">

    <!-- action menu -->
    <div class="col-md-6"></div>

    <!-- action buttons -->
    <div class="col-md-6">

		<?= $model->getExitButton() ?>

		<?= $model->getDeleteButton($model->id) ?>

    </div>

</div>

<div class="separator"></div>

<div class="row contact-message-view">

    <div class="col-lg-6 col-md-12">

        <?= $model->getMessageInformationDetailView() ?>

    </div>

    <div class="col-lg-6 col-md-12">

		<?= $model->getMessageDetailView() ?>

    </div>

</div>
