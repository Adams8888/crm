<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use app\models\PaymentMethods;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property string $username
 * @property int $country_id
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $payment_id
 *
 * @property PaymentMethods $payment
 * @property Countries $country
 */
class Clients extends ActiveRecord
{
    const STATUS_BLACKLISTED = -1;
    const STATUS_INACTIVE    = 0;
    const STATUS_ACTIVE      = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'country_id', 'created_at', 'updated_at'], 'required'],
            [['country_id', 'status', 'created_at', 'updated_at', 'payment_id'], 'integer'],
            [['username', 'note'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['payment_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'country_id' => 'Country',
            'note' => 'Note',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'payment_id' => 'Payment method',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(PaymentMethods::className(), ['id' => 'payment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    public static function getStatus($status = null)
    {
        static $enum = [
            self::STATUS_BLACKLISTED => 'Blacklisted',
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_ACTIVE  => 'Active',
        ];
        asort($enum);

        return 	$status!==null ? ArrayHelper::getValue($enum, $status, '') : $enum;

    }

    public static function getCountries()
    {
        $model = Countries::find()->all();
        $array = [];
        if ($model) {
            foreach ($model as $item) {
                $array[$item->id] = $item->name_en;
            }
        }

        return $array;
    }

    public static function getPayments()
    {
        $model = PaymentMethods::find()->where(['user_id' => Yii::$app->user->id])->all();
        $array = [];
        if ($model) {
            foreach ($model as $item) {
                $array[$item->id] = $item->name;
            }
        }

        return $array;
    }
}
