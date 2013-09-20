<?php

/**
 * This is the model class for table "userinbox".
 *
 * The followings are the available columns in table 'userinbox':
 * @property integer $userinboxid
 * @property integer $useraccessid
 * @property string $messages
 * @property integer $recordstatus
 */
class Userinbox extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Userinbox the static model class
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
		return 'userinbox';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userinboxid, username, usermessages, recordstatus', 'required'),
			array('userinboxid, recordstatus', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userinboxid, username, userfrom, usermessages, recordstatus', 'safe', 'on'=>'search'),
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
			'userinboxid' => 'ID',
			'username' => 'User',
			'userfrom' => 'Sender',
			'usermessages' => 'Messages',
			'inboxdatetime' => 'Date Time',
			'recordstatus' => 'Record Status',
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
		$criteria->order='inboxdatetime desc';
		$criteria->condition="username = '".Yii::app()->user->id."'";
		$criteria->compare('userinboxid',$this->userinboxid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('userfrom',$this->userfrom,true);
		$criteria->compare('usermessages',$this->usermessages,true);
		$criteria->compare('inboxdatetime',$this->inboxdatetime,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}

	public function behaviors()
  {
    return array(
        // Classname => path to Class
        'ActiveRecordLogableBehavior'=>
            'application.behaviors.ActiveRecordLogableBehavior'
    );
  }
}