<?php

namespace cms\models;

use Yii;

/**
 * This is the model class for table "partners".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $imageURL
 * @property int|null $is_published
 * @property int|null $is_deleted
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Partners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partners';
    }

    /**
     * {@inheritdoc}
     */

     public $file;
    public function rules()
    {
        return [
            [['is_published', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['title', 'imageURL'], 'string', 'max' => 255],
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
            'file' => 'partner Image',
            'imageURL' => 'partner Image',
            'is_published' => '',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
