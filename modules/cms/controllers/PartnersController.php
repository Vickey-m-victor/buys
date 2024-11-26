<?php

namespace cms\controllers;

use Yii;
use cms\models\Partners;
use cms\models\searches\PartnersSearch;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * PartnersController implements the CRUD actions for Partners model.
 */
class PartnersController extends DashboardController
{
    public $permissions = [
        'cms-partners-list'=>'View Partners List',
        'cms-partners-create'=>'Add Partners',
        'cms-partners-update'=>'Edit Partners',
        'cms-partners-delete'=>'Delete Partners',
        'cms-partners-restore'=>'Restore Partners',
        ];
    public function actionIndex()
    {
        Yii::$app->user->can('cms-partners-list');
        $searchModel = new PartnersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        Yii::$app->user->can('cms-partners-create');
        $model = new Partners();
        if ($this->request->isPost) {
            $uploadedFile = UploadedFile::getInstance($model, 'file');

            if ($model->load($this->request->post()) && $model->validate() && $model->save(false)) {
                if ($uploadedFile) {
                    $this->saveFile($model, $uploadedFile);
                }

                Yii::$app->session->setFlash('success', 'product created successfully.');
                return $this->redirect(['index', 'model' => $model]);
            }

            Yii::$app->session->setFlash('error', 'Failed to create the product.');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionUpdate($id)
    {
        Yii::$app->user->can('cms-partners-update');
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            $uploadedFile = UploadedFile::getInstance($model, 'file');

            if ($model->load($this->request->post()) && $model->validate() && $model->save(false)) {
                if ($uploadedFile) {
                    $this->saveFile($model, $uploadedFile);
                }

                Yii::$app->session->setFlash('success', 'Product updated successfully.');
                return $this->redirect(['index', 'model' => $model]);
            }

            Yii::$app->session->setFlash('error', 'Failed to update the product.');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionTrash($id)
    {
        $model = $this->findModel($id);
        if ($model->is_deleted) {
            Yii::$app->user->can('cms-partners-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'Partners has been restored');
        } else {
            Yii::$app->user->can('cms-partners-delete');
            $filePath = Yii::getAlias('@webroot') . parse_url($model->imageURL, PHP_URL_PATH);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            $model->delete();
            Yii::$app->session->setFlash('success', 'Partners has been deleted');
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = Partners::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function saveFile($model, $uploadedFile)
    {
        $uploadDirectory = Yii::getAlias('@webroot/uploads/partners/');
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        // Define file name using the service ID
        $fileName = 'partner_' . $model->id . '.' . $uploadedFile->extension;
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
            $model->imageURL = $baseUrl . '/uploads/partners/' . $fileName;

            // Save the model with the new imageURL
            $model->save(false);
        } else {
            Yii::$app->session->setFlash('error', 'Failed to upload the image.');
        }
    }
}
