<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @package yii2-contacts
 * @version 0.9.0
 */

use kartik\detail\DetailView;
use kartik\helpers\Html;
use yii\helpers\Url;

$this->title = $model->getFullname();
$this->params['breadcrumbs'][] = ['label' => \Yii::t('contacts', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row contacts-view">

    <?php if(\Yii::$app->getModule('contacts')->showTitles): ?>
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    <?php endif ?>

    <div class="col-md-12">

        <div class="col-md-6" style="padding: 0 10px 0 0">

            <?= DetailView::widget([
                'model' => $model,
                'condensed' => true,
                'enableEditMode' => true,
                'hover' => true,
                'mode' => DetailView::MODE_VIEW,
                'panel' => [
                    'heading' => \Yii::t('contacts', 'Contacts Informations'),
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
                                'format' => 'html',
                                'hAlign' => 'center',
                                'value' => $model->phone ? "+".$model->phoneCode->phonecode." ".$model->phone : '',
                                'valueColOptions' => ['style'=>'width:30%']
                            ],
                            [
                                'attribute' => 'phone_secondary',
                                'format' => 'html',
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
                                'format' => 'html',
                                'hAlign' => 'center',
                                'value' => $model->mobile ? "+".$model->mobileCode->phonecode." ".$model->mobile : '',
                                'valueColOptions' => ['style'=>'width:30%']
                            ],
                            [
                                'attribute' => 'mobile_secondary',
                                'format' => 'html',
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
                                'format' => 'html',
                                'hAlign' => 'center',
                                'value' => $model->fax ? "+".$model->faxcode->phonecode." ".$model->fax : '',
                                'valueColOptions' => ['style'=>'width:30%']
                            ],
                            [
                                'attribute' => 'fax_secondary',
                                'format' => 'html',
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
                        ]
                    ]
                ]
            ]); ?>

            <?= DetailView::widget([
                'model' => $model,
                'condensed' => true,
                'enableEditMode' => true,
                'hover' => true,
                'mode' => DetailView::MODE_VIEW,
                'panel' => [
                    'heading' => \Yii::t('contacts', 'Social Informations'),
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
                    ],[
                        'attribute' => 'instagram',
                        'format' => 'raw',
                        'hAlign' => 'center',
                        'value' => Html::a($model->instagram, $model->instagram, ['target' => 'blank'])
                    ],
                    [
                        'attribute' => 'linkedin',
                        'format' => 'raw',
                        'hAlign' => 'center',
                        'value' => Html::a($model->linkedin, $model->linkedin, ['target' => 'blank'])
                    ],
                    [
                        'attribute' => 'twitter',
                        'format' => 'raw',
                        'hAlign' => 'center',
                        'value' => Html::a($model->twitter, $model->twitter, ['target' => 'blank'])
                    ],[
                        'attribute' => 'youtube',
                        'format' => 'raw',
                        'hAlign' => 'center',
                        'value' => Html::a($model->youtube, $model->youtube, ['target' => 'blank'])
                    ]
                ]
            ]); ?>

        </div>

        <div class="col-md-6" style="padding: 0 0 0 10px">

            <?= DetailView::widget([
                'model' => $model,
                'enableEditMode' => false,
                'deleteOptions' => false,
                'condensed' => true,
                'hover' => true,
                'mode' => DetailView::MODE_VIEW,
                'panel' => [
                    'heading' => \Yii::t('contacts', 'Entry Informations'),
                    'type' => DetailView::TYPE_INFO,
                ],
                'attributes' => [
                    [
                        'attribute' => 'user_id',
                        'format' => 'raw',
                        'value' => $model->user_id ? Html::a($model->user->username,urldecode(Url::toRoute(['/user/admin/update', 'id' => $model->user_id]))) : \Yii::t('contacts', 'Nobody'),
                        'type' => DetailView::INPUT_SWITCH,
                        'valueColOptions'=> [
                            'style'=>'width:30%'
                        ]
                    ],
                    [
                        'attribute' => 'state',
                        'format' => 'raw',
                        'value' => $model->state ? '<span class="label label-success">'.\Yii::t('contacts', 'Actived').'</span>' : '<span class="label label-danger">'.\Yii::t('contacts', 'Deactivated').'</span>',
                        'type' => DetailView::INPUT_SWITCH,
                        'widgetOptions' => [
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ]
                        ],
                        'valueColOptions'=> [
                            'style'=>'width:30%'
                        ]
                    ],
                    [
                        'attribute' => 'created_by',
                        'format' => 'raw',
                        'value' => $model->created_by ? Html::a($model->createdBy->username,urldecode(Url::toRoute(['/user/admin/update', 'id' => $model->createdBy]))) : \Yii::t('contacts', 'Nobody'),
                        'type' => DetailView::INPUT_SWITCH,
                        'valueColOptions'=> [
                            'style'=>'width:30%'
                        ]
                    ],
                    [
                        'attribute' => 'created',
                    ],
                    [
                        'attribute' => 'modified_by',
                        'format' => 'raw',
                        'value' => $model->created_by ? Html::a($model->modifiedBy->username,urldecode(Url::toRoute(['/user/admin/update', 'id' => $model->modifiedBy]))) : \Yii::t('contacts', 'Nobody'),
                        'type' => DetailView::INPUT_SWITCH,
                        'valueColOptions'=> [
                            'style'=>'width:30%'
                        ]
                    ],
                    [
                        'attribute' => 'modified',
                    ],
                ]
            ]); ?>

        </div>

    </div>

</div>
