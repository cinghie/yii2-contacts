<?php

/**
 * @var \cinghie\contacts\models\Contacts $model
 */

use kartik\detail\DetailView;
use kartik\helpers\Html;
use yii\helpers\HtmlPurifier;

$this->title = $model->getFullname();
$this->params['breadcrumbs'][] = ['label' => Yii::t('contacts', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">

    <!-- action menu -->
    <div class="col-md-6"></div>

    <!-- action buttons -->
    <div class="col-md-6">

		<?= $model->getDeactiveButton($model->id) ?>

		<?= $model->getActiveButton($model->id) ?>

		<?= $model->getDeleteButton($model->id) ?>

		<?= $model->getUpdateButton($model->id) ?>

		<?= $model->getCreateButton() ?>

    </div>

</div>

<div class="separator"></div>

<div class="row contacts-view">

    <?php if(Yii::$app->getModule('contacts')->showTitles): ?>
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    <?php endif ?>

    <div class="col-lg-12">

        <div class="row">

            <div class="col-lg-6 col-md-12">

                <?= DetailView::widget([
                    'model' => $model,
                    'condensed' => true,
                    'enableEditMode' => false,
                    'hover' => true,
                    'mode' => DetailView::MODE_VIEW,
                    'panel' => [
                        'heading' => Yii::t('contacts', 'Contacts Informations'),
                        'type' => DetailView::TYPE_INFO,
                    ],
                    'attributes'=> [
                        [
                            'columns' => [
                                [
                                    'attribute' => 'firstname',
                                    'valueColOptions' => ['style'=>'width:30%']
                                ],
                                [
                                    'attribute' => 'lastname',
                                    'valueColOptions' => ['style'=>'width:30%']
                                ]
                            ]
                        ],
	                    [
		                    'columns' => [
			                    [
				                    'attribute' => 'rule',
				                    'valueColOptions' => ['style'=>'width:30%']
			                    ],
			                    [
				                    'attribute' => 'rule_type',
				                    'valueColOptions' => ['style'=>'width:30%']
			                    ]
		                    ]
	                    ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'email',
                                    'format' => 'email',
                                ]
                            ]
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'email_secondary',
                                    'format' => 'email',
                                ]
                            ]
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'phone',
                                    'format' => 'raw',
                                    'hAlign' => 'center',
                                    'value' => $model->phone ? "+".$model->phoneCode->phonecode." ".$model->phone : '',
                                    'valueColOptions' => ['style'=>'width:30%']
                                ],
                                [
                                    'attribute' => 'phone_secondary',
                                    'format' => 'raw',
                                    'hAlign' => 'center',
                                    'value' => $model->phone_secondary ? "+".$model->phoneSecondaryCode->phonecode." ".$model->phone_secondary : '',
                                    'valueColOptions' => ['style'=>'width:30%']
                                ]
                            ]
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'mobile',
                                    'format' => 'raw',
                                    'hAlign' => 'center',
                                    'value' => $model->mobile ? "+".$model->mobileCode->phonecode." ".$model->mobile : '',
                                    'valueColOptions' => ['style'=>'width:30%']
                                ],
                                [
                                    'attribute' => 'mobile_secondary',
                                    'format' => 'raw',
                                    'hAlign' => 'center',
                                    'value' => $model->mobile_secondary ? "+".$model->mobileSecondaryCode->phonecode." ".$model->mobile_secondary : '',
                                    'valueColOptions' => ['style'=>'width:30%']
                                ]
                            ],
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'fax',
                                    'format' => 'raw',
                                    'hAlign' => 'center',
                                    'value' => $model->fax ? "+".$model->faxcode->phonecode." ".$model->fax : '',
                                    'valueColOptions' => ['style'=>'width:30%']
                                ],
                                [
                                    'attribute' => 'fax_secondary',
                                    'format' => 'raw',
                                    'hAlign' => 'center',
                                    'value' => $model->fax_secondary ? "+".$model->faxSecondaryCode->phonecode." ".$model->fax_secondary : '',
                                    'valueColOptions' => ['style'=>'width:30%']
                                ]
                            ],
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'website',
                                    'format' => 'raw',
                                    'hAlign' => 'center',
                                    'value' => Html::a($model->website, $model->website, ['target' => 'blank'])
                                ]
                            ],
                            'columns' => [
	                            [
		                            'attribute' => 'note',
		                            'format' => 'raw',
		                            'hAlign' => 'center',
		                            'value' => HtmlPurifier::process($model->note)
	                            ]
                            ]
                        ]
                    ]
                ]); ?>

                <?= DetailView::widget([
                    'model' => $model,
                    'condensed' => true,
                    'enableEditMode' => false,
                    'hover' => true,
                    'mode' => DetailView::MODE_VIEW,
                    'panel' => [
                        'heading' => Yii::t('contacts', 'Social Informations'),
                        'type' => DetailView::TYPE_INFO,
                    ],
                    'deleteOptions' => false,
                    'attributes' => [
                        [
                            'attribute' => 'skype',
                            'format' => 'raw',
                            'hAlign' => 'center',
                            'value' => Html::a($model->skype, 'skype:cinghie?add')
                        ],
                        [
                            'attribute' => 'facebook',
                            'format' => 'raw',
                            'hAlign' => 'center',
                            'value' => Html::a($model->facebook, $model->facebook, ['target' => 'blank'])
                        ],
                        [
                            'attribute' => 'gplus',
                            'format' => 'raw',
                            'hAlign' => 'center',
                            'value' => Html::a($model->gplus, $model->gplus, ['target' => 'blank'])
                        ],
	                    [
		                    'attribute' => 'twitter',
		                    'format' => 'raw',
		                    'hAlign' => 'center',
		                    'value' => Html::a($model->twitter, $model->twitter, ['target' => 'blank'])
	                    ],
                        [
                            'attribute' => 'instagram',
                            'format' => 'raw',
                            'hAlign' => 'center',
                            'value' => Html::a($model->instagram, $model->instagram, ['target' => 'blank'])
                        ],
                        [
                            'attribute' => 'youtube',
                            'format' => 'raw',
                            'hAlign' => 'center',
                            'value' => Html::a($model->youtube, $model->youtube, ['target' => 'blank'])
                        ],
	                    [
		                    'attribute' => 'linkedin',
		                    'format' => 'raw',
		                    'hAlign' => 'center',
		                    'value' => Html::a($model->linkedin, $model->linkedin, ['target' => 'blank'])
	                    ]
                    ]
                ]); ?>

            </div>

            <div class="col-lg-6 col-md-12">

                <?= $model->getEntryInformationsDetailView() ?>

            </div>

        </div>

    </div>

</div>
