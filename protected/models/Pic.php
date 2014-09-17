<?php

/**
 * This is the model class for table "pic".
 *
 * The followings are the available columns in table 'pic':
 * @property integer $id
 * @property integer $sid
 * @property integer $name
 * @property string $created_time
 * @property string $mini_pic
 * @property string $big_pic
 *
 * The followings are the available model relations:
 * @property Unit $s
 */
class Pic extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Pic the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'pic';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public $image;

    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                  //array( 'big_pic' , 'required' ) ,
//                  array( 'sid,' , 'numerical' , 'integerOnly' => true ) ,
//                  array( 'mini_pic' , 'length' , 'max' => 32 ) ,
                  //array( 'big_pic' , 'length' , 'max' => 200 ) ,
                  array( 'big_pic' , 'file' , 'allowEmpty' => true , 'types' => 'jpg,jpeg,gif,png,bmp' ) ,
                  // The following rule is used by search().
                  // Please remove those attributes that should not be searched.
                  array( 'id, sid, name, created_time, mini_pic, big_pic' , 'safe' , 'on' => 'search' ) ,
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
                  's' => array( self::BELONGS_TO , 'Unit' , 'sid' ) ,
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
                  'id' => 'ID' ,
                  'sid' => 'Sid' ,
                  'name' => 'Name' ,
                  'created_time' => 'Created Time' ,
                  'mini_pic' => 'Mini Pic' ,
                  'big_pic' => '图片' ,
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

        $criteria->compare( 'id' , $this->id );
        $criteria->compare( 'sid' , $this->sid );
        $criteria->compare( 'name' , $this->name );
        $criteria->compare( 'created_time' , $this->created_time , true );
        $criteria->compare( 'mini_pic' , $this->mini_pic , true );
        $criteria->compare( 'big_pic' , $this->big_pic , true );

        return new CActiveDataProvider( $this , array(
                  'criteria' => $criteria ,
                ) );
    }

}