<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_schedule".
 *
 * @property int $id
 * @property int $user_id
 * @property string $date
 * @property string $noon_start_time
 * @property string $noon_end_time
 * @property string $night_start_time
 * @property string $night_end_time
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class WorkSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'date', 'noon_start_time', 'noon_end_time', 'night_start_time', 'night_end_time'], 'required'],
            [['user_id'], 'integer'],
            [['date', 'noon_start_time', 'noon_end_time', 'night_start_time', 'night_end_time', 'created_at', 'updated_at'], 'safe'],
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
            'date' => 'Date',
            'noon_start_time' => 'Noon Start Time',
            'noon_end_time' => 'Noon End Time',
            'night_start_time' => 'Night Start Time',
            'night_end_time' => 'Night End Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
