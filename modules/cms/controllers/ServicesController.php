<?php

namespace cms\controllers;

use Yii;
use cms\models\Services;
use cms\models\searches\servicesSearch;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ServicesController implements the CRUD actions for Services model.
 */
class ServicesController extends DashboardController
{
    public $permissions = [
        'cms-services-list'=>'View Services List',
        'cms-services-create'=>'Add Services',
        'cms-services-update'=>'Edit Services',
        'cms-services-delete'=>'Delete Services',
        'cms-services-restore'=>'Restore Services',
        ];
    public function actionIndex()
    {
        Yii::$app->user->can('cms-services-list');
        $searchModel = new servicesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        Yii::$app->user->can('cms-services-create');
        $model = new Services();

        if ($this->request->isPost) {
            $uploadedFile = UploadedFile::getInstance($model, 'file');

            if ($model->load($this->request->post()) && $model->validate() && $model->save(false)) {
                if ($uploadedFile) {
                    $this->saveFile($model, $uploadedFile);
                }

                Yii::$app->session->setFlash('success', 'Service created successfully.');
                return $this->redirect(['index', 'model' => $model]);
            }

            Yii::$app->session->setFlash('error', 'Failed to create the service.');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionUpdate($id)
    {
        Yii::$app->user->can('cms-services-update');
        $model = $this->findModel($id);
        if ($this->request->isPost) {
            $uploadedFile = UploadedFile::getInstance($model, 'file');

            if ($model->load($this->request->post()) && $model->validate() && $model->save(false)) {
                if ($uploadedFile) {
                    $this->saveFile($model, $uploadedFile);
                }

                Yii::$app->session->setFlash('success', 'Service updated successfully.');
                return $this->redirect(['index', 'model' => $model]);
            }

            Yii::$app->session->setFlash('error', 'Failed to update the service.');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionTrash($id)
    {
        $model = $this->findModel($id);
        if ($model->is_deleted) {
            // Yii::$app->user->can('cms-services-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'Services has been restored');
        } else {
            // Yii::$app->user->can('cms-services-delete');
            if (!empty($model->imageURL)) {
                $filePath = Yii::getAlias('@webroot') . parse_url($model->imageURL, PHP_URL_PATH);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
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
    protected function saveFile($model, $uploadedFile)
    {
        $uploadDirectory = Yii::getAlias('@webroot/uploads/services/');
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        // Define file name using the service ID
        $fileName = 'services_' . $model->id . '.' . $uploadedFile->extension;
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
            $model->imageURL = $baseUrl . '/uploads/services/' . $fileName;

            // Save the model with the new imageURL
            $model->save(false);
        } else {
            Yii::$app->session->setFlash('error', 'Failed to upload the image.');
        }
    }
}
