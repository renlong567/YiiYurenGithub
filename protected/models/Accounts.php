<?php

/**
 * This is the model class for table "accounts".
 *
 * The followings are the available columns in table 'accounts':
 * @property string $id
 * @property string $sid
 * @property string $name
 * @property string $sex
 * @property string $phone
 * @property string $personal_ID
 *
 * The followings are the available model relations:
 * @property Service $s
 */
class Accounts extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Accounts the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'accounts';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name,sid','required'),
            array('name','length','max' => 16),
            array('sex','length','max' => 4),
            array('phone','length','max' => 16),
            array('personal_ID','length','max' => 18),
            array('personal_ID','unique','message' => '此{attribute}{value}已存在。'),
            array('sid','numerical','integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, sid, name, sex, phone, personal_ID','safe','on' => 'search'),
                /*
                  Here's a list of many placeholders and the validators that are using them:

                  boolean: CBooleanValidator 的别名， 确保特性有一个 CBooleanValidator::trueValue 或 CBooleanValidator::falseValue 值。
                  captcha: CCaptchaValidator 的别名，确保特性值等于 CAPTCHA 中显示的验证码。
                  compare: CCompareValidator 的别名，确保特性等于另一个特性或常量。
                  email: CEmailValidator 的别名，确保特性是一个有效的Email地址。
                  default: CDefaultValueValidator 的别名，指定特性的默认值。
                  exist: CExistValidator 的别名，确保特性值可以在指定表的列中可以找到。
                  file: CFileValidator 的别名，确保特性含有一个上传文件的名字。
                  filter: CFilterValidator 的别名，通过一个过滤器改变此特性。
                  in: CRangeValidator 的别名，确保数据在一个预先指定的值的范围之内。
                  length: CStringValidator 的别名，确保数据的长度在一个指定的范围之内。
                  match: CRegularExpressionValidator 的别名，确保数据可以匹配一个正则表达式。
                  numerical: CNumberValidator 的别名，确保数据是一个有效的数字。
                  required: CRequiredValidator 的别名，确保特性不为空。
                  type: CTypeValidator 的别名，确保特性是指定的数据类型。
                  unique: CUniqueValidator 的别名，确保数据在数据表的列中是唯一的。
                  url: CUrlValidator 的别名，确保数据是一个有效的 URL。

                  CBooleanValidator: {true} {false}
                  CCaptchaValidator: {id}
                  CCompareValidator: {compareAttribute} {compareValue} {operator}
                  CExistValidator: {table} {column} {value}
                  CFileValidator: {file} {limit} {extensions}
                  CNumberValidator: {min} {max}
                  CRequiredValidator: {value}
                  CStringValidator: {min} {max} {length}
                  CTypeValidator: {type}
                  CUniqueValidator: {table} {column} {value}
                  CUrlValidator: {schemes}

                  Of course, {attribute} is known in all validators. So, which placeholders are known depends on the validator and the condition as well: By default {min} is only used when the value is below the min value (as defined in rules) and {max} when the value is above the max value.
                 */
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'unit' => array(self::BELONGS_TO,'unit','sid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => '成员ID',
            'sid' => '所属部门',
            'name' => '姓名',
            'sex' => '性别',
            'phone' => '电话',
            'personal_ID' => '身份证号',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id',$this->id,true);
        $criteria->compare('sid',$this->sid,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('sex',$this->sex,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('personal_ID',$this->personal_ID,true);
        return new CActiveDataProvider($this,array(
            'criteria' => $criteria,
                ));
    }

    public function getUsercount()
    {
        $unit_model = Unit::model();
        $acc_model = Accounts::model();
        $data = array();
        foreach($unit_model->findAll() as $value)
        {
            $temp = $acc_model->findAll("sid=:sid",array(":sid" => $value->id));
            $unit_tmp = $unit_model->find("id=:id",array(":id" => $value->id));
            $data[] = array($unit_tmp->name,count($temp));
        }
        return $data;
    }

    public function create_table()
    {
        echo <<<ETO
		<html>
			<head>
				<title></title>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<style>
					 *
					 {
						 text-align:center;
					 }
					table
					 {
						 width:auto;
						 float:left;
						 margin:0 0 20px 20px;
						 font-size:15px;
					 }
				</style>
			</head>
            <body>
ETO;
        echo '<div style="text-align:left;">' . CHtml::link('保存为Excel文件','index.php?r=table/excel') . '</div>';
        if(!empty($_REQUEST['team_title']))
        {
            echo "<h2>";
            echo $_REQUEST['team_title'];
            echo "</h2>";
        }

        if(isset($_POST['group']))
        {
            foreach($_REQUEST['group'] as $team_id => $team_member)
            {
                echo <<<ETO
                <table border=1>
                <tr>
                <td colspan="4">
ETO;
                echo '第' . $team_id . '组';
                echo <<<ETO
                </td>
                </tr>
                <tr>
                <td>姓名</td>
                <td>电话</td>
                <td>身份证号</td>
                <td>备注</td>
                </tr>
ETO;
                $criteria = new CDbCriteria;
                $criteria->addInCondition('id',$team_member);
                $data = Accounts::model()->findAll($criteria);
                /*
                 * 相关资料
                  $criteria = new CDbCriteria;
                  $criteria->addCondition("id=1"); //查询条件，即where id = 1
                  $criteria->addInCondition('id', array(1,2,3,4,5)); //代表where id IN (1,23,,4,5,);
                  $criteria->addNotInCondition('id', array(1,2,3,4,5));//与上面正好相法，是NOT IN
                  $criteria->addCondition('id=1','OR');//这是OR条件，多个条件的时候，该条件是OR而非AND
                  $criteria->addSearchCondition('name', '分类');//搜索条件，其实代表了。。where name like '%分类%'
                  $criteria->addBetweenCondition('id', 1, 4);//between 1 and 4

                  $criteria->compare('id', 1);    //这个方法比较特殊，他会根据你的参数自动处理成addCondition或者addInCondition，
                  //即如果第二个参数是数组就会调用addInCondition

                  //传递变量

                  $criteria->addCondition("id = :id");
                  $criteria->params[':id']=1;

                  //一些public vars

                  $criteria->select = 'id,parentid,name'; //代表了要查询的字段，默认select='*';
                  $criteria->join = 'xxx'; //连接表
                  $criteria->with = 'xxx'; //调用relations
                  $criteria->limit = 10;    //取1条数据，如果小于0，则不作处理
                  $criteria->offset = 1;   //两条合并起来，则表示 limit 10 offset 1,或者代表了。limit 1,10
                  $criteria->order = 'xxx DESC,XXX ASC'; //排序条件
                  $criteria->group = 'group 条件';
                  $criteria->having = 'having 条件 ';
                  $criteria->distinct = FALSE; //是否唯一查询
                 */

                foreach($data as $value)
                {
                    echo <<<ETO
                    <tr>
                    <td>$value[name]</td>
                    <td>$value[phone]</td>
                    <td>$value[personal_ID]</td>
                    <td></td>
                    </tr>
ETO;
                }
                echo "</table></body></html>";
            }
        }
    }

}