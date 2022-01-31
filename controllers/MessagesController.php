<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.9.8
 */

namespace cinghie\contacts\controllers;

use RuntimeException;
use Throwable;
use Yii;
use cinghie\contacts\models\Messages;
use cinghie\contacts\models\MessagesSearch;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class MessagesController
 */
class MessagesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','create','update','delete','deletemultiple','view'],
                        'roles' => ['admin']
                    ],
                ],
                'denyCallback' => static function () {
                    throw new RuntimeException(Yii::t('traits','You are not allowed to access this page'));
                }
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Messages models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MessagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Messages model.
     *
     * @param integer $id
     *
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

	/**
	 * Deletes an existing Messages model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return Response
     * @throws NotFoundHttpException if the model cannot be found
	 * @throws StaleObjectException
	 * @throws Throwable
	 */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

	/**
	 * Deletes selected Contacts models.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @throws NotFoundHttpException
	 * @throws StaleObjectException
	 * @throws Throwable
	 */
	public function actionDeletemultiple()
	{
		$ids = Yii::$app->request->post('ids');

		if (!$ids) {
			return;
		}

		foreach ($ids as $id)
		{
			$model = $this->findModel($id);

			if ($model->delete()) {
				// Set Success Message
				Yii::$app->session->setFlash('success', Yii::t('contacts', 'Messages has been deleted!'));
			} else {
				// Set Error Message
				Yii::$app->session->setFlash('error', Yii::t('contacts', 'Error deleting Message!'));
			}
		}
	}

    /**
     * Finds the Messages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Messages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Messages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('traits', 'The requested page does not exist.'));
    }
}
