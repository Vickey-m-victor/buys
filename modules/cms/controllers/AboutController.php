<?php

namespace cms\controllers;

use Yii;
use cms\models\About;
use cms\models\searches\AboutSearch;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * AboutController implements the CRUD actions for About model.
 */
class AboutController extends DashboardController
{
    public $permissions = [
        'cms-about-list'=>'View About List',
        'cms-about-create'=>'Add About',
        'cms-about-update'=>'Edit About',
        'cms-about-delete'=>'Delete About',
        'cms-about-restore'=>'Restore About',
        ];
    public function actionIndex()
    {
        Yii::$app->user->can('cms-about-list');
        $searchModel = new AboutSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        Yii::$app->user->can('cms-about-create');
        $model = new About();
        return $this->redirect(['/update',['id' => 1]]);
       
    }
    public function actionUpdate($id)
    {
        Yii::$app->user->can('cms-about-update');
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            $uploadedFile = UploadedFile::getInstance($model, 'file');

            if ($model->load($this->request->post()) && $model->validate() && $model->save(false)) {
                if ($uploadedFile) {
                    $this->saveFile($model, $uploadedFile);
                }

                Yii::$app->session->setFlash('success', 'about us updated successfully.');
                return $this->redirect(['/cms/about/update', 'id' => $model->id]);
            }

            Yii::$app->session->setFlash('error', 'Failed');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionTrash($id)
    {
        $model = $this->findModel($id);
        if ($model->is_deleted) {
            Yii::$app->user->can('cms-about-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'About has been restored');
        } else {
            Yii::$app->user->can('cms-about-delete');
            $model->delete();
            Yii::$app->session->setFlash('success', 'About has been deleted');
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = About::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function saveFile($model, $uploadedFile)
    {
        $uploadDirectory = Yii::getAlias('@webroot/uploads/about/');
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        // Define file name using the service ID
        $fileName = 'about_' . $model->id . '.' . $uploadedFile->extension;
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
            $model->imageURL = $baseUrl . '/uploads/about/' . $fileName;

            // Save the model with the new imageURL
            $model->save(false);
        } else {
            Yii::$app->session->setFlash('error', 'Failed to upload the image.');
        }
    }
}
