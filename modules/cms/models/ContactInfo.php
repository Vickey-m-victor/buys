<?php

namespace cms\models;

use Yii;

/**
 * This is the model class for table "contact_info".
 *
 * @property int $id
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property int|null $is_published
 * @property int|null $is_deleted
 * @property int|null $created_at
 * @property int|null $updated_at
 */
// $model = new ContactInfo();
// $model->id = 1;
// $model->address = '123 Main Street, Cityville';
// $model->phone = '123-456-7890';
// $model->email = 'info@example.com';
// $model->is_published = 1; // Published
// $model->is_deleted = 0;   // Not deleted
// $model->created_at = time();
// $model->updated_at = time();

// if ($model->save()) {
//     echo "Contact information saved successfully!";
// } else {
//     echo "Error saving contact information.";
// }
class ContactInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'phone', 'email'], 'required'],
            [['is_published', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['address', 'phone', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'is_published' => '',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
