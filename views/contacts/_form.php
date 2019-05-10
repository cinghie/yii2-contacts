<?php

/**
 * @var $form kartik\widgets\ActiveForm
 * @var $model cinghie\contacts\models\Contacts
 * @var $this yii\web\View
 */

use kartik\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;

// Get Phonecode Prefix
$prefix = Url::to(['/contacts/phonecode/prefix']);

?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin() ?>

    <div class="row">

        <div class="col-lg-6">



        </div>

        <div class="col-lg-6">

			<?= $model->getExitButton() ?>

			<?= $model->getCancelButton() ?>

			<?= $model->getSaveButton() ?>

        </div>

    </div>

    <div class="separator"></div>

    <div class="row">

        <div class="col-md-9">

            <div class="row">

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'firstname', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="glyphicon glyphicon-pencil"></i>'
			                ]
		                ],
	                ])->textInput(['maxlength' => true]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'lastname', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="glyphicon glyphicon-pencil"></i>'
			                ]
		                ],
	                ])->textInput(['maxlength' => true]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'rule', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="fa fa-user"></i>'
			                ]
		                ],
	                ])->textInput(['maxlength' => true]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'rule_type', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="fa fa-user-circle"></i>'
			                ]
		                ],
	                ])->textInput(['maxlength' => true]) ?>

                </div>

            </div>

            <div class="row">

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'email', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="fa fa-envelope"></i>'
			                ]
		                ]
	                ])->textInput(['maxlength' => true]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'email_secondary', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="fa fa-envelope"></i>'
			                ]
		                ]
	                ])->textInput(['maxlength' => true]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'skype', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="fab fa-skype"></i>'
			                ]
		                ]
	                ])->textInput(['maxlength' => true]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'website', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="fa fa-globe"></i>'
			                ]
		                ]
	                ])->textInput(['maxlength' => true]) ?>

                </div>

            </div>

            <div class="row">

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'phone_code')->widget(Select2::class, [
		                'initValueText' => $model->phoneCode ? $model->phoneCode->nicename : '',
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
	                ]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'phone', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="glyphicon glyphicon-phone-alt"></i>'
			                ]
		                ],
	                ])->textInput(['maxlength' => true]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'phone_secondary_code')->widget(Select2::class, [
		                'initValueText' => $model->phoneSecondaryCode ? $model->phoneSecondaryCode->nicename : '',
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
	                ]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'phone_secondary', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="glyphicon glyphicon-phone-alt"></i>'
			                ]
		                ],
	                ])->textInput(['maxlength' => true]) ?>

                </div>

            </div>

            <div class="row">

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'mobile_code')->widget(Select2::class, [
		                'initValueText' => $model->mobileCode ? $model->mobileCode->nicename : '',
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
	                ]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'mobile', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class=" glyphicon glyphicon-phone"></i>'
			                ]
		                ],
	                ])->textInput(['maxlength' => true]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'mobile_secondary_code')->widget(Select2::class, [
		                'initValueText' => $model->mobileSecondaryCode ? $model->mobileSecondaryCode->nicename : '',
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
	                ]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'mobile_secondary', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class=" glyphicon glyphicon-phone"></i>'
			                ]
		                ],
	                ])->textInput(['maxlength' => true]) ?>

                </div>

            </div>

            <div class="row">

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'fax_code')->widget(Select2::class, [
		                'initValueText' => $model->faxCode ? $model->faxCode->nicename : '',
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
	                ]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'fax', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="fa fa-fax"></i>'
			                ]
		                ]
	                ])->textInput(['maxlength' => true]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'fax_secondary_code')->widget(Select2::class, [
		                'initValueText' => $model->faxSecondaryCode ? $model->faxSecondaryCode->nicename : '',
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
	                ]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'fax_secondary', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="fa fa-fax"></i>'
			                ]
		                ]
	                ])->textInput(['maxlength' => true]) ?>

                </div>

            </div>

            <div class="row">

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'facebook', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="fab fa-facebook"></i>'
			                ]
		                ]
	                ])->textInput(['maxlength' => true]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'gplus', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="fab fa-google-plus"></i>'
			                ]
		                ]
	                ])->textInput(['maxlength' => true]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'instagram', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="fab fa-instagram"></i>'
			                ]
		                ]
	                ])->textInput(['maxlength' => true]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'twitter', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="fab fa-twitter"></i>'
			                ]
		                ]
	                ])->textInput(['maxlength' => true]) ?>

                </div>

            </div>

            <div class="row">

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'youtube', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="fab fa-youtube"></i>'
			                ]
		                ]
	                ])->textInput(['maxlength' => true]) ?>

                </div>

                <div class="col-md-3 col-sm-6">

	                <?= $form->field($model, 'linkedin', [
		                'addon' => [
			                'prepend' => [
				                'content'=>'<i class="fab fa-linkedin"></i>'
			                ]
		                ]
	                ])->textInput(['maxlength' => true]) ?>

                </div>

                <div class="col-md-3 col-sm-6">



                </div>

                <div class="col-md-3 col-sm-6">



                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

	                <?= $model->getEditorWidget($form, 'note', 'no-editor') ?>

                </div>

                <div class="col-md-6">



                </div>

            </div>

        </div>

        <div class="col-md-3">

	        <?= $model->getStateWidget($form) ?>

	        <?= $form->field($model, 'accept')->widget(Select2::class, [
		        'data' => [
			        '1' => Yii::t('traits', 'Accepted'),
			        '0' => Yii::t('traits', 'Not Accepted')
		        ],
		        'disabled' => true,
		        'addon' => [
			        'prepend' => [
				        'content'=>'<i class="glyphicon glyphicon-minus-sign"></i>'
			        ]
		        ],
	        ]) ?>

	        <?= $model->getUserWidget($form, true) ?>

	        <?= $model->getCreatedByWidget($form) ?>

	        <?= $model->getCreatedWidget($form) ?>

	        <?= $model->getModifiedByWidget($form) ?>

	        <?= $model->getModifiedWidget($form) ?>

        </div>

    </div>

    <?php ActiveForm::end() ?>

</div>
