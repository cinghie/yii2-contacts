<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @package yii2-contacts
 * @version 0.9.0
 */

use kartik\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="contacts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'email_secondary') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'phone_code') ?>

    <?php // echo $form->field($model, 'phone_secondary') ?>

    <?php // echo $form->field($model, 'phone_secondary_code') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'mobile_code') ?>

    <?php // echo $form->field($model, 'mobile_secondary') ?>

    <?php // echo $form->field($model, 'mobile_secondary_code') ?>

    <?php // echo $form->field($model, 'skype') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton(\Yii::t('contacts', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(\Yii::t('contacts', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
