<?php

namespace cms\controllers;

use Yii;
use cms\models\BasicInfo;
use cms\models\searches\BasicInfoSearch;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;

/**
 * BasicInfoController implements the CRUD actions for BasicInfo model.
 */
class BasicInfoController extends DashboardController
{
    public $permissions = [
        'cms-basic-info-list'=>'View BasicInfo List',
        'cms-basic-info-create'=>'Add BasicInfo',
        'cms-basic-info-update'=>'Edit BasicInfo',
        'cms-basic-info-delete'=>'Delete BasicInfo',
        'cms-basic-info-restore'=>'Restore BasicInfo',
        ];
    public function actionIndex()
    {
        Yii::$app->user->can('cms-basic-info-list');
        $searchModel = new BasicInfoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        Yii::$app->user->can('cms-basic-info-create');
        $model = new BasicInfo();
        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'BasicInfo created successfully');
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
        Yii::$app->user->can('cms-basic-info-update');
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'BasicInfo updated successfully');
                        return $this->redirect(['/dashboard']);
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
            Yii::$app->user->can('cms-basic-info-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'BasicInfo has been restored');
        } else {
            Yii::$app->user->can('cms-basic-info-delete');
            if (!empty($model->imageURL)) {
                $filePath = Yii::getAlias('@webroot') . parse_url($model->imageURL, PHP_URL_PATH);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $model->delete();
            Yii::$app->session->setFlash('success', 'BasicInfo has been deleted');
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = BasicInfo::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function saveFile($model, $uploadedFile)
    {
        $uploadDirectory = Yii::getAlias('@webroot/uploads/banners/');
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        // Define file name using the service ID
        $fileName = 'banner_' . $model->id . '.' . $uploadedFile->extension;
        $filePath = $uploadDirectory . $fileName;

        // Delete old file if it exists
        if (!empty($model->imageURL)) {
            $oldFilePath = Yii::getAlias('@webroot') . parse_url($model->imageURL, PHP_URL_PATH);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        // Save the new file
        if ($uploadedFile->saveAs($filePath)) {
            $baseUrl = Yii::$app->request->hostInfo . Yii::$app->request->baseUrl;
            $model->imageURL = $baseUrl . '/uploads/banners/' . $fileName;

            // Save the model with the new imageURL
            $model->save(false);
        } else {
            Yii::$app->session->setFlash('error', 'Failed to upload the image.');
        }
    }
}
