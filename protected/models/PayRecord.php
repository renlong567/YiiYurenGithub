<?php

/**
 * This is the model class for table "pay_record".
 *
 * The followings are the available columns in table 'pay_record':
 * @property string $id
 * @property string $sid
 * @property integer $gameId
 * @property integer $serverid
 * @property string $userId
 * @property string $orderNo
 * @property integer $rmb
 * @property string $paytime
 */
class PayRecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PayRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pay_record';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sid, gameId, serverid, userId, orderNo, rmb, paytime', 'required'),
			array('gameId, serverid, rmb', 'numerical', 'integerOnly'=>true),
			array('sid', 'length', 'max'=>10),
			array('userId', 'length', 'max'=>16),
			array('orderNo', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sid, gameId, serverid, userId, orderNo, rmb, paytime', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sid' => '联运ID',
			'gameId' => '游戏ID',
			'serverid' => '区服ID',
			'userId' => '用户ID',
			'orderNo' => '订单号',
			'rmb' => '充值金额',
			'paytime' => '充值时间',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('sid',$this->sid,true);
		$criteria->compare('gameId',$this->gameId);
		$criteria->compare('serverid',$this->serverid);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('orderNo',$this->orderNo,true);
		$criteria->compare('rmb',$this->rmb);
		$criteria->compare('paytime',$this->paytime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}