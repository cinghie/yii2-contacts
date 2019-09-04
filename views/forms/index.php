<?php

/* @var $this yii\web\View */
/* @var $searchModel cinghie\contacts\models\FormsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\grid\CheckboxColumn;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('contacts', 'Forms');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">

    <!-- action menu -->
    <div class="col-md-6">

		<?= Yii::$app->view->renderFile(Yii::$app->controller->module->tabMenu) ?>

    </div>

    <!-- action buttons -->
    <div class="col-md-6">

		<?= $searchModel->getResetButton() ?>

		<?= $searchModel->getPreviewButton() ?>

		<?= $searchModel->getDeleteButton() ?>

		<?= $searchModel->getUpdateButton() ?>

		<?= $searchModel->getCreateButton() ?>

    </div>

</div>

<div class="separator"></div>

<div class="contacts-forms-index">

	<?php if(Yii::$app->getModule('contacts')->showTitles): ?>
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
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
		        'attribute' => 'title',
		        'hAlign' => 'center',
	        ],
	        [
		        'attribute' => 'contact_id',
		        'format' => 'raw',
		        'hAlign' => 'center',
		        'width' => '20%',
		        'value' => function ($model) {
			        $url = urldecode(Url::toRoute(['/contacts/contacts/view', 'id' => $model->id]));
			        /** @var cinghie\contacts\models\Contacts $model */
			        return Html::a($model->contact->fullName,$url);
		        }
	        ],
	        [
		        'attribute' => 'captcha',
		        'hAlign' => 'center',
		        'width' => '8%',
	        ],
	        [
		        'attribute' => 'id',
		        'hAlign' => 'center',
		        'width' => '6%',
	        ]
        ],
        'panel' => [
	        'heading'    => '<h3 class="panel-title"><i class="fa fa-wpforms"></i></h3>',
	        'type'       => 'success',
	        'showFooter' => false
        ]
    ]) ?>

</div>
