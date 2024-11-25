<?php

namespace cms\models;

use Yii;

/**
 * This is the model class for table "socials".
 *
 * @property int $id
 * @property string $platform
 * @property string|null $icon
 * @property string $link
 * @property int|null $is_published
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Socials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'socials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['platform', 'link'], 'required'],
            [['is_published', 'created_at', 'updated_at'], 'integer'],
            [['platform', 'icon', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'platform' => 'Platform',
            'icon' => 'Icon',
            'link' => 'Link',
            'is_published' => ' ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
