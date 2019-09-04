<?php

/* @var $this yii\web\View */
/* @var $model cinghie\contacts\models\Forms */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="forms-form">

    <?php $form = ActiveForm::begin() ?>

        <div class="row">

            <div class="col-lg-6">



            </div>

            <div class="col-lg-6">

                <?= $model->getExitButton() ?>

                <?= $model->getCancelButton() ?>

                <?= $model->getSaveButton() ?>

            </div>

        </div>

        <div class="separator"></div>

        <div class="row">

            <div class="col-md-6">

	            <?= $model->getTitleWidget($form) ?>

            </div>

            <div class="col-md-6">

	            <?= $model->getContactsWidget($form) ?>

            </div>

        </div>

    <?php ActiveForm::end() ?>

</div>
