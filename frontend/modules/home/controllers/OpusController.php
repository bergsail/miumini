<?php
/**
 * @link http://www.iisns.com/
 * @copyright Copyright (c) 2015 iiSNS
 * @license http://www.iisns.com/license/
 */

namespace app\modules\home\controllers;

use Yii;
use common\components\BaseController;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\home\models\Opus;
use app\modules\home\models\Album;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * @author Shiyang <dr@shiyang.me>
 */
class OpusController extends BaseController
{
    public $layout = '@app/modules/user/views/layouts/user';
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
                        'actions' => ['index', 'create', 'update', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->created_by !== Yii::$app->user->id) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Creates a new Opus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($albumId)
    {
        $modelAlbum = $this->findAlbumModel($albumId);

        $model = new Opus();
        $model->album_id = $modelAlbum->id;
        $model->name = $modelAlbum->name;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 
                    'id' => $model->id]);
            } else {
                var_dump($model->getErrors());
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'album' => $modelAlbum
                ]);
        }
        
    }

     /**
     * Updates an existing Opus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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


    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->Request->isAjax && $model->created_by === Yii::$app->user->id) {
            try {
                unlink(Yii::getAlias('@webroot/uploads/user/') . $model->created_by . '/' . $model->store_name);
            } catch (Exception $e) {
                throw new ServerErrorHttpException('Internal Server Error');
            }
            return $model->delete();
        } else {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
    }

    /**
     * Finds the Opus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Opus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Opus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findAlbumModel($albumId)
    {
        if (($model = Album::findOne($albumId)) !== null) {
            if ($model->created_by !== Yii::$app->user->id) {
                throw new ForbiddenHttpException('You are not allowed to perform this action.');
            }
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
