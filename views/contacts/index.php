<?php

/**
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model cinghie\contacts\models\Contacts
 * @var $searchModel cinghie\newsletters\models\SubscribersSearch
 * @var $this yii\web\View
 */

use kartik\grid\CheckboxColumn;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('contacts', 'Contacts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('contacts', 'Contacts'), 'url' => ['/contacts/default/index']];
$this->params['breadcrumbs'][] = $this->title;

// Register action buttons js
$this->registerJs('$(document).ready(function() 
    {'
	.$searchModel->getUpdateButtonJavascript('#w0')
	.$searchModel->getDeleteButtonJavascript('#w0')
	.$searchModel->getActiveButtonJavascript('#w0')
	.$searchModel->getDeactiveButtonJavascript('#w0')
	.$searchModel->getPreviewButtonJavascript('#w0').
	'});
');

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

<div class="contacts-index">

    <?php if(Yii::$app->getModule('contacts')->showTitles): ?>
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    <?php endif ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]) ?>

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
				'format' => 'raw',
				'hAlign' => 'center',
				'label' => Yii::t('contacts', 'Contact'),
				'value' => static function ($model) {
					/** @var $model cinghie\contacts\models\Contacts */
					$url = urldecode(Url::toRoute(['/contacts/contacts/view', 'id' => $model->id]));
					return Html::a($model->lastname.' '.$model->firstname,$url);
				}
			],
			[
				'attribute' => 'email',
				'format' => 'email',
				'hAlign' => 'center',
			],
			[
				'attribute' => 'accept',
				'filterType' => GridView::FILTER_SELECT2,
				'filter' => [
					'1' => Yii::t('traits','Yes'),
					'0' => Yii::t('traits','No')
				],
				'filterWidgetOptions' => [
					'pluginOptions' => ['allowClear' => true],
				],
				'filterInputOptions' => ['placeholder' => ''],
				'format' => 'raw',
				'hAlign' => 'center',
				'width' => '5%',
				'value' => static function ($model) {
					/** @var $model cinghie\contacts\models\Contacts */
					return $model->getAcceptIcon();
				}
			],
			[
				'attribute' => 'email_secondary',
				'format' => 'email',
				'hAlign' => 'center',
			],
			[
				'attribute' => 'accept_secondary',
				'filterType' => GridView::FILTER_SELECT2,
				'filter' => [
					'1' => Yii::t('traits','Yes'),
					'0' => Yii::t('traits','No')
				],
				'filterWidgetOptions' => [
					'pluginOptions' => ['allowClear' => true],
				],
				'filterInputOptions' => ['placeholder' => ''],
				'format' => 'raw',
				'hAlign' => 'center',
				'width' => '5%',
				'value' => static function ($model) {
					/** @var $model cinghie\contacts\models\Contacts */
					return $model->getAccept2Icon();
				}
			],
			[
				'attribute' => 'phone',
				'format' => 'raw',
				'hAlign' => 'center',
				'value' => static function ($model) {
					/** @var $model cinghie\contacts\models\Contacts */
					return $model->getFullPhone();
				}
			],
			[
				'attribute' => 'mobile',
				'format' => 'raw',
				'hAlign' => 'center',
				'value' => static function ($model) {
					/** @var $model cinghie\contacts\models\Contacts */
					return $model->getFullPhone('mobile');
				}
			],
			[
				'attribute' => 'state',
				'filterType' => GridView::FILTER_SELECT2,
				'filter' => $searchModel::getStateSelect2(),
				'filterWidgetOptions' => [
					'pluginOptions' => ['allowClear' => true],
				],
				'filterInputOptions' => ['placeholder' => ''],
				'format' => 'raw',
				'hAlign' => 'center',
				'width' => '7%',
				'value' => static function ($model) {
					/** @var $model cinghie\contacts\models\Contacts */
					return $model->getStateGridView();
				}
			],
			[
				'attribute' => 'id',
				'hAlign' => 'center',
				'width' => '5%',
			]
		],
		'panel' => [
			'heading'    => '<h3 class="panel-title"><i class="fa fa-user"></i></h3>',
			'type'       => 'success',
			'showFooter' => false
		]
	]) ?>

</div>
