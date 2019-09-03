<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model cinghie\contacts\models\Forms */

$this->title = Yii::t('contacts', 'Update Forms: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('contacts', 'Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('contacts', 'Update');
?>
<div class="forms-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
