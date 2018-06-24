<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property int $id
 * @property int $number
 * @property string $alpha
 * @property int $calling
 * @property string $name_en
 * @property string $name_es
 * @property string $name_ca
 *
 * @property Clients[] $clients
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'alpha', 'calling', 'name_en', 'name_es', 'name_ca'], 'required'],
            [['number', 'calling'], 'integer'],
            [['alpha'], 'string', 'max' => 2],
            [['name_en', 'name_es', 'name_ca'], 'string', 'max' => 32],
            [['alpha'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'alpha' => 'Alpha',
            'calling' => 'Calling',
            'name_en' => 'Name En',
            'name_es' => 'Name Es',
            'name_ca' => 'Name Ca',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Clients::className(), ['country_id' => 'id']);
    }
}
