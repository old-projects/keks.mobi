<?php
/**
 * This is the model class for table "{{online}}".
 *
 * The followings are the available columns in table '{{online}}':
 * @property string $address
 * @property string $user_agent
 * @property string $refresh_last_time
 * @property string $refreshes_count
 * @property string $query
 * @property string $referer
 */
class Online extends CActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{online}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('address, user_agent, refreshes_count, query', 'required'),
			array('address', 'length', 'max' => 20),
			array('refreshes_count', 'length', 'max' => 10),
			array('refresh_last_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('address, user_agent, refresh_last_time, refreshes_count, query, referrer', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'address' => 'Address',
			'user_agent' => 'User Agent',
			'refresh_last_time' => 'Refresh Last Time',
			'refreshes_count' => 'Refreshes Count',
			'query' => 'Query',
			'referer' => 'Referer',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('address', $this->address,true);
		$criteria->compare('user_agent', $this->user_agent,true);
		$criteria->compare('refresh_last_time', $this->refresh_last_time,true);
		$criteria->compare('refreshes_count', $this->refreshes_count,true);
		$criteria->compare('query', $this->query,true);
		$criteria->compare('referer', $this->referer,true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Online the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function scopes() {
		return array(
			'active' => array(
				'condition' => 'refresh_last_time >= SUBDATE(NOW(), INTERVAL :minutes MINUTE)',
				'params' => array(':minutes' => Yii::app()->params['online_active_limit']),
			),
			'bots' => array(
				'condition' => 'is_bot = "1"',
			),
			'users' => array(
				'condition' => 'is_bot = "0"',
			),
		);
	}
}
