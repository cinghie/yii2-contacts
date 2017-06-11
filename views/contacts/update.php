<?php

/**
 * @var \cinghie\contacts\models\Contacts $model
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
