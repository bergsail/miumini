<?php
/**
 * @link http://www.iisns.com/
 * @copyright Copyright (c) 2015 iiSNS
 * @license http://www.iisns.com/license/
 */

namespace app\modules\home\controllers;

use Yii;

use yii\data\SqlDataProvider;
use yii\db\Query;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;

use app\modules\home\models\Post;
use app\modules\home\models\Feed;
use app\modules\home\models\Opus;
use app\modules\home\models\Creation;

use common\components\BaseController;


/**
 * PostController implements the CRUD actions for Post model.
 *
 * @author Yangfan <bergsai@163.com>
 */
class CreationController extends BaseController
{
    // public $layout = '@app/modules/user/views/layouts/creationedit';
    public $layout = 'creationedit';
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'preview', 'view', 'opusview', 'upload', 'upcover', 'upscore', 'index', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }


    /**
     * in upload we deal umeditor 
    */
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'shiyang\umeditor\UMeditorAction',
            ]
        ];
    }

    /**
     * Lists all Creation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT id, post_id, tune_id, opus_id, status, type FROM {{%home_creation}} WHERE created_by = :user_id',
            'params' => [':user_id' => Yii::$app->user->id],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionOpusview($id) {
        $this->layout = 'creationopusview';
        $model = $this->findModel($id);
        return $this->render('opusview', [
            'model' => $model,
        ]);
    }
    /**
     * Displays a single Creation model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    // {   '@app/modules/user/views/layouts/creationedit';
        $this->layout = 'creationview';
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }


    /**
     *上传音乐资源文件
     */
    public function actionUpscore() 
    {
        if(Yii::$app->request->isPost) {
            $type = $_POST['createscoretype'];
            $id = $_POST['createid'];

            $model = $this->findModel($id);
            return $model->uploadScore($type);
        }
        else {
            var_dump('createupScore none');
        }
    }

    /**
     * 上传封面图片
     * @param integer $id 相册ID
     */
    public function actionUpcover()
    { 
        if (Yii::$app->request->isPost) {
           $type = $_POST['createtype'];
           $id = $_POST['createid'];
           
            $model = $this->findModel($id);
            return $model->upload($type);
        }
        else {
            var_dump('creation/upload wrong page');
        }  
    }

    public function actionPreview() {
        if(!Yii::$app->request->isPost) {
            return;
        }
        $type = $_POST['createtype'];
        $id =$_POST['createid'];
        if($type!="WEN_QU_PU") {
            return;
        } 
        $model = $this->findModel($id);
        $model->load(['formName'=>$_POST],'formName');
        if(!$model->save()) {
            return var_dump($model->errors);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    /**
     * Creates a new Creation model.
     * $createtype: 0=>form 1 post_path(pic)
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = null;
        if (Yii::$app->request->isPost)
        {   
            $type = $_POST['createtype'];
            $id =$_POST['createid'];
            if($type!="WEN_QU_PU") {
                return;
            } 
            $model = $this->findModel($id);
            $model->load(['formName'=>$_POST],'formName');
            if(!$model->save()) {
                return var_dump($model->errors);
            }
            else {
                if ($model->status == Creation::STATUS_PUBLIC) {
                    //插入记录(Feed)
                    $title = Html::a(Html::encode($model->post_title), $model->url);
                    preg_match_all("/<[img|IMG].*?src=\"([^^]*?)\".*?>/", $model->post_content, $images);
                    $images = "<img src='" . $model->post_path . "'>";
                    $content = mb_substr(strip_tags($model->post_content), 0, 140, 'utf-8') . '... ' . Html::a(Yii::t('app', 'View Details'), $model->url) . '<br>' . $images;
                    $creationData = ['{title}' => $title, '{content}' => $content];
                    Feed::addFeed('blogtuneopus', $creationData);
                }
                $this->layout = '@app/modules/user/views/layouts/user';
                return $this->redirect(['/user/dashboard']);
            } 
        }
        else {
            $model = $this->findUserLastModel();
        }
        if (is_null($model)) {
            $model = new Creation();
            if(!$model->save()) {
                var_dump($model->errors);
            }
        } 
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Creation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Creation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Album model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Album the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Creation::findOne($id)) !== null) {
            if ($model->created_by !== Yii::$app->user->id) {
                throw new ForbiddenHttpException('You are not allowed to perform this action.');
            }
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findUserLastModel() 
    {
        $query = new Query;
        $data = $query->select('id, created_at')
            ->from('{{%home_creation}}')
            ->where('created_by=:created_by', [':created_by' => Yii::$app->user->id])
            ->orderBy('created_at DESC')
            ->one();
        if (!$data) {
            return false;
        }
        else {
            $id = $data["id"];
            // var_dump($id);
            if (($model = Creation::findOne($id)) !== null) {
                if ($model->created_by !== Yii::$app->user->id) {
                    throw new ForbiddenHttpException('You are not allowed to perform this action.');
                }
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

    }

}
