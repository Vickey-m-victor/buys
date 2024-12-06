<?php

namespace cms\controllers;

use Yii;
use cms\models\Faqs;
use cms\models\searches\FaqsSearch;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;

/**
 * FaqsController implements the CRUD actions for Faqs model.
 */
class FaqsController extends DashboardController
{
    public $permissions = [
        'cms-faqs-list'=>'View Faqs List',
        'cms-faqs-create'=>'Add Faqs',
        'cms-faqs-update'=>'Edit Faqs',
        'cms-faqs-delete'=>'Delete Faqs',
        'cms-faqs-restore'=>'Restore Faqs',
        ];
    public function actionIndex()
    {
        Yii::$app->user->can('cms-faqs-list');
        $searchModel = new FaqsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        Yii::$app->user->can('cms-faqs-create');
        $model = new Faqs();
        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Faqs created successfully');
                        return $this->redirect(['index']);
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        } else {
            return $this->redirect(['index']);
        }
    }
    public function actionUpdate($id)
    {
        Yii::$app->user->can('cms-faqs-update');
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Faqs updated successfully');
                        return $this->redirect(['index']);
                    }
                }
            }
        }
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        } else {
            return $this->redirect(['index']);
        }
    }
    public function actionTrash($id)
    {
        $model = $this->findModel($id);
        if ($model->is_deleted) {
            Yii::$app->user->can('cms-faqs-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'Faqs has been restored');
        } else {
            Yii::$app->user->can('cms-faqs-delete');
            $model->delete();
            Yii::$app->session->setFlash('success', 'Faqs has been deleted');
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = Faqs::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
