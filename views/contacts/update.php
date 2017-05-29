<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @package yii2-contacts
 * @version 0.2.5
 */

use kartik\helpers\Html;

$this->title = \Yii::t('contacts', 'Update Contacts') . ": " .$model->firstname ." ". $model->lastname;
$this->params['breadcrumbs'][] = ['label' => \Yii::t('contacts', 'CRM'), 'url' => ['/contacts/default/index']];
$this->params['breadcrumbs'][] = ['label' => \Yii::t('contacts', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->firstname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = \Yii::t('contacts', 'Update');
?>
<div class="contacts-update">

    <?php if(\Yii::$app->getModule('contacts')->showTitles): ?>
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    <?php endif ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
