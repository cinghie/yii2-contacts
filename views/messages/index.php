<?php

/* @var $this yii\web\View */
/* @var $searchModel cinghie\contacts\models\MessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\grid\CheckboxColumn;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('contacts', 'Contact Forms');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">

    <!-- action menu -->
    <div class="col-md-6">

		<?= Yii::$app->view->renderFile(Yii::$app->controller->module->tabMenu) ?>

    </div>

    <!-- action buttons -->
    <div class="col-md-6">

		<?= $searchModel->getDeactiveButton() ?>

		<?= $searchModel->getActiveButton() ?>

		<?= $searchModel->getResetButton() ?>

		<?= $searchModel->getPreviewButton() ?>

		<?= $searchModel->getDeleteButton() ?>

		<?= $searchModel->getUpdateButton() ?>

		<?= $searchModel->getCreateButton() ?>

    </div>

</div>

<div class="separator"></div>

<div class="contacts-messages-index">

	<?php if(Yii::$app->getModule('contacts')->showTitles): ?>
        <div class="page-header">
            <h1><?= \kartik\helpers\Html::encode($this->title) ?></h1>
        </div>
	<?php endif ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'pjaxSettings'=>[
	        'neverTimeout'=>true,
        ],
        'hover' => true,
        'responsive' => true,
        'responsiveWrap' => true,
        'columns' => [
	        [
		        'class' => CheckboxColumn::class
	        ],
	        [
		        'attribute' => 'name',
		        'hAlign' => 'center',
	        ],
	        [
		        'attribute' => 'email',
		        'format' => 'email',
		        'hAlign' => 'center',
	        ],
	        [
		        'attribute' => 'phone',
		        'hAlign' => 'center',
	        ],
	        [
		        'attribute' => 'mobile',
		        'hAlign' => 'center',
	        ],
            [
		        'attribute' => 'ip',
		        'hAlign' => 'center',
		        'width' => '14%',
	        ],
	        [
		        'attribute' => 'id',
		        'hAlign' => 'center',
		        'width' => '5%',
	        ]
        ],
        'panel' => [
		    'heading'    => '<h3 class="panel-title"><i class="fa fa-envelope-open"></i></h3>',
		    'type'       => 'success',
		    'showFooter' => false
	    ]
    ]) ?>

</div>
