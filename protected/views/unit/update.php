<?php

$this->breadcrumbs = array(
          'Unit' => array( 'index' ) ,
          $model->name => array( 'view' , 'id' => $model->id ) ,
          'Update' ,
);
?>

<?php echo $this->renderPartial( 'create' , array( 'model' => $model ) ); ?>