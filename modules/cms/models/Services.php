<?php

namespace cms\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $imageURL
 * @property int|null $is_published
 * @property int|null $is_deleted
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $file;
    public static function tableName()
    {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['is_published', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['title', 'imageURL'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'png,jpeg,jpg,svg', 'skipOnEmpty' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'imageURL' => 'Image File',
            'is_published' => '',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
