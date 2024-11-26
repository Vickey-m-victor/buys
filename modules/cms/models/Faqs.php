<?php

namespace cms\models;

use Yii;

/**
 * This is the model class for table "faqs".
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property int|null $is_published
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Faqs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faqs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question', 'answer'], 'required'],
            [['answer'], 'string'],
            [['is_published', 'created_at', 'updated_at'], 'integer'],
            [['question'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Question',
            'answer' => 'Answer',
            'is_published' => '',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
