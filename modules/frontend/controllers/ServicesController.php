<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Services;
use frontend\models\searches\ServicesSearch;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;

/**
 * ServicesController implements the CRUD actions for Services model.
 */
class ServicesController extends DashboardController
{
    public $permissions = [
        'frontend-services-list'=>'View Services List',
        'frontend-services-create'=>'Add Services',
        'frontend-services-update'=>'Edit Services',
        'frontend-services-delete'=>'Delete Services',
        'frontend-services-restore'=>'Restore Services',
        ];
    public function actionIndex()
    {
        Yii::$app->user->can('frontend-services-list');
        $searchModel = new ServicesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        Yii::$app->user->can('frontend-services-create');
        $model = new Services();
        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Services created successfully');
                        return $this->redirect(['index']);
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionUpdate($id)
    {
        Yii::$app->user->can('frontend-services-update');
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Services updated successfully');
                        return $this->redirect(['index']);
                    }
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionTrash($id)
    {
        $model = $this->findModel($id);
        if ($model->is_deleted) {
            Yii::$app->user->can('frontend-services-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'Services has been restored');
        } else {
            Yii::$app->user->can('frontend-services-delete');
            $model->delete();
            Yii::$app->session->setFlash('success', 'Services has been deleted');
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = Services::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
