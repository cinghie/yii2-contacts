<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model cinghie\contacts\models\Forms */

$this->title = Yii::t('contacts', 'Create Forms');
$this->params['breadcrumbs'][] = ['label' => Yii::t('contacts', 'Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
