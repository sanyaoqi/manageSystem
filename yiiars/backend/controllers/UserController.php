<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    // 'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (in_array($this->action->id, array('upload'))) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            $model->setpasswd($model->passwd);
            if ($model->save()) {
                //http://node.ars.com/user/addUserToAttMac
                $url = 'http://node.ars.com/user/addUserToAttMac';
                $params = [
                    'uid' => $model->uid,
                    'username' => $model->real_name,
                    'passwd' => '',
                    'privilege' => $model->role,
                    'enable' => true, 
                ];
                \common\models\Device::callCurl($url, $params, 'POST');
                $url = 'http://node.ars.com/user/setUserPicture';
                $params = [
                    'uid' => $model->uid,
                    'pic' => $model->cover,
                ];
                \common\models\Device::callCurl($url, $params, 'POST');
                return $this->redirect(['view', 'id' => $model->uid]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * 上传封面图
     * @return [type] [description]
     */
    public function actionUpload()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $res['code'] = 200;
        $res['message'] = 'success';
        $url = '';
        if (Yii::$app->request->isPost){
            $tmp_name = $_FILES['file']['tmp_name'];
            if (file_exists($tmp_name)) {
                preg_match('/\.([a-z]*)$/', $_FILES['file']['name'], $ext_name);
                $new_name = md5($tmp_name).(isset($ext_name[0])?$ext_name[0] : '.png');
                $target_file = Yii::$app->params['uploads_dir'].'images/'.$new_name;
                if (move_uploaded_file($tmp_name, $target_file)) {
                    $url = '/uploads/images/'.$new_name;
                    $res['image_url'] = $url;
                } else {
                    $res['code'] = 404;
                    $res['message'] = 'file save error';
                }
            } else {
                $res['code'] = 404;
                $res['message'] = 'file not found';
                
            }
        } else {
            $res['code'] = 404;
            $res['message'] = 'need post';
        }
        return $res;
    }


    public function actionReadCard()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        //test data
        return [
            'code' => 200,
            'message' => 'success',
            'result' => [
                "name" => "张三",
                "sex" => "男",
                "nation" => "中国",
                "birthday" => "19900111",
                "id_num" => "1111111111111111111111111",
                "issue" => "",
                "begin" => "20100101",
                "uid" => "123123123",
            ]
        ];
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('common', 'The requested page does not exist.'));
    }
}
