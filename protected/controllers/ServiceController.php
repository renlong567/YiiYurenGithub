<?php

class ServiceController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/main1';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
                  'accessControl' , // perform access control for CRUD operations
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
//                  array( 'allow' , // allow all users to perform 'index' and 'view' actions
//                            'actions' => array( '' ) ,
//                            'users' => array( '*' ) ,
//                  ) ,
                  array( 'allow' , // allow authenticated user to perform 'create' and 'update' actions
                            'actions' => array( 'index' , 'view' , 'create' , 'update' ) ,
                            'users' => array( '@' ) ,
                  ) ,
                  array( 'allow' , // allow admin user to perform 'admin' and 'delete' actions
                            'actions' => array( 'admin' , 'delete' ) ,
                            'users' => array( 'admin' ) ,
                  ) ,
                  array( 'deny' , // deny all users
                            'users' => array( '*' ) ,
                  ) ,
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView( $id )
    {
        $this->render( 'view' , array(
                  'model' => $this->loadModel( $id ) ,
        ) );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Service;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $this->_operate( $model );

        $this->render( 'create' , array(
                  'model' => $model ,
        ) );
    }

    function _operate( $model , $type = 'create' )
    {
        $result = array( 'status' => 0 , 'msg' => '' );

        if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
        {
            if ( $type == 'create' )
            {
                $model->created = date( 'Y-m-d H:m:s' , time() );
            }
            $model->attributes = $_POST['Service'];
            // validate user input and redirect to the previous page if valid
            if ( $model->save() )
            {
                $result['status'] = 1;
                $result['url'] = 'index.php?r=service';
                $result['msg'] = $type == 'create' ? '联运商添加成功!' : '联运商修改成功';
            }
            else
            {
                $res = CActiveForm::validate( $model );
                $res_array = json_decode( $res , true );
                $result['msg'] = current( $res_array );
            }
            echo json_encode( $result );
            Yii::app()->end();
            exit;
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate( $id )
    {
        $model = $this->loadModel( $id );

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $result = array( 'status' => 0 , 'msg' => '' );
        $this->_operate( $model , 'update' );

        $this->render( 'update' , array(
                  'model' => $model ,
        ) );
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete( $id )
    {
        $this->loadModel( $id )->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if ( !isset( $_GET['ajax'] ) )
            $this->redirect( isset( $_POST['returnUrl'] ) ? $_POST['returnUrl'] : array( 'index' )  );
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider( 'Service' );
        $this->render( 'index' , array(
                  'dataProvider' => $dataProvider ,
        ) );
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Service( 'search' );
        $model->unsetAttributes();  // clear any default values
        if ( isset( $_GET['Service'] ) )
            $model->attributes = $_GET['Service'];

        $this->render( 'admin' , array(
                  'model' => $model ,
        ) );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Service the loaded model
     * @throws CHttpException
     */
    public function loadModel( $id )
    {
        $model = Service::model()->findByPk( $id );
        if ( $model === null )
            throw new CHttpException( 404 , 'The requested page does not exist.' );
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Service $model the model to be validated
     */
    protected function performAjaxValidation( $model )
    {
        if ( isset( $_POST['ajax'] ) && $_POST['ajax'] === 'service-form' )
        {
            echo CActiveForm::validate( $model );
            Yii::app()->end();
        }
    }

}
