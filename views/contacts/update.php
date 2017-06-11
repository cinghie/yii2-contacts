<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.9.3
 */

use kartik\helpers\Html;

$this->title = Yii::t('contacts', 'Update Contacts') . ": " .$model->firstname ." ". $model->lastname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('contacts', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->firstname. " " . $model->lastname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('contacts', 'Update');
?>
<div class="contacts-update">

    <?php if(Yii::$app->getModule('contacts')->showTitles): ?>
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    <?php endif ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
