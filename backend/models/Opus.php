<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%home_post}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class Opus extends \yii\db\ActiveRecord
{
    const EXPLORE_STATUS_PENDING = 0;
    const EXPLORE_STATUS_APPROVED = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%home_opus}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['album_id', 'title'], 'required'],
            [['album_id', 'created_at', 'created_by', 'is_cover', 'work_birth', 'work_production'], 'integer'],
            [['title', 'work_key', 'work_tperiod', 'work_style', 'work_instrument'], 'string', 'max' => 100],
            [['thumb', 'content', 'store_name', 'title_alias', 'description', 'player', 'author', 'work_identity', 'work_movement'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
         return [
            'id' => Yii::t('app', 'ID'),
            'album_id' => Yii::t('app', 'Album ID'),
            'title' => Yii::t('app', 'Title'),
            'thumb' => Yii::t('app', 'Thumb'),
            'content' => Yii::t('app', 'Path'),
            'store_name' => Yii::t('app', 'Store Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'is_cover' => Yii::t('app', 'Is Cover'),
            'title_alias' => Yii::t('app', 'Work Title Alias'),
            'description' => Yii::t('app', 'Description'),
            'player' => Yii::t('app', 'Player'),
            'author' => Yii::t('app', 'Author'),
            'work_identity' => Yii::t('app', 'Work Identity'),
            'work_key' => Yii::t('app', 'Work Key'),
            'work_movement' => Yii::t('app', 'Work Movement'),
            'work_birth' => Yii::t('app', 'Work Birth'),
            'work_production' => Yii::t('app', 'Work Production'),
            'work_tperiod' => Yii::t('app', 'Work Period'),
            'work_style' => Yii::t('app', 'Work Style'),
            'work_instrument' => Yii::t('app', 'Work Instrument')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getStatus()
    {
        return ($this->explore_status === 0) ? 'PENDING' : 'APPROVED' ;
    }
}
