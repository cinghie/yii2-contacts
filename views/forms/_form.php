<?php

/* @var $this yii\web\View */
/* @var $model cinghie\contacts\models\Forms */
/* @var $form yii\widgets\ActiveForm */

use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;

?>

<div class="forms-form">

    <?php $form = ActiveForm::begin() ?>

        <div class="row">

            <div class="col-lg-6">

	            <?= Yii::$app->view->renderFile(Yii::$app->controller->module->tabMenu) ?>

            </div>

            <div class="col-lg-6">

                <?= $model->getExitButton() ?>

                <?= $model->getCancelButton() ?>

                <?= $model->getSaveButton() ?>

            </div>

        </div>

        <div class="separator"></div>

        <div class="row">

            <div class="col-md-4">

	            <?= $model->getTitleWidget($form) ?>

            </div>

            <div class="col-md-4">

	            <?= $model->getContactsWidget($form) ?>

            </div>

            <div class="col-md-4">

	            <?= $form->field($model, 'captcha')->widget(SwitchInput::class, [
		            'indeterminateValue' => '0',
		            'pluginOptions' => [
			            'onColor' => 'success',
			            'offColor' => 'danger'
		            ]
	            ]) ?>

            </div>

        </div>

        <div class="row">

            <div class="col-md-4">

	            <?= $model->getAliasWidget($form) ?>

            </div>

        </div>

    <?php ActiveForm::end() ?>

</div>
