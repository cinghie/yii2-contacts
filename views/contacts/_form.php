<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @package yii2-contacts
 * @version 0.9.3
 */

use kartik\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;
use kartik\widgets\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;

// Get Phonecode Prefix
$prefix = Url::to(['/contacts/phonecode/prefix']);

// Get current user
$user     = \Yii::$app->user->identity;
$user_id  = $user->id;
$username = $user->username;

if($model->isNewRecord) {
    $created = date("Y-m-d H:i:s");
    $created_by = $user_id;
    $created_by_username = $username;
    $modified = "0000-00-00 00:00:00";
    $modified_by = NULL;
} else {
    $created = $model->created;
    $created_by = $model->created_by;
    $created_by_username = $model->createdBy->username;
    $modified = date("Y-m-d H:i:s");
    $modified_by = $model->modified_by;
}

?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-lg-12">

            <div class="row">

                <div class="col-lg-9">

                    <div class="row">

                        <div class="col-lg-6">

                            <div class="row">

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'firstname', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="glyphicon glyphicon-pencil"></i>'
                                            ]
                                        ],
                                    ])->textInput(['maxlength' => true]) ?>

                                </div>

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'lastname', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="glyphicon glyphicon-pencil"></i>'
                                            ]
                                        ],
                                    ])->textInput(['maxlength' => true]) ?>

                                </div>

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'email', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="fa fa-envelope"></i>'
                                            ]
                                        ]
                                    ])->textInput(['maxlength' => true]) ?>

                                </div>

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'email_secondary', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="fa fa-envelope"></i>'
                                            ]
                                        ]
                                    ])->textInput(['maxlength' => true]) ?>

                                </div>

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'phone_code')->widget(Select2::classname(), [
                                        'initValueText' => $model->phoneCode ? $model->phoneCode->nicename : "",
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="glyphicon glyphicon-flag"></i>'
                                            ]
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'ajax' => [
                                                'url' => $prefix,
                                                'dataType' => 'json',
                                                'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                            ],
                                            'language' => [
                                                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                                            ],
                                            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                            'templateResult' => new JsExpression('function (country) { return country.text; }'),
                                            'templateSelection' => new JsExpression('function (country) { return country.text; }'),
                                        ],
                                    ]); ?>

                                </div>

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'phone', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="glyphicon glyphicon-phone-alt"></i>'
                                            ]
                                        ],
                                    ])->textInput(['maxlength' => true]) ?>

                                </div>

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'mobile_code')->widget(Select2::classname(), [
                                        'initValueText' => $model->mobileCode ? $model->mobileCode->nicename : "",
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="glyphicon glyphicon-flag"></i>'
                                            ]
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'language' => [
                                                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                                            ],
                                            'ajax' => [
                                                'url' => $prefix,
                                                'dataType' => 'json',
                                                'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                            ],
                                            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                            'templateResult' => new JsExpression('function (country) { return country.text; }'),
                                            'templateSelection' => new JsExpression('function (country) { return country.text; }'),
                                        ],
                                    ]); ?>

                                </div>

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'mobile', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class=" glyphicon glyphicon-phone"></i>'
                                            ]
                                        ],
                                    ])->textInput(['maxlength' => true]) ?>

                                </div>

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'fax_code')->widget(Select2::classname(), [
                                        'initValueText' => $model->faxCode ? $model->faxCode->nicename : "",
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="glyphicon glyphicon-flag"></i>'
                                            ]
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'ajax' => [
                                                'url' => $prefix,
                                                'dataType' => 'json',
                                                'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                            ],
                                            'language' => [
                                                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                                            ],
                                            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                            'templateResult' => new JsExpression('function (country) { return country.text; }'),
                                            'templateSelection' => new JsExpression('function (country) { return country.text; }'),
                                        ]
                                    ]); ?>

                                    <?= $form->field($model, 'facebook', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="fa fa-facebook"></i>'
                                            ]
                                        ]
                                    ])->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'linkedin', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="fa fa-linkedin"></i>'
                                            ]
                                        ]
                                    ])->textInput(['maxlength' => true]) ?>

                                </div>

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'fax', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="fa fa-fax"></i>'
                                            ]
                                        ]
                                    ])->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'gplus', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="fa fa-google-plus"></i>'
                                            ]
                                        ]
                                    ])->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'youtube', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="fa fa-youtube"></i>'
                                            ]
                                        ]
                                    ])->textInput(['maxlength' => true]) ?>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-6">

                            <div class="row">

                                <div class="col-lg-12">

                                    <?php if($model->isNewRecord && !$model->user_id || $model->user_id == 0): ?>

                                        <?= $form->field($model, 'user_id')->textInput([
                                            'disabled' => true,
                                            'value' => \Yii::t('newsletters', 'Nobody')
                                        ]) ?>

                                    <?php else: ?>

                                        <?= $form->field($model, 'user_id')->textInput([
                                            'disabled' => true,
                                            'value' => $model->user->username
                                        ]) ?>

                                    <?php endif ?>

                                </div>

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'skype', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="fa fa-skype"></i>'
                                            ]
                                        ]
                                    ])->textInput(['maxlength' => true]) ?>

                                </div>

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'website', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="fa fa-globe"></i>'
                                            ]
                                        ]
                                    ])->textInput(['maxlength' => true]) ?>

                                </div>
                                <div class="col-lg-6">

                                    <?= $form->field($model, 'phone_secondary_code')->widget(Select2::classname(), [
                                        'initValueText' => $model->phoneSecondaryCode ? $model->phoneSecondaryCode->nicename : "",
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="glyphicon glyphicon-flag"></i>'
                                            ]
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'language' => [
                                                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                                            ],
                                            'ajax' => [
                                                'url' => $prefix,
                                                'dataType' => 'json',
                                                'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                            ],
                                            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                            'templateResult' => new JsExpression('function (country) { return country.text; }'),
                                            'templateSelection' => new JsExpression('function (country) { return country.text; }'),
                                        ],
                                    ]); ?>

                                </div>

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'phone_secondary', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="glyphicon glyphicon-phone-alt"></i>'
                                            ]
                                        ],
                                    ])->textInput(['maxlength' => true]) ?>

                                </div>

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'mobile_secondary_code')->widget(Select2::classname(), [
                                        'initValueText' => $model->mobileSecondaryCode ? $model->mobileSecondaryCode->nicename : "",
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="glyphicon glyphicon-flag"></i>'
                                            ]
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'language' => [
                                                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                                            ],
                                            'ajax' => [
                                                'url' => $prefix,
                                                'dataType' => 'json',
                                                'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                            ],
                                            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                            'templateResult' => new JsExpression('function (country) { return country.text; }'),
                                            'templateSelection' => new JsExpression('function (country) { return country.text; }'),
                                        ],
                                    ]); ?>

                                </div>

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'mobile_secondary', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class=" glyphicon glyphicon-phone"></i>'
                                            ]
                                        ],
                                    ])->textInput(['maxlength' => true]) ?>

                                </div>

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'fax_secondary_code')->widget(Select2::classname(), [
                                        'initValueText' => $model->faxSecondaryCode ? $model->faxSecondaryCode->nicename : "",
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="glyphicon glyphicon-flag"></i>'
                                            ]
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'language' => [
                                                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                                            ],
                                            'ajax' => [
                                                'url' => $prefix,
                                                'dataType' => 'json',
                                                'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                            ],
                                            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                            'templateResult' => new JsExpression('function (country) { return country.text; }'),
                                            'templateSelection' => new JsExpression('function (country) { return country.text; }'),
                                        ]
                                    ]); ?>

                                    <?= $form->field($model, 'instagram', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="fa fa-instagram"></i>'
                                            ]
                                        ]
                                    ])->textInput(['maxlength' => true]) ?>

                                </div>

                                <div class="col-lg-6">

                                    <?= $form->field($model, 'fax_secondary', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="fa fa-fax"></i>'
                                            ]
                                        ]
                                    ])->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'twitter', [
                                        'addon' => [
                                            'prepend' => [
                                                'content'=>'<i class="fa fa-twitter"></i>'
                                            ]
                                        ]
                                    ])->textInput(['maxlength' => true]) ?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-3">

                    <?= $form->field($model, 'state')->widget(Select2::classname(), [
                        'data' => $model->getPublishSelect2(),
                        'addon' => [
                            'prepend' => [
                                'content'=>'<i class="glyphicon glyphicon-check"></i>'
                            ]
                        ],
                    ]); ?>

                    <?= $form->field($model, 'created_by')->widget(Select2::classname(), [
                        'data' => [
                            $created_by => $created_by_username
                        ],
                        'addon' => [
                            'prepend' => [
                                'content'=>'<i class="glyphicon glyphicon-user"></i>'
                            ]
                        ],
                    ]); ?>

                    <?php echo $form->field($model, 'created')->widget(DateTimePicker::classname(), [
                        'options' => [
                            'value' => $created,
                        ],
                        'pluginOptions' => [
                            'autoclose'      => true,
                            'format'         => 'yyyy-mm-dd hh:ii:ss',
                            'todayHighlight' => true,
                        ]
                    ]); ?>

                    <?= $form->field($model, 'modified_by')->widget(Select2::classname(), [
                        'data' => [
                            $modified_by => $modified_by->username
                        ],
                        'addon' => [
                            'prepend' => [
                                'content'=>'<i class="glyphicon glyphicon-user"></i>'
                            ]
                        ],
                    ]); ?>

                    <?php echo $form->field($model, 'modified')->widget(DateTimePicker::classname(), [
                        'disabled' => true,
                        'options' => [
                            'value' => $modified,
                        ],
                        'pluginOptions' => [
                            'autoclose'      => true,
                            'format'         => 'yyyy-mm-dd hh:ii:ss',
                            'todayHighlight' => true,
                        ]
                    ]); ?>

                </div>

                <div class="col-lg-12">

                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? \Yii::t('newsletters', 'Create') : \Yii::t('newsletters', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
