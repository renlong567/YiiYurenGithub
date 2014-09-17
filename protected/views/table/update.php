<?php

/* @var $this TableController */
/* @var $model Table */

$this->breadcrumbs = array(
          'Table' => array( 'index' ) ,
          $model->name => array( 'view' , 'id' => $model->id ) ,
          'Update' ,
);
?>

<?php echo $this->renderPartial( 'create' , array( 'model' => $model ) ); ?>