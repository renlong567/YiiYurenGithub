<?php

class GamesController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
                  'accessControl' , // perform access control for CRUD operations
                //'postOnly + delete' , // we only allow deletion via POST request
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
                  array( 'allow' , // allow all users to perform 'index' and 'view' actions
                            'actions' => array( '' ) ,
                            'users' => array( '*' ) ,
                  ) ,
                  array( 'allow' , // allow authenticated user to perform 'create' and 'update' actions
                            'actions' => array( 'index' , 'view' , 'update' , 'create' , 'delete' ) ,
                            'users' => array( '@' ) ,
                  ) ,
                  array( 'allow' , // allow admin user to perform 'admin' and 'delete' actions
                            'actions' => array( 'admin' ) ,
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
        $model = new Games;
        $this->_operate( $model );
        $this->render( 'create' , array(
                  'model' => $model ,
        ) );
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate( $id )
    {
        $model = $this->loadModel( $id );
        $this->_operate( $model , 'update' );
        $this->render( 'update' , array(
                  'model' => $model ,
        ) );
    }

    // 游戏操作函数
    function _operate( $model , $type = 'create' )
    {
        $result = array( 'status' => 0 , 'msg' => '' );

        if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
        {
            $model->attributes = $_POST['Games'];
            if ( $model->save() )
            {
                $result['status'] = 1;
                $result['url'] = 'index.php?r=games';
                $result['msg'] = $type == 'create' ? '游戏添加成功!' : '游戏修改成功';
            }
            else
            {
                $res = CActiveForm::validate( $model );
                $res_array = json_decode( $res , true );
                $result['msg'] = current( $res_array );
            }
            echo json_encode( $result );
            Yii::app()->end();
        }
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
        $dataProvider = new CActiveDataProvider( 'Games' );
        $this->render( 'index' , array(
                  'dataProvider' => $dataProvider ,
        ) );
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Games( 'search' );
        $model->unsetAttributes();  // clear any default values
        if ( isset( $_GET['Games'] ) )
            $model->attributes = $_GET['Games'];

        $this->render( 'admin' , array(
                  'model' => $model ,
        ) );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Games the loaded model
     * @throws CHttpException
     */
    public function loadModel( $id )
    {
        $model = Games::model()->findByPk( $id );
        if ( $model === null )
            throw new CHttpException( 404 , 'The requested page does not exist.' );
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Games $model the model to be validated
     */
    protected function performAjaxValidation( $model )
    {
        if ( isset( $_POST['ajax'] ) && $_POST['ajax'] === 'games-form' )
        {
            echo CActiveForm::validate( $model );
            Yii::app()->end();
        }
    }

}
