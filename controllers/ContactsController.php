<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.1.0
 */

namespace cinghie\contacts\controllers;

use cinghie\contacts\models\Contacts;
use cinghie\contacts\models\ContactsSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class ContactsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['contacts-create-contacts'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['contacts-update-his-contacts','contacts-update-all-contacts'],
                        'matchCallback' => function ($rule, $action) {
                            return $this->userCanUpdate() === true;
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['contacts-view-contacts'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete','deletemultiple'],
                        'roles' => ['contacts-delete-his-contacts','contacts-delete-all-contacts'],
                        'matchCallback' => function ($rule, $action) {
                            return $this->userCanDelete() === true;
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['changestate','activemultiple','deactivemultiple'],
                        'roles' => ['contacts-publish-his-contacts','contacts-publish-all-contacts'],
                        'matchCallback' => function ($rule, $action) {
                            return $this->userCanPublish() === true;
                        }
                    ]
                ],
                'denyCallback' => function () {
                    throw new ForbiddenHttpException;
                }
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'activemultiple' => ['POST'],
                    'changestate' => ['POST'],
                    'deactivemultiple' => ['POST'],
                    'delete' => ['POST'],
                    'deletemultiple' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Contacts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactsSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contacts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        // Set EVENT_AFTER_VIEW
        $model->trigger(Contacts::EVENT_AFTER_VIEW);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Contacts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $post  = \Yii::$app->request->post();
        $model = new Contacts();

        if ( $model->load($post) ) {

            // Set Modified as actual date
            $model->modified = "0000-00-00 00:00:00";

            // If exist an user with the email, adding userid
            if($model->getUserIDByEmail($model->email)) {
                $model->userid = $model->getUserIDByEmail($model->email);
            } else {
                $model->userid = NULL;
            }

            if ( $model->save() ) {

                // Set EVENT_AFTER_CREATE
                $model->trigger(Contacts::EVENT_AFTER_CREATE);

                // Set Success Message
                \Yii::$app->session->setFlash('success', \Yii::t('contacts', 'Contact has been created!'));

                return $this->redirect(['index']);

            } else {

                // Set Error Message
                \Yii::$app->session->setFlash('error', \Yii::t('contacts', 'Contact could not be saved!'));

                return $this->render('create', [ 'model' => $model, ]);

            }
        } else {
            return $this->render('create', [ 'model' => $model, ]);
        }
    }

    /**
     * Updates an existing Contacts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $post  = \Yii::$app->request->post();
        $model = $this->findModel($id);

        if ( $model->load($post) ) {

            // Set Modified by User
            $model->modified_by = \Yii::$app->user->identity->id;

            // Set Modified as actual date
            $model->modified = date("Y-m-d H:i:s");

            // If exist an user with the email, adding userid
            if($model->getUserIDByEmail($model->email)) {
                $model->userid = $model->getUserIDByEmail($model->email);
            } else {
                $model->userid = NULL;
            }

            if( $model->save() ) {

                // Set EVENT_AFTER_UPDATE
                $model->trigger(Contacts::EVENT_AFTER_UPDATE);

                // Set Success Message
                \Yii::$app->session->setFlash('success', \Yii::t('contacts', 'Contact has been updated!'));

                return $this->redirect(['index']);

            } else {

                // Set Error Message
                \Yii::$app->session->setFlash('error', \Yii::t('contacts', 'Contact could not be saved!'));

                return $this->render('update', [ 'model' => $model, ]);
            }

        } else {

            return $this->render('update', [ 'model' => $model, ]);
        }
    }

    /**
     * Deletes an existing Contacts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        // Set EVENT_AFTER_DELETE
        $model->trigger(Contacts::EVENT_AFTER_DELETE);

        return $this->redirect(['index']);
    }

    /**
     * Deletes selected Contacts models.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionDeletemultiple()
    {
        $ids = \Yii::$app->request->post('ids');

        if (!$ids) {
            return;
        }

        foreach ($ids as $id)
        {
            $model = $this->findModel($id);

            if ($model->delete()) {

                // Set Success Message
                \Yii::$app->session->setFlash('success', \Yii::t('contacts', 'Contact has been deleted'));

            } else {

                // Set Error Message
                \Yii::$app->session->setFlash('error', \Yii::t('contacts', 'Error deleting Contact'));

            }
        }
    }

    /**
     * Change Contacts state: active or inactive
     * @param int $id
     * @return mixed
     */
    public function actionChangestate($id)
    {
        $model = $this->findModel($id);

        if($model->state) {

            $model->inactive();

            // Set EVENT_AFTER_DEACTIVE
            $model->trigger(Contacts::EVENT_AFTER_DEACTIVE);

            // Set Success Message
            \Yii::$app->getSession()->setFlash('warning', \Yii::t('contacts', 'Contact inactived'));

        } else {

            $model->active();

            // Set EVENT_AFTER_ACTIVE
            $model->trigger(Contacts::EVENT_AFTER_ACTIVE);

            // Set Success Message
            \Yii::$app->getSession()->setFlash('success', \Yii::t('contacts', 'Contact actived'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Active selected Contacts models.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionActivemultiple()
    {
        $ids = \Yii::$app->request->post('ids');

        if (!$ids) {
            return;
        }

        foreach ($ids as $id)
        {
            $model = $this->findModel($id);

            if(!$model->state) {

                $model->active();

                // Set EVENT_AFTER_ACTIVE
                $model->trigger(Contacts::EVENT_AFTER_ACTIVE);

                // Set Success Message
                \Yii::$app->getSession()->setFlash('success', \Yii::t('contacts', 'Contacts actived'));
            }
        }
    }

    /**
     * Active selected Contacts models.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionDeactivemultiple()
    {
        $ids = \Yii::$app->request->post('ids');

        if (!$ids) {
            return;
        }

        foreach ($ids as $id)
        {
            $model = $this->findModel($id);

            if($model->state) {

                $model->inactive();

                // Set EVENT_AFTER_DEACTIVE
                $model->trigger(Contacts::EVENT_AFTER_DEACTIVE);

                // Set Success Message
                \Yii::$app->getSession()->setFlash('warning', \Yii::t('contacts', 'Contacts inactived'));
            }
        }
    }

    /**
     * Finds the Contacts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contacts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contacts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Check if user can update
     * @return bool
     */
    protected function userCanUpdate()
    {
        $model = $this->findModel(\Yii::$app->request->get('id'));

        return ( \Yii::$app->user->can('contacts-update-all-contacts') || ( \Yii::$app->user->can('contacts-update-his-contacts') && ($model->isUserAuthor()) ) );
    }

    /**
     * Check if user can delete
     * @return bool
     */
    protected function userCanDelete()
    {
        $model = $this->findModel(\Yii::$app->request->get('id'));

        return ( \Yii::$app->user->can('contacts-delete-all-contacts') || ( \Yii::$app->user->can('contacts-delete-his-contacts') && ($model->isUserAuthor()) ) );
    }

    /**
     * Check if user can publish
     * @return bool
     */
    protected function userCanPublish()
    {
        $model = $this->findModel(\Yii::$app->request->get('id'));

        return ( \Yii::$app->user->can('contacts-publish-all-contacts') || ( \Yii::$app->user->can('contacts-publish-his-contacts') && ($model->isUserAuthor()) ) );
    }

}