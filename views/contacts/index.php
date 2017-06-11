<?php

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
$this->registerJs('
    $(document).ready(function()
    {
        $("a.btn-update").click(function() {
            var selectedId = $("#w0").yiiGridView("getSelectedRows");

            if(selectedId.length == 0) {
                alert("'. Yii::t("traits", "Select at least one item").'");
            } else if(selectedId.length>1){
                alert("'. Yii::t("traits", "Select only 1 item").'");
            } else {
                var url = "'.Url::to(['/contacts/contacts/update']).'?id="+selectedId[0];
                window.location.href= url;
            }
        });
        $("a.btn-active").click(function() {
            var selectedId = $("#w0").yiiGridView("getSelectedRows");

            if(selectedId.length == 0) {
                alert("'. Yii::t("traits", "Select at least one item").'");
            } else {
                $.ajax({
                    type: \'POST\',
                    url : "'.Url::to(['/contacts/contacts/activemultiple']).'?id="+selectedId,
                    data : {ids: selectedId},
                    success : function() {
                        $.pjax.reload({container:"#w0"});
                    }
                });
            }
        });
        $("a.btn-deactive").click(function() {
            var selectedId = $("#w0").yiiGridView("getSelectedRows");

            if(selectedId.length == 0) {
                alert("'. Yii::t("traits", "Select at least one item").'");
            } else {
                $.ajax({
                    type: \'POST\',
                    url : "'.Url::to(['/contacts/contacts/deactivemultiple']).'?id="+selectedId,
                    data : {ids: selectedId},
                    success : function() {
                        $.pjax.reload({container:"#w0"});
                    }
                });
            }
        });
        $("a.btn-delete").click(function() {
            var selectedId = $("#w0").yiiGridView("getSelectedRows");

            if(selectedId.length == 0) {
                alert("'. Yii::t("traits", "Select at least one item").'");
            } else {
                var choose = confirm("'. Yii::t("traits", "Do you want delete selected items?").'");

                if (choose == true) {
                    $.ajax({
                        type: \'POST\',
                        url : "'.Url::to(['/contacts/contacts/deletemultiple']).'?id="+selectedId,
                        data : {ids: selectedId},
                        success : function() {
                            $.pjax.reload({container:"#w0"});
                        }
                    });
                }
            }
        });
    });
');

?>
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
                    'class' => '\kartik\grid\CheckboxColumn'
                ],
                [
                    'attribute' => 'name',
                    'format' => 'html',
                    'hAlign' => 'center',
                    'label' => Yii::t('contacts', 'Contact'),
                    'value' => function ($model) {
                        $url = urldecode(Url::toRoute(['/contacts/contacts/view', 'id' => $model->id]));
                        return Html::a($model->lastname." ".$model->firstname,$url);
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
                    'format' => 'html',
                    'hAlign' => 'center',
                    'value' => function ($model) {
                        if($model->mobile && $model->mobileCode) {
                            return "+".$model->mobileCode->phonecode." ".$model->mobile;
                        }
                        else if($model->mobile && !$model->mobileCode) {
                            return $model->mobile;
                        } else {
                            return "";
                        }
                    },
                    'width' => '10%'
                ],
                [
                    'attribute' => 'mobile_secondary',
                    'format' => 'html',
                    'hAlign' => 'center',
                    'value' => function ($model) {
                        if($model->mobile_secondary && $model->mobileSecondaryCode) {
                            return "+".$model->mobileSecondaryCode->phonecode." ".$model->mobile_secondary;
                        } else if($model->mobile_secondary && !$model->mobileSecondaryCode) {
                            return $model->mobile_secondary;
                        } else {
                            return "";
                        }
                    },
                    'width' => '10%'
                ],
                [
                    'attribute' => 'phone',
                    'format' => 'html',
                    'hAlign' => 'center',
                    'value' => function ($model) {
                        if($model->phone && $model->phoneCode) {
                            return "+".$model->phoneCode->phonecode." ".$model->phone;
                        } else if($model->phone && !$model->phoneCode) {
                            return $model->phone;
                        } else {
                            return "";
                        }
                    },
                    'width' => '10%'
                ],
                [
                    'attribute' => 'phone_secondary',
                    'format' => 'html',
                    'hAlign' => 'center',
                    'value' => function ($model) {
                        if($model->phone_secondary && $model->phoneSecondaryCode) {
                            return "+".$model->phoneSecondaryCode->phonecode." ".$model->phone_secondary;
                        } else if($model->phone_secondary && !$model->phoneSecondaryCode) {
                            return $model->phone_secondary;
                        } else {
                            return "";
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
                'before'     => '<span style="margin-right: 5px;">'.
                    Html::a('<i class="glyphicon glyphicon-plus"></i> '. Yii::t('traits', 'New'),
                        ['create'], ['class' => 'btn btn-success']
                    ).'</span><span style="margin-right: 5px;">'.
                    Html::a('<i class="glyphicon glyphicon-pencil"></i> '. Yii::t('traits', 'Update'),
                        '#', ['class' => 'btn btn-update btn-warning']
                    ).'</span><span style="margin-right: 5px;">'.
                    Html::a('<i class="glyphicon glyphicon-minus-sign"></i> '. Yii::t('traits', 'Delete'),
                        '#', ['class' => 'btn btn-delete btn-danger']
                    ).'</span><span style="float: right; margin-right: 5px;">'.
                    Html::a('<i class="glyphicon glyphicon-remove"></i> '. Yii::t('traits', 'Deactive'),
                        '#', ['class' => 'btn btn-deactive btn-danger']
                    ).'</span><span style="float: right; margin-right: 5px;">'.
                    Html::a('<i class="glyphicon glyphicon-ok"></i> '. Yii::t('traits', 'Active'),
                        ['#'], ['class' => 'btn btn-active btn-success']
                    ).'</span>',
                'after' => Html::a(
                    '<i class="glyphicon glyphicon-repeat"></i> '. Yii::t('traits', 'Reset Grid'), ['index'], ['class' => 'btn btn-info']
                ),
                'showFooter' => false
            ],
        ]); ?>

    <?php Pjax::end(); ?>

</div>
