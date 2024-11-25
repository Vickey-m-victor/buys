<?php

namespace cms\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $technology
 * @property string|null $imageURL
 * @property int|null $is_published
 * @property int|null $is_deleted
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public $file;
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['is_published', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['title', 'technology', 'imageURL'], 'string', 'max' => 255],
            [['file'],'file', 'extensions' => 'png,jpeg,jpg,svg', 'skipOnEmpty' => true]
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
            'technology' => 'Technology',
            'imageURL' => 'Product Image',
            'is_published' => '',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
