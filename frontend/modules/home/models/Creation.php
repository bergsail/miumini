<?php
/**
 * @link http://www.iisns.com/
 * @copyright Copyright (c) 2015 iiSNS
 * @license http://www.iisns.com/license/
 */

namespace app\modules\home\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use app\components\Uploader;

/**
 * This is the model class for table "{{%home_creation}}".
 *
 * @property integer $id
 * @property string $type
 * @property integer $wen_id
 * @property integer $qu_id
 * @property integer $pu_id
 * @property string $post_tags
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 * @property string $status
 * @property integer $explore_status
 *
 * @author Yangfan <bergsail@163.com>
 */
class Creation extends \yii\db\ActiveRecord
{
    const STATUS_PUBLIC = 'public';
    const STATUS_PRIVATE = 'private';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%home_creation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['post_title'], 'required'],
            [['createtype', 'status', 'post_path','tune_path', 'opus_path', 
              'post_title', 'post_tags', 'post_content',
              'tune_title', 'tune_tags', 'tune_content',
              'opus_title', 'opus_tags', 'opus_content',
              'opus_work_author', 'opus_work_number', 'opus_work_movement', 'opus_work_key',
              'opus_work_alias', 'opus_work_instruments', 
              'opus_work_birth', 'opus_work_production','opus_work_period','opus_work_style',
              'opus_work_notation'], 'string'],
            [['id','post_id','tune_id','opus_id','created_by','created_at','updated_at','explore_status'],'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'createtype' => Yii::t('app', 'Type'),
            'post_id' => Yii::t('app', 'Post ID'),
            'tune_id' => Yii::t('app', 'Tune ID'),
            'opus_id' => Yii::t('app', 'Opus ID'),
            'post_title' => Yii::t('app', 'Post Title'),
            'tune_title' => Yii::t('app', 'Tune Title'),
            'opus_title' => Yii::t('app', 'Opus Title'),
            'post_path' => Yii::t('app', 'Post Path'),
            'tune_path' => Yii::t('app', 'Tune Path'),
            'opus_path' => Yii::t('app', 'Opus Path'),
            'post_tags' => Yii::t('app', 'Tags'),
            'tune_tags' => Yii::t('app', 'Tags'),
            'opus_tags' => Yii::t('app', 'Tags'),
            'post_content'=>Yii::t('app', 'Post Content'),
            'tune_content'=> Yii::t('app', 'Tune Content'),
            'opus_content' => Yii::t('app', 'Opus Content'),
            'opus_work_author'=> Yii::t('app', 'Work Author'), 
            'opus_work_number'=> Yii::t('app', 'Work Number'),
            'opus_work_movement'=> Yii::t('app', 'Work Movement'),
            'opus_work_key'=> Yii::t('app', 'Work Key'),
            'opus_work_alias'=> Yii::t('app', 'Work Alias'), 
            'opus_work_instruments'=> Yii::t('app', 'Work Instrument'), 
            'opus_work_birth'=> Yii::t('app', 'Work Birth'), 
            'opus_work_production'=> Yii::t('app', 'Work Production'),
            'opus_work_period'=> Yii::t('app', 'Work Period'),
            'opus_work_style'=> Yii::t('app', 'Work Style'),
            'opus_work_notation'=> Yii::t('app', 'Work Notation'),
            'created_at' => Yii::t('app', 'Create Time'),
            'updated_at' => Yii::t('app', 'Update Time'),
            'created_by' => Yii::t('app', 'User ID'),
            'status' => Yii::t('app', 'Status'),
            'explore_status'=>Yii::t('app', 'Explore Status')
        ];
    }

    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    public function beforeSave($insert)
    {

        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->created_by = Yii::$app->user->id;
                $this->created_at = time();
                Yii::$app->userData->updateKey('creation_count', Yii::$app->user->id);

                $this->opus_work_author = '例:肖邦';
                $this->opus_work_number = '例:Op.34';
                $this->opus_work_movement = '例:Mov.1';
                $this->opus_work_key = '例:C大调';
                $this->opus_work_alias = '例:叽叽喳喳';
                $this->opus_work_instruments = '例:钢琴';
                $this->opus_work_birth = '例:1836';
                $this->opus_work_production = '例:1837';
                $this->opus_work_period = '例:浪漫';
                $this->opus_work_style = '例:浪漫';
                $this->opus_work_notation = '例:第三小节有错误';
            }
            //标签分割
            // $tags = trim($this->tags);
            // $explodeTags = array_unique(explode(',', str_replace('，', ',', $tags)));
            // $explodeTags = array_slice($explodeTags, 0, 10);
            // $this->tags = implode(',', $explodeTags);
            return true;
        } else {
            return false;
        }
    }


    /** 
     * 处理音乐数据上传
     */
    public function uploadScore($type)
    {

        $savePath =  Yii::getAlias('@webroot/uploads/userTune/');
        if ($type == "opus") {
            $savePath =  Yii::getAlias('@webroot/uploads/userOpus/');
        }

        $config = [
            'savePath' => $savePath, //存储文件夹
            'maxSize' => 20480,
            'allowFiles' => ['.mp3', '.wav', '.ogg', '.aif', '.xml', '.svg', '.pdf', '.musx'],
        ];
       $up = $type == "opus" ?
             new Uploader("score-opus", $config, 'creation'.$this->id):
             new Uploader("score-tune", $config, 'creation'.$this->id);

        $info = $up->getFileInfo();

        $fileOriginalName = explode(".",$info['originalName'])[0];
        $fileSystemName = explode(".",$info['name'])[0];
        $tail = explode(".",$info['name'])[1];

        if ($type == "tune") {
            $this->tune_content = Yii::getAlias('@web/uploads/userTune'). $this->created_by . '/' 
                                  . $fileSystemName . '-_-' . $fileOriginalName . '.' . $tail;
        }
        else if ($type == "opus") {
            $this->opus_content = Yii::getAlias('@web/uploads/userOpus'). $this->created_by . '/' 
                                  . $fileSystemName . '-_-' . $fileOriginalName . '.' . $tail;
        }
        $this->save();
        if ($type == "tune") {
            return $this->tune_content;
        }
        else {
            return $this->opus_content;
        }
    }
    /**
     * 处理图片的上传
     */
    public function upload($type)
    {
        $config = [
            'savePath' => Yii::getAlias('@webroot/uploads/user/'), //存储文件夹
            'maxSize' => 2048 ,//允许的文件最大尺寸，单位KB
            'allowFiles' => ['.gif' , '.png' , '.jpg' , '.jpeg' , '.bmp' , '.svg'],  //允许的文件格式
        ];
        $up = new Uploader("file", $config, 'creation'.$this->id);
        $info = $up->getFileInfo();

        // echo "<pre>";var_dump($info);echo"</pre>";
        //存入数据库

        $filename = explode(".",$info['originalName'])[0];
       

        if ($type=="WEN") {
            $this->post_path = Yii::getAlias('@web/uploads/user/') . $this->created_by . '/'. $info['name']; //存储路径
        }
        if ($type=="QU") {
            $this->tune_path = Yii::getAlias('@web/uploads/user/') . $this->created_by . '/'. $info['name']; //存储路径
        }
        if ($type=="PU") {
            $this->opus_path = Yii::getAlias('@web/uploads/user/') . $this->created_by . '/'. $info['name']; //存储路径
        }
        $this->save();
        if ($type=="WEN") {
            return $this->post_path;
        }
        if ($type=="QU") {
            return $this->tune_path;
        }
        if ($type=="PU") {
            return $this->opus_path;
        }    
    }

    /**
     *string the URL that shows the detail of the post
     */
    public function getUrl()
    {       
        return Url::toRoute(['/home/creation/view', 'id' => $this->id]);
    }

    // public function getUser()
    // {
    //     return Yii::$app->db->createCommand("SELECT id, avatar, email, username FROM {{%user}} WHERE id={$this->user_id}")->queryOne();
    // }

    // public function getUserProfile()
    // {
    //     return Yii::$app->db->createCommand("SELECT * FROM {{%user_profile}} WHERE user_id={$this->user_id}")->queryOne();
    // }

    // public function getUserData()
    // {
    //     return Yii::$app->db->createCommand("SELECT * FROM {{%user_data}} WHERE user_id={$this->user_id}")->queryOne();
    // }
}
