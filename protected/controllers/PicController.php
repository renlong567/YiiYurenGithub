<?php

class PicController extends Controller
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
                  array( 'allow' , // allow all users to perform 'index' and 'view' actions
                            'actions' => array( '' ) ,
                            'users' => array( '*' ) ,
                  ) ,
                  array( 'allow' , // allow authenticated user to perform 'create' and 'update' actions
                            'actions' => array( 'create' , 'update' , 'index' , 'view' ) ,
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
        $model = new Pic;
        if ( isset( $_POST['Pic'] ) )
        {
            $image = CUploadedFile::getInstances( $model , 'big_pic' );
            $is_fail = true;
            foreach ( $image as $img )
            {
                $model->created_time = date( "Y-m-d H:i:s" );
                $microtime = microtime( true );
                $model->big_pic = './images/pic/' . $microtime . '.' . $img->extensionName;
                $mini_path = $this->create_mini_pic( $img->tempName , $microtime );
                $model->mini_pic = $mini_path;
                if ( $model->save() )
                {
                    $is_fail = false;
                    $img->saveAs( $model->big_pic );
                }
                else
                    print_r( $model->getErrors() );
            }
            
            if ( !$is_fail )
            {
                $this->redirect( array( 'index' ) );
            }
        }

        $this->render( 'create' , array( 'model' => $model ) );
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

        if ( isset( $_POST['Pic'] ) )
        {
            $model->attributes = $_POST['Pic'];
            if ( $model->save() )
                $this->redirect( array( 'view' , 'id' => $model->id ) );
        }

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
            $this->redirect( array( 'index' ) );
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider( 'Pic' , array( 'pagination' => false ) );
        if ( $dataProvider->getData() == NULL )
        {
            $this->render( 'index' , array(
                      'pic_data' => '<div style="margin:50px;">还没有图片</div>' ,
            ) );
        }
        else
        {
            $this->render( 'index' , array(
                      'pic_data' => $dataProvider->getData( true ) ,
            ) );
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Pic( 'search' );
        $model->unsetAttributes();  // clear any default values
        if ( isset( $_GET['Pic'] ) )
            $model->attributes = $_GET['Pic'];

        $this->render( 'admin' , array(
                  'model' => $model ,
        ) );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Pic the loaded model
     * @throws CHttpException
     */
    public function loadModel( $id )
    {
        $model = Pic::model()->findByPk( $id );
        if ( $model === null )
            throw new CHttpException( 404 , 'The requested page does not exist.' );
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Pic $model the model to be validated
     */
    protected function performAjaxValidation( $model )
    {
        if ( isset( $_POST['ajax'] ) && $_POST['ajax'] === 'pic-form' )
        {
            echo CActiveForm::validate( $model );
            Yii::app()->end();
        }
    }

    /**
     * @name 			create_mini_pic
     * @desc			生成微缩图
     * @author 			Ren Long
     * @date			2013-08-11
     * @return 			string
     */
    protected function create_mini_pic( $image , $name = '' )
    {
        header( "Content-Type: text/html;charset=utf-8" );
//        $mini_width = 181;
        $mini_height = 300;
        $im_info = getimagesize( $image );
        switch ( $im_info[2] )       //判断图片类型
        {
            case 1:
                $src_image = imagecreatefromgif( $image );
                break;
            case 2:
                $src_image = imagecreatefromjpeg( $image );
                break;
            case 3:
                $src_image = imagecreatefrompng( $image );
                break;
            case 6:
                $src_image = imagecreatefrombmp( $image );
                break;
        }
        $temp = $mini_height / $im_info[1];
        $new_w = $im_info[0] * $temp;
        $new_h = $mini_height;

        //生成文字水印
//             $mark = imagecolorallocate($mini_image);
//             $text = iconv("gbk", "utf-8", "renlong.ouzhe.com");
//             imagettftext($mini_image, 12, 0, 20, 20, $mark, '黑体', $text);
        $mini_image = imagecreatetruecolor( $new_w , $new_h );
//        $mini_bg = imagecolorallocate( $mini_image , 255 , 0 , 0 );
//        imagefill($mini_image, 0, 0, $mini_bg);
        imagecopyresized( $mini_image , $src_image , 0 , 0 , 0 , 0 , $new_w , $new_h , $im_info[0] , $im_info[1] );
        imagepng( $mini_image , "images/pic/mini/" . $name . ".png" );
        $image_mini_add = "images/pic/mini/" . $name . ".png";
        return $image_mini_add;
    }

}
