<?php

/**
 * @var $model cinghie\contacts\models\Contacts
 * @var $this yii\web\View
 */

use kartik\helpers\Html;

$this->title = Yii::t('contacts', 'Create Contacts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('contacts', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-create">

    <?php if(Yii::$app->getModule('contacts')->showTitles): ?>
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    <?php endif ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
