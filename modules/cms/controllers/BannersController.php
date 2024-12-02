<?php

namespace cms\controllers;

use Yii;
use cms\models\Banners;
use cms\models\searches\BannersSearch;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * BannersController implements the CRUD actions for Banners model.
 */
class BannersController extends DashboardController
{
    public $permissions = [
        'cms-banners-list'=>'View Banners List',
        'cms-banners-create'=>'Add Banners',
        'cms-banners-update'=>'Edit Banners',
        'cms-banners-delete'=>'Delete Banners',
        'cms-banners-restore'=>'Restore Banners',
        ];
    public function actionIndex()
    {
        Yii::$app->user->can('cms-banners-list');
        $searchModel = new BannersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        // Yii::$app->user->can('cms-banners-create');
        $model = new Banners();
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
        Yii::$app->user->can('cms-banners-update');
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
            Yii::$app->user->can('cms-banners-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'Banners has been restored');
        } else {
            Yii::$app->user->can('cms-banners-delete');
            if (!empty($model->imageURL)) {
                $filePath = Yii::getAlias('@webroot') . parse_url($model->imageURL, PHP_URL_PATH);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $model->delete();
            Yii::$app->session->setFlash('success', 'Banners has been deleted');
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = Banners::findOne(['id' => $id])) !== null) {
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
