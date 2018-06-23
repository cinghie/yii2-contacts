<?php

/**
 * @var \cinghie\contacts\models\Contacts $model
 */

use kartik\detail\DetailView;
use kartik\helpers\Html;

$this->title = $model->getFullName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('contacts', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">

    <!-- action menu -->
    <div class="col-md-6"></div>

    <!-- action buttons -->
    <div class="col-md-6">

		<?= $model->getDeactiveButton($model->id) ?>

		<?= $model->getActiveButton($model->id) ?>

		<?= $model->getDeleteButton($model->id) ?>

		<?= $model->getUpdateButton($model->id) ?>

		<?= $model->getCreateButton() ?>

		<?= $model->getExitButton() ?>

    </div>

</div>

<div class="separator"></div>

<div class="row contacts-view">

    <?php if(Yii::$app->getModule('contacts')->showTitles): ?>
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    <?php endif ?>

    <div class="col-lg-6 col-md-12">

		<?= $model->getContactsInformationsDetailView() ?>

		<?= $model->getSocialInformationsDetailView() ?>

    </div>

    <div class="col-lg-6 col-md-12">

		<?= $model->getEntryInformationsDetailView() ?>

    </div>

</div>
