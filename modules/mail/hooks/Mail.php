<?php
namespace mail\hooks;

use Yii;

trait Mail{
    public function send($email)
{
    if ($this->validate()) {
        $body = "<p><strong>Sender Name:</strong> {$this->name}</p>";
        $body .= "<p><strong>Sender Email:</strong> {$this->email}</p>";
        $body .= "<p><strong>Message:</strong></p>";
        $body .= "<p>{$this->body}</p>";
        
        Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setHtmlBody($body) // Use HTML body
            ->send();
        
        
        return true;
    }
    return false;
}

}