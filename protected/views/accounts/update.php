<?php

/* @var $this AccountsController */
/* @var $model Accounts */

$this->breadcrumbs = array(
          'Accounts' => array( 'index' ) ,
          $model->name => array( 'view' , 'id' => $model->id ) ,
          'Update' ,
);
?>

<?php echo $this->renderPartial( 'create' , array( 'model' => $model ) ); ?>