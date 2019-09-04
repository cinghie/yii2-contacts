<?php

/* @var $this yii\web\View */
/* @var $model cinghie\contacts\models\Forms */

use yii\helpers\Html;

$this->title = Yii::t('contacts', 'Update Forms: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('contacts', 'Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('contacts', 'Update');
?>

<div class="forms-update">

	<?php if(Yii::$app->getModule('contacts')->showTitles): ?>
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
	<?php endif ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
