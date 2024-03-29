<?php
/**
 * @link http://www.iisns.com/
 * @copyright Copyright (c) 2015 iiSNS
 * @license http://www.iisns.com/license/
 */

namespace app\modules\home\models;

use Yii;
use yii\db\Query;
use app\components\Uploader;

/**
 * This is the model class for table "{{%home_album}}".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $cover_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $enable_comment
 * @property integer $status
 * @property string $status_password
 * @property string $status_question
 * @property string $status_answer
 *
 * @author Shiyang <dr@shiyang.me>
 */
class Album extends \yii\db\ActiveRecord
{
    const TYPE_PUBLIC = 0;
    const TYPE_PASSWORD = 1;
    const TYPE_QUESTION = 2;
    const TYPE_PRIVATE = 3;

    const COVER_NONE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%home_album}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['cover_id', 'created_at', 'updated_at', 'created_by', 'enable_comment', 'status'], 'integer'],
            [['status_password', 'status_question', 'status_answer'], 'string'],
            [['name', 'description'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'cover_id' => Yii::t('app', 'Cover ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'enable_comment' => Yii::t('app', 'Enable Comment'),
            'status' => Yii::t('app', 'Privilege Setting'),
            'status_password' => Yii::t('app', 'Password'),
            'status_question' => Yii::t('app', 'Question'),
            'status_answer' => Yii::t('app', 'Answer'),
        ];
    }

    public function getOpusCount()
    {
        return Yii::$app->db
            ->createCommand("SELECT count(*) FROM {{%home_opus}}  WHERE album_id={$this->id}")
            ->queryScalar();
    }

    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->created_by = Yii::$app->user->identity->id;
                $this->created_at = time();
                $this->updated_at = time();
                $this->cover_id = self::COVER_NONE;
            }
            if (!empty($this->status_password)) {
                $this->status_password = Yii::$app->security->generatePasswordHash($this->status_password);
            }
            if (!empty($this->status_answer)) {
                $this->status_answer = Yii::$app->security->generatePasswordHash($this->status_answer);
            }
            return true;
        } else {
            return false;
        }
    }

    public function getOpuses()
    {
        $query = new Query;
        $query->select('id, name, path')
            ->from('{{%home_opus}}')
            ->where('album_id=:id', [':id' => $this->id]);
        $opus = Yii::$app->tools->Pagination($query);
        return [
            'opuses' => $opus['result'],
            'pages' => $opus['pages']
        ];
    }

    public function getUser()
    {
        return Yii::$app->db
            ->createCommand("SELECT username, avatar FROM {{%user}} WHERE id={$this->created_by}")
            ->queryOne();
    }

    /**
     * 取得封面图片的地址
     * 本来只要一个相册id也是可以的，但为减少查询，故同时要 $id, $cover_id
     * @param integer $id 相册id
     * @param integer $cover_id 封面id
     */
    public static function getCoverOpus($id = null, $cover_id = null)
    {
        if ($id == null) {
            if ($this->cover_id == self::COVER_NONE) {
                if ($this->opusCount == 0) {
                    return '/images/pic-none.png';
                } else {
                    $path = $this->opuses[0]['path'];
                }
            } else {
                $path = Yii::$app->db
                ->createCommand('SELECT path FROM {{%home_opus}} WHERE id='.$this->cover_id)
                ->queryScalar();
            }
        } else {
            if ($cover_id == self::COVER_NONE) {
                $path = Yii::$app->db
                    ->createCommand('SELECT path FROM {{%home_opus}} WHERE album_id='.$id)
                    ->queryScalar();
                if (empty($path)) {
                    return Yii::getAlias('@web') . '/images/pic-none.png';
                }
            } else {
                $path = Yii::$app->db
                    ->createCommand('SELECT path FROM {{%home_opus}} WHERE id='.$cover_id)
                    ->queryScalar();
            }
        }
        return $path;
    }

    /**
     * 处理图片的上传
     */
    public function upload()
    {
        $config = [
            'savePath' => Yii::getAlias('@webroot/uploads/user/'), //存储文件夹
            'maxSize' => 2048 ,//允许的文件最大尺寸，单位KB
            'allowFiles' => ['.gif' , '.png' , '.jpg' , '.jpeg' , '.bmp' , '.svg'],  //允许的文件格式
        ];
        $up = new Uploader("file", $config, 'album'.$this->id);
        $info = $up->getFileInfo();

        // echo "<pre>";var_dump($info);echo"</pre>";
        //存入数据库
        Yii::$app->db->createCommand()->insert('{{%home_opus}}', [
            'name' => $info['originalName'],
            'path' => Yii::getAlias('@web/uploads/user/') . $this->created_by . '/' . $info['name'], //存储路径
            'store_name' => $info['name'], //保存的名称
            'album_id' => $this->id,
            'created_at' => time(),
            'created_by' => Yii::$app->user->id, 
        ])->execute();
    }
}
