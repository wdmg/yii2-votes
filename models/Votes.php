<?php

namespace wdmg\votes\models;

use Yii;

/**
 * This is the model class for table "{{%votes}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $user_ip
 * @property string $entity_id
 * @property int $target_id
 * @property int $vote_value
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Users $user
 */

class Votes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%votes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $rules = [
            [['user_id', 'target_id', 'vote_value'], 'integer'],
            [['user_ip', 'entity_id', 'target_id'], 'required'],
            [['user_ip'], 'string', 'max' => 39],
            [['entity_id'], 'string', 'max' => 32],
            [['created_at', 'updated_at'], 'safe'],
        ];

        if(class_exists('\wdmg\users\models\Users') && isset(Yii::$app->modules['users'])) {
            $rules[] = [['user_id'], 'required'];
            $rules[] = [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \wdmg\users\models\Users::class, 'targetAttribute' => ['user_id' => 'id']];
        }
        return $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/modules/votes', 'ID'),
            'user_id' => Yii::t('app/modules/votes', 'User ID'),
            'user_ip' => Yii::t('app/modules/votes', 'User IP'),
            'entity_id' => Yii::t('app/modules/votes', 'Entity'),
            'target_id' => Yii::t('app/modules/votes', 'Target'),
            'vote_value' => Yii::t('app/modules/votes', 'Vote value'),
            'created_at' => Yii::t('app/modules/votes', 'Created At'),
            'updated_at' => Yii::t('app/modules/votes', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        if(class_exists('\wdmg\users\models\Users') && isset(Yii::$app->modules['users']))
            return $this->hasOne(\wdmg\users\models\Users::class, ['id' => 'user_id']);
        else
            return null;
    }
}
