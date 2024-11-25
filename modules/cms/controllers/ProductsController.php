<?php

namespace cms\controllers;

use Yii;
use cms\models\Products;
use cms\models\searches\ProductsSearch;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends DashboardController
{
    public $permissions = [
        'cms-products-list'=>'View Products List',
        'cms-products-create'=>'Add Products',
        'cms-products-update'=>'Edit Products',
        'cms-products-delete'=>'Delete Products',
        'cms-products-restore'=>'Restore Products',
        ];
    public function actionIndex()
    {
        Yii::$app->user->can('cms-products-list');
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        Yii::$app->user->can('cms-products-create');
        $model = new Products();
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
        Yii::$app->user->can('cms-products-update');
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
            Yii::$app->user->can('cms-products-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'Products has been restored');
        } else {
            Yii::$app->user->can('cms-products-delete');
            if (!empty($model->imageURL)) {
                $filePath = Yii::getAlias('@webroot') . parse_url($model->imageURL, PHP_URL_PATH);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $model->delete();
            Yii::$app->session->setFlash('success', 'Products has been deleted');
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = Products::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function saveFile($model, $uploadedFile)
    {
        $uploadDirectory = Yii::getAlias('@webroot/uploads/products/');
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        // Define file name using the service ID
        $fileName = 'product_' . $model->id . '.' . $uploadedFile->extension;
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
            $model->imageURL = $baseUrl . '/uploads/products/' . $fileName;

            // Save the model with the new imageURL
            $model->save(false);
        } else {
            Yii::$app->session->setFlash('error', 'Failed to upload the image.');
        }
    }
}
