<?php

namespace cms\models;

use Yii;

/**
 * This is the model class for table "banners".
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
class Banners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $file;
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['is_published', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['title', 'description', 'imageURL'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'png,jpeg,jpg,svg', 'maxSize' => 1024 * 1024, 'skipOnEmpty' => false],
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
            'imageURL' => 'banner image',
            'is_published' => 'Is Published',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
