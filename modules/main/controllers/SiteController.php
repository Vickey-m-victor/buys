<?php

namespace main\controllers;

use Yii;
use yii\web\Response;
use mail\models\static\contactForm;

class SiteController extends \helpers\WebController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(),  [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'only' => ['index'],
                'formats' => [
                    'application/json' => Response::FORMAT_HTML,
                ],
            ],
        ]);
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'errors'
            ],
        ];
    }
    public function actionIndex()
    {
        //Yii::$app->session->setFlash('success', 'Link created successfully');
        return $this->render('index');
    } 
    public function actionServices()
    {
        return $this->render('services');
    }
    public function actionAbouts(){
        return $this->render('abouts');
    }
    public function actionFaq(){
        return $this->render('faq');
    }
    public function actionContact()
{
    $model = new ContactForm();  // Create the ContactForm model instance

    // Handle the form submission
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        // If form is valid, send the email
        if ($model->contact(Yii::$app->params['adminEmail'])) {
            // Set a success flash message if the email was sent
            Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
        } else {
            // Set an error flash message if email was not sent
            Yii::$app->session->setFlash('error', 'There was an error while sending your message. Please try again later.');
        }

        // Refresh the page to show the flash message
        return $this->refresh();
    }

    // If the form was not submitted or is invalid, render the contact page with the model
    return $this->render('contact', [
        'model' => $model,
    ]);
}


    public function actionDocs($mod = 'dashboard')
    {
        //$this->viewPath = '@swagger';
        return $this->render('docs', [
            'mod' => $mod
        ]);
    }
    public function actionAbout()
    {
        return [
            'data' => [
                'id' => $_SERVER['APP_CODE'],
                'name' => $_SERVER['APP_NAME'],
                'enviroment' => $_SERVER['ENVIRONMENT'],
                'version' => $_SERVER['APP_VERSION'],
            ]
        ];
    }

    public function actionJsonDocs($mod = 'dashboard')
    {
        $roothPath = Yii::getAlias('@webroot/');
        $openapi = \OpenApi\Generator::scan(
            [
                $roothPath . 'modules/' . $mod,
                $roothPath . 'providers/swagger/config',
            ]
        );
        Yii::$app->response->headers->set('Access-Control-Allow-Origin', ['*']);
        Yii::$app->response->headers->set('Content-Type', 'application/json');
        $file =  $roothPath . 'modules/dashboard/docs/' . $mod . '-openapi-json-resource.json';
        if (file_exists($file)) {
            unlink($file);
            file_put_contents($file, $openapi->toJson());
        } else {
            file_put_contents($file, $openapi->toJson());
        }
        Yii::$app->response->sendFile($file, false, ['mimeType' => 'json', 'inline' => true]);
        return true;
    }
}
