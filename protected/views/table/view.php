<?php

//$this->widget( 'zii.widgets.CDetailView' , array(
//          'data' => $model ,
//          'attributes' => array(
//                    'id' ,
//                    'sid' ,
//                    'name' ,
//          ) ,
//) );

$this->widget( 'zii.widgets.grid.CGridView' , array(
          'dataProvider' => $dataProvider ,
          'template' => '{items}' ,
          'columns' => array(
                    'name' ,
                    'phone' ,
                    'personal_ID' ,
                    '备注' ,
//                    'category.name' , // display the 'name' attribute of the 'category' relation
//                    'content:html' , // display the 'content' attribute as purified HTML
//                    array( // display 'create_time' using an expression
//                              'name' => 'create_time' ,
//                              'value' => 'date("M j, Y", $data->create_time)' ,
//                    ) ,
//                    array( // display 'author.username' using an expression
//                              'name' => 'authorName' ,
//                              'value' => '$data->author->username' ,
//                    ) ,
//                    array( // display a column with "view", "update" and "delete" buttons
//                              'class' => 'CButtonColumn' ,
//                    ) ,
          ) ,
) );
?>