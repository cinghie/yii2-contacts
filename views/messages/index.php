<?php

/* @var $this yii\web\View */
/* @var $searchModel cinghie\contacts\models\MessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\grid\CheckboxColumn;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('traits', 'Messages');
$this->params['breadcrumbs'][] = $this->title;

// Register action buttons js
$this->registerJs('$(document).ready(function() 
    {'.$searchModel->getDeleteButtonJavascript('#w1').'});
');

?>

<div class="row">

    <!-- action menu -->
    <div class="col-md-6">

		<?= Yii::$app->view->renderFile(Yii::$app->controller->module->tabMenu) ?>

    </div>

    <!-- action buttons -->
    <div class="col-md-6">

		<?= $searchModel->getResetButton() ?>

		<?= $searchModel->getDeleteButton() ?>

    </div>

</div>

<div class="separator"></div>

<div class="contacts-messages-index">

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
		        'attribute' => 'name',
		        'format' => 'raw',
		        'hAlign' => 'center',
		        'value' => static function ($model) {
			        /** @var $model cinghie\contacts\models\Messages */
			        $url = urldecode(Url::toRoute(['/contacts/messages/view', 'id' => $model->id]));
			        return Html::a($model->lastname.' '.$model->firstname,$url);
		        }
	        ],
	        [
		        'attribute' => 'firstname',
		        'hAlign' => 'center',
	        ],
	        [
		        'attribute' => 'lastname',
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
		        'width' => '8%',
	        ],
	        [
		        'attribute' => 'mobile',
		        'hAlign' => 'center',
		        'width' => '8%',
	        ],
            [
		        'attribute' => 'ip',
		        'hAlign' => 'center',
		        'width' => '8%',
	        ],
	        [
		        'attribute' => 'created',
		        'hAlign' => 'center',
		        'width' => '10%',
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
