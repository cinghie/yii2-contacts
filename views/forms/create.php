<?php

/* @var $this yii\web\View */
/* @var $model cinghie\contacts\models\Forms */

use yii\helpers\Html;

$this->title = Yii::t('contacts', 'Create Forms');
$this->params['breadcrumbs'][] = ['label' => Yii::t('contacts', 'Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="forms-create">

	<?php if(Yii::$app->getModule('contacts')->showTitles): ?>
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
	<?php endif ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
