<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delivery".
 *
 * @property int $id
 * @property int $user_id
 * @property int $type
 * @property float $value
 * @property string $payment_method
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Delivery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'delivery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'value', 'payment_method'], 'required'],
            [['user_id', 'type'], 'integer'],
            [['value'], 'number'],
            [['payment_method'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'type' => 'Type',
            'value' => 'Value',
            'payment_method' => 'Payment Method',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
