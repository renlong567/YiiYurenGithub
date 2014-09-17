<?php

/**
 * This is the model class for table "gameservice".
 *
 * The followings are the available columns in table 'gameservice':
 * @property string $idx
 * @property string $sid
 * @property string $gameid
 * @property string $key
 * @property string $created_time
 *
 * The followings are the available model relations:
 * @property Games $game
 * @property Service $s
 */
class Gameservice extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Gameservice the static model class
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
        return 'gameservice';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                  array( 'sid, gameid, key, created_time' , 'required' ) ,
                  array( 'sid, gameid' , 'length' , 'max' => 10 ) ,
                  array( 'key' , 'length' , 'max' => 64 ) ,
                  // The following rule is used by search().
                  // Please remove those attributes that should not be searched.
                  array( 'idx, sid, gameid, key, created_time' , 'safe' , 'on' => 'search' ) ,
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
                  'games' => array( self::BELONGS_TO , 'Games' , 'gameid' ) ,
                  'service' => array( self::BELONGS_TO , 'Service' , 'sid' ) ,
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
                  'idx' => 'Idx' ,
                  'sid' => 'Sid' ,
                  'gameid' => 'Gameid' ,
                  'key' => '密钥' ,
                  'created_time' => '创建时间' ,
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

        $criteria->compare( 'idx' , $this->idx , true );
        $criteria->compare( 'sid' , $this->sid , true );
        $criteria->compare( 'gameid' , $this->gameid , true );
        $criteria->compare( 'key' , $this->key , true );
        $criteria->compare( 'created_time' , $this->created_time , true );

        return new CActiveDataProvider( $this , array(
                          'criteria' => $criteria ,
                ) );
    }

}