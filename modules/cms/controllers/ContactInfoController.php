<?php

namespace cms\controllers;

use Yii;
use cms\models\ContactInfo;
use cms\models\searches\ContactInfoSearch;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ContactInfoController implements the CRUD actions for ContactInfo model.
 */
class ContactInfoController extends DashboardController
{
    public $permissions = [
        'cms-contact-info-list'=>'View ContactInfo List',
        'cms-contact-info-create'=>'Add ContactInfo',
        'cms-contact-info-update'=>'Edit ContactInfo',
        'cms-contact-info-delete'=>'Delete ContactInfo',
        'cms-contact-info-restore'=>'Restore ContactInfo',
        ];
    public function actionIndex()
    {
        Yii::$app->user->can('cms-contact-info-list');
        $searchModel = new ContactInfoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        Yii::$app->user->can('cms-contact-info-create');
        $model = new ContactInfo();
        if ($this->request->isPost) {
            $uploadedFile = UploadedFile::getInstance($model, 'file');

            if ($model->load($this->request->post()) && $model->validate() && $model->save(false)) {
                if ($uploadedFile) {
                    $this->saveFile($model, $uploadedFile);
                }

                Yii::$app->session->setFlash('success', 'Banner created successfully.');
                return $this->redirect(['index', 'model' => $model]);
            }

            Yii::$app->session->setFlash('error', 'Failed to create the banner.');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionUpdate($id)
    {
        Yii::$app->user->can('cms-contact-info-update');
        $model = $this->findModel($id);
        $model = $this->findModel($id);
        if ($this->request->isPost) {
            $uploadedFile = UploadedFile::getInstance($model, 'file');

            if ($model->load($this->request->post()) && $model->validate() && $model->save(false)) {
                if ($uploadedFile) {
                    $this->saveFile($model, $uploadedFile);
                }

                Yii::$app->session->setFlash('success', 'Banner updated successfully.');
                return $this->redirect(['index', 'model' => $model]);
            }

            Yii::$app->session->setFlash('error', 'Failed to update the banner.');
        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }
    public function actionTrash($id)
    {
        $model = $this->findModel($id);
        if ($model->is_deleted) {
            Yii::$app->user->can('cms-contact-info-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'ContactInfo has been restored');
        } else {
            Yii::$app->user->can('cms-contact-info-delete');
            $model->delete();
            Yii::$app->session->setFlash('success', 'ContactInfo has been deleted');
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = ContactInfo::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
