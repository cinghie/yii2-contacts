<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.9.7
 */

namespace cinghie\contacts\controllers;

use Throwable;
use Yii;
use cinghie\contacts\models\Forms;
use cinghie\contacts\models\FormsSearch;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * FormsController implements the CRUD actions for Forms model.
 */
class FormsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Forms models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FormsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Forms model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Forms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Forms();
	    $post  = Yii::$app->request->post();

	    if ( $model->load($post) )
	    {
		    if ( $model->save() )
		    {
			    // Set Success Message
			    Yii::$app->session->setFlash('success', Yii::t('contacts', 'Contact has been created!'));

			    return $this->redirect(['update', 'id' => $model->id]);
		    }

		    // Set Error Message
		    Yii::$app->session->setFlash('error', Yii::t('contacts', 'Contact could not be saved!'));

		    return $this->render('create', [ 'model' => $model, ]);
	    }

	    return $this->render('create', [ 'model' => $model, ]);
    }

    /**
     * Updates an existing Forms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
	    $post  = Yii::$app->request->post();

	    if ( $model->load($post) )
	    {
		    if( $model->save() )
		    {
			    // Set Success Message
			    Yii::$app->session->setFlash('success', Yii::t('contacts', 'Form has been updated!'));

			    return $this->render('update', [ 'model' => $model, ]);
		    }

		    // Set Error Message
		    Yii::$app->session->setFlash('error', Yii::t('contacts', 'Form could not be saved!'));

		    return $this->render('update', [ 'model' => $model, ]);
	    }

	    return $this->render('update', [ 'model' => $model, ]);
    }

	/**
	 * Deletes an existing Forms model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
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
				Yii::$app->session->setFlash('success', Yii::t('contacts', 'Form has been deleted!'));
			} else {
				// Set Error Message
				Yii::$app->session->setFlash('error', Yii::t('contacts', 'Error deleting Form!'));
			}
		}
	}

    /**
     * Finds the Forms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Forms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Forms::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('traits', 'The requested page does not exist.'));
    }
}
