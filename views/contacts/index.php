<?php use kartik\grid\CheckboxColumn;

/**
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model cinghie\contacts\models\Contacts
 * @var $searchModel cinghie\newsletters\models\SubscribersSearch
 * @var $this yii\web\View
 */

use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

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
    <div class="col-md-6"></div>

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

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjaxSettings'=>[
                'neverTimeout'=>true,
            ],
            'hover' => true,
            'responsive' => true,
            'columns' => [
                [
                    'class' => CheckboxColumn::class
                ],
                [
                    'attribute' => 'name',
                    'format' => 'raw',
                    'hAlign' => 'center',
                    'label' => Yii::t('contacts', 'Contact'),
                    'value' => function ($model) {
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
                    'attribute' => 'email_secondary',
                    'format' => 'email',
                    'hAlign' => 'center',
                ],
                [
                    'attribute' => 'mobile',
                    'format' => 'raw',
                    'hAlign' => 'center',
                    'value' => function ($model) {
                        if($model->mobile && $model->mobileCode) {
                            return '+'.$model->mobileCode->phonecode.' '.$model->mobile;
                        }
                        else if($model->mobile && !$model->mobileCode) {
                            return $model->mobile;
                        } else {
                            return '';
                        }
                    },
                    'width' => '10%'
                ],
                [
                    'attribute' => 'mobile_secondary',
                    'format' => 'raw',
                    'hAlign' => 'center',
                    'value' => function ($model) {
                        if($model->mobile_secondary && $model->mobileSecondaryCode) {
                            return '+'.$model->mobileSecondaryCode->phonecode.' '.$model->mobile_secondary;
                        } else if($model->mobile_secondary && !$model->mobileSecondaryCode) {
                            return $model->mobile_secondary;
                        } else {
                            return '';
                        }
                    },
                    'width' => '10%'
                ],
                [
                    'attribute' => 'phone',
                    'format' => 'raw',
                    'hAlign' => 'center',
                    'value' => function ($model) {
                        if($model->phone && $model->phoneCode) {
                            return '+'.$model->phoneCode->phonecode.' '.$model->phone;
                        } else if($model->phone && !$model->phoneCode) {
                            return $model->phone;
                        } else {
                            return '';
                        }
                    },
                    'width' => '10%'
                ],
                [
                    'attribute' => 'phone_secondary',
                    'format' => 'raw',
                    'hAlign' => 'center',
                    'value' => function ($model) {
                        if($model->phone_secondary && $model->phoneSecondaryCode) {
                            return '+'.$model->phoneSecondaryCode->phonecode.' '.$model->phone_secondary;
                        } else if($model->phone_secondary && !$model->phoneSecondaryCode) {
                            return $model->phone_secondary;
                        } else {
                            return '';
                        }
                    },
                    'width' => '10%'
                ],
                [
                    'attribute' => 'state',
                    'format' => 'raw',
                    'hAlign' => 'center',
                    'width' => '5%',
                    'value' => function ($model) {
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
            ],
        ]); ?>

    <?php Pjax::end(); ?>

</div>
