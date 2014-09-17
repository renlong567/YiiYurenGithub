<style>
    table
    {
        border: 1px solid black;
        width:auto;
        text-align: center;
    }
    .header
    {
        text-align: center;
    }
    #test-grid
    {
        margin:0 0 20px 20px;
        width: auto;
        float: left;
    }
    .beizhu
    {
        width: 100px;
    }
    td
    {
        border: 1px solid black;
    }
</style>
<button name="excel">生成EXCEL文件</button>
<?php
echo '<h2 class="header">' . $title . '</h2>';
foreach($data as $key => $d):
    $this->widget('zii.widgets.grid.CGridView',array(
        'id' => 'test-grid',
        'dataProvider' => $d,
        'ajaxUpdate' => false,
        //'filter'=>$model,
//          'summaryCssClass'=>'sum1',
        'itemsCssClass' => 'sum1',
//          'rowCssClass'=>'sum1',
        'template' => "<div class='header'>第 $key 组</div>{summary}{items}",
        'columns' => array(
            'name',
            'sex',
            'phone',
            'personal_ID',
            array(
                'name' => '备注',
                'htmlOptions' => array('class' => 'beizhu'),
            ),
        ),
    ));
endforeach;
?>