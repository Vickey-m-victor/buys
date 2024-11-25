<?php

namespace cms\models;

use Yii;

/**
 * This is the model class for table "basic_info".
 *
 * @property int $id
 * @property string $name
 * @property string|null $logoUrl
 * @property string $url
 * @property string|null $mission
 * @property string|null $vision
 */
class BasicInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'basic_info';
    }

    /**
     * {@inheritdoc}
     */
    public $file;
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['name', 'logoUrl', 'url', 'mission', 'vision'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'logoUrl' => 'Logo',
            'is_published'=>'',
            'url' => 'website Url',
            'mission' => 'Mission',
            'vision' => 'Vision',
        ];
    }
}
