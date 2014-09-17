<?php

class TableController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/main1';
    protected $result = array('status' => 0,'msg' => '');

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',// perform access control for CRUD operations
//                  'postOnly + delete' , // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',// allow all users to perform 'index' and 'view' actions
                'actions' => array(''),
                'users' => array('*'),
            ),
            array('allow',// allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index','view','create','update','excel'),
                'users' => array('@'),
            ),
            array('allow',// allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin','delete'),
                'users' => array('admin'),
            ),
            array('deny',// deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Table;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        $this->_operate($model);

        $this->render('create',array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $result = array('status' => 0,'msg' => '');
        $this->_operate($model,'update');
        $this->render('update',array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index') );
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $unit_model = Unit::model();
        $dataProvider = array();
        foreach($unit_model->findAll() as $value)
        {
            $dataProvider[$value->id] = new CActiveDataProvider('Accounts',array(
                'criteria' => array('condition' => "sid=$value->id"),
                'pagination' => array('pageSize' => 100,)
                ));
        }

        if(isset($_POST['yt0']))
        {
            if(isset($_POST['group']))
            {
                $_SESSION['data'] = $_POST['group'];
            }
            $_SESSION['title'] = $_POST['team_title'];

            $table_model = Accounts::model();

            $table_model->create_table();

//            foreach ( $_REQUEST['group'] as $key => $g )
//            {
//                $criteria = new CDbCriteria;
//                $criteria->addInCondition( 'id' , $g );
//                $data[$key] = new CActiveDataProvider( 'Accounts' , array(
//                          'criteria' => $criteria ,
//                          'pagination' => false ,
//                        ) );
//            }
//            $this->layout = '//layouts/';
//            $this->render( 'create_table' , array(
//                      'title' => $_REQUEST['team_title'] ,
//                      'data' => $data ,
//                      'model' => $table_model ,
//            ) );
            Yii::app()->end();
        }

        $this->render('index',array(
            'dataProvider' => $dataProvider,
            'unit' => $unit_model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Table the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Accounts::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Table $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax'] === 'table-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    // ajax退出
    public function ajax_exit()
    {
        echo json_encode($this->result);
        Yii::app()->end();
    }

    public function actionExcel()
    {
        $excel = new PHPExcel();
        try
        {
            //设置文档基本信息
            $excel->getProperties()->setCreator('Ren Long')
                    ->setLastModifiedBy('Ren Long')
                    ->setTitle('title')
                    ->setSubject('subject')
                    ->setDescription('description')
                    ->setKeywords('keywords')
                    ->setCategory('category');

            //设置单元格宽度
            $excel->getActiveSheet()
                    ->getColumnDimension('C')->setAutoSize(TRUE);
            $excel->getActiveSheet()
                    ->getColumnDimension('D')->setAutoSize(TRUE);

            if(isset($_SESSION['title']))
            {
                $excel->getActiveSheet()
                        ->mergeCells('A1:E1')
                        ->setCellValue('A1',$_SESSION['title']);

                //设置字体位置
                $get_style_a1 = $excel->getActiveSheet()->getStyle('A1');
                $get_style_a1->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $get_style_a1->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

                $get_style_a1->getFont()->setSize(20);

                //设置字体加粗
                $get_style_a1->getFont()->setBold(TRUE);

//                $get_style_a1->getBorders()->getTop()->setBorderStyle( PHPExcel_Style_Border::BORDER_THICK );
//                $get_style_a1->getBorders()->getRight()->setBorderStyle( PHPExcel_Style_Border::BORDER_THICK );
//                $get_style_a1->getBorders()->getLeft()->setBorderStyle( PHPExcel_Style_Border::BORDER_THICK );
//                $get_style_a1->getBorders()->getBottom()->setBorderStyle( PHPExcel_Style_Border::BORDER_THICK );
//                $get_style_a1->getBorders()->getAllBorders()->setBorderStyle( PHPExcel_Style_Border::BORDER_THIN );
            }

            //设置表单边框样式
//            $obj_style = $excel->getActiveSheet()->getStyle( 'A4' );
//            $obj_style->getBorders()
////                    ->getRight()
//                    ->getAllBorders()
//                    ->setBorderStyle( PHPExcel_Style_Border::BORDER_THIN );
            $temp_num = 0;
            $row = 3;
            if(isset($_SESSION['data']))
            {
                foreach($_SESSION['data'] as $key => $value)
                {
                    $excel->getActiveSheet()
                            ->mergeCells('A' . ($row + $temp_num) . ':E' . ($row + $temp_num));
                    $excel->getActiveSheet()
                            ->setCellValue('A' . ($row + $temp_num),'第' . $key . '组')
                            ->setCellValue('A' . ($row + 1 + $temp_num),'姓名')
                            ->setCellValue('B' . ($row + 1 + $temp_num),'性别')
                            ->setCellValue('C' . ($row + 1 + $temp_num),'电话')
                            ->setCellValue('D' . ($row + 1 + $temp_num),'身份证号')
                            ->setCellValue('E' . ($row + 1 + $temp_num),'备注');

                    $temp_num2 = $row + 2 + $temp_num;

                    $criteria = new CDbCriteria;
                    $criteria->compare('id',$value);
                    $data = Accounts::model()->findAll($criteria);

                    foreach($data as $info)
                    {
                        $excel->getActiveSheet()
                                ->setCellValue('A' . $temp_num2,$info->name)
                                ->setCellValue('B' . $temp_num2,$info->sex)
                                ->setCellValueExplicit('C' . $temp_num2,$info->phone,PHPExcel_Cell_DataType::TYPE_STRING)
                                ->setCellValueExplicit('D' . $temp_num2,$info->personal_ID,PHPExcel_Cell_DataType::TYPE_STRING);
                        $temp_num2++;
                    };
                    //以下加载样式超级消耗内存，不成功
//                $range = 'A' . ($row + $temp_num) . ':E' . $temp_num2;
//                $excel->getActiveSheet()
//                        ->duplicateStyle( $obj_style , $range );

                    $temp_num = $temp_num2 - 1;
                }
            }

            $file_name = $_SESSION['title'] ? $_SESSION['title'] : '新建表单';
            // Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;filename=$file_name.xls");
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($excel,'Excel5');
            $objWriter->save('php://output');
            Yii::app()->end();
        }
        catch(Exception $e)
        {
            $result_data = $e->getMessage();
            print_r($result_data);
        }
    }

}
