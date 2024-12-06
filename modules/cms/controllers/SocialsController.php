<?php

namespace cms\controllers;

use Yii;
use cms\models\Socials;
use cms\models\searches\SocialsSearch;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;

/**
 * SocialsController implements the CRUD actions for Socials model.
 */
class SocialsController extends DashboardController
{
    public $permissions = [
        'cms-socials-list'=>'View Socials List',
        'cms-socials-create'=>'Add Socials',
        'cms-socials-update'=>'Edit Socials',
        'cms-socials-delete'=>'Delete Socials',
        'cms-socials-restore'=>'Restore Socials',
        ];
    public function actionIndex()
    {
        Yii::$app->user->can('cms-socials-list');
        $searchModel = new SocialsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        Yii::$app->user->can('cms-socials-create');
        $model = new Socials();
        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Socials created successfully');
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
        Yii::$app->user->can('cms-socials-update');
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Socials updated successfully');
                        return $this->redirect(['index']);
                    }
                }
            }
        }
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
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
            Yii::$app->user->can('cms-socials-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'Socials has been restored');
        } else {
            Yii::$app->user->can('cms-socials-delete');
            $model->delete();
            Yii::$app->session->setFlash('success', 'Socials has been deleted');
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = Socials::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
