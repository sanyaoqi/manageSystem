<?php

namespace backend\controllers;

use Yii;
use common\models\Guests;
use common\models\Attendance;
use common\models\AttendanceSearch;
use common\models\GoAway;
use common\models\GoAwaySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
/**
 * AttendanceController implements the CRUD actions for Attendance model.
 */
class AttendanceController extends Controller
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
        if (in_array($this->action->id, array('notice', 'excel'))) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    /**
     * Lists all Attendance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AttendanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Attendance model.
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
     * Creates a new Attendance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Attendance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->aid]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Attendance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->aid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Attendance model.
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

    public function actionNotice($time = 0, $aid = 0, $gid = 0)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        //test
        // $time = 0;
        $query = Attendance::find();
        $res = [];
        $query->where(['>=', 'created_at', (int)$time]);
        $query->andWhere(['>=', 'aid', (int)$aid]);
        $query->orderBy(['aid' => SORT_DESC]);
        $res['data'] = $query->limit(10)->all();
        
        foreach ($res['data'] as $key => &$value) {
            if ($key == 0) {
                $aid = $value->aid;
            }
            $user['real_name'] = isset($value->user->real_name)?$value->user->real_name : '匿名';
            $user['cover'] = isset($value->user->cover) ? $value->user->cover : '' ; 
            $value = $value->toArray();
            $value['show_datetime'] = date('Y-m-d h:m:s', $value['created_at']);
            $value['user'] = $user;
            
        }

        $query = Guests::find();
        $query->where(['>=', 'created_at', (int)$time]);
        $query->andWhere(['>=', 'gid', (int)$gid]);
        $query->orderBy(['gid' => SORT_DESC]);
        $res['guests'] =  $query->limit(10)->all();

        foreach ($res['guests'] as $key => &$value) {
            if ($key == 0) {
                $gid = $value->gid;
            }
            $value = $value->toArray();
            $value['show_datetime'] = date('Y-m-d h:m:s', $value['created_at']);
            $value['user']['real_name'] = '访客';
            
        }

        $res['code'] = 200;
        $res['message'] = 'success';
        $res['aid'] = $aid;
        $res['gid'] = $gid;
        return $res;
    }

    public function actionExcel($start_date=null, $end_date=null)
    {
        // var_dump($start_date,$end_date);exit;

        $params = Yii::$app->request->queryParams;
        if ($start_date){
            $start_date = strtotime($start_date);
        }
        if ($end_date){
            $end_date = strtotime($end_date);
        }

        if (empty($start_date) || empty($end_date)) {
            $start_date = strtotime(date('day -1', time()));
            $end_date = $start_date + 3600*24;
        }
        // $start_date = 0;

        $query = Attendance::find();
        $query->andWhere(['>=', 'created_at', $start_date]);
        $query->andWhere(['<=', 'created_at', $end_date]);
        $query->with(['user']);
        $data = $query->all();
        // var_dump($data);exit;
        $types = (new Attendance)->getTypes();
        if ($data) {
            //下载Excel
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
            header("Content-Type:application/force-download");
            // header("Content-Type:application/vnd.ms-execl");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');  
            header("Content-Type:application/octet-stream");
            header("Content-Type:application/download");
            header('Content-Disposition:attachment;filename="考勤记录"'.date('Y-m-d', time()).'.xlsx');
            header("Content-Transfer-Encoding:binary");

            $excel = new \PHPExcel();
            $excel->getProperties()->setCreated("invoker");
            $excel->getProperties()->setTitle('考勤记录'.date('Y-m-d H:i:s', time()));
            $excel->getActiveSheet()->setCellValue('A1', '姓名');
            $excel->getActiveSheet()->setCellValue('B1', '时间');
            $excel->getActiveSheet()->setCellValue('C1', '打卡方式');
            $i = 1;
            foreach($data as $item){
                ++$i;
                /**
                 * @var $item ShareOrderList
                 */
                //添加一个空格避免使用科学计数法
                $excel->getActiveSheet()->setCellValue('A' . $i, isset($item->user->real_name)?$item->user->real_name:'匿名');
                $excel->getActiveSheet()->setCellValue('B' . $i, date('Y-m-d h:m:s', $item->created_at));
                $excel->getActiveSheet()->setCellValue('C' . $i, isset($types[$item->type])?$types[$item->type]:'未知方式');
            }
            $write = new \PHPExcel_Writer_Excel2007($excel);
            return $write->save('php://output');
        } else{
            return $this->redirect('/attendance/index');
        }
    }

    public function actionSync()
    {
        $url = 'http://node.ars.com//attendance/readAttMacList';
        \common\models\Device::callCurl($url, [], 'POST');
        return $this->redirect(['index']);
    }
    /**
     * Finds the Attendance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Attendance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Attendance::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('common', 'The requested page does not exist.'));
    }
}
