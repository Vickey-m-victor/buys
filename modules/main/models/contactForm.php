<?php
namespace dashboard\models;

use Yii;
use yii\base\Model;

class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $message;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'message'], 'required'],
            ['email', 'email'],
        ];
    }

    /**
     * Send email to the administrator
     * @return bool whether the email was sent successfully
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom($this->email)
            ->setSubject($this->subject)
            ->setTextBody($this->message)
            ->send();
    }
}

?>