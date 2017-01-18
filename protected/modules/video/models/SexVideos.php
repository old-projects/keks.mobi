<?php

/**
 * This is the model class for table "{{sex_videos}}".
 *
 * The followings are the available columns in table '{{sex_videos}}':
 * @property string $id
 * @property string $name
 * @property string $erovideo_id
 * @property integer $marked
 * @property string $filesize
 */
class SexVideos extends CActiveRecord {
	public $marked = 0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{sex_videos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, category_id, erovideo_id', 'required'),
			// array('marked', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>250),
			array('erovideo_id', 'length', 'max'=>10),
			// array('filesize', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, erovideo_id, marked, filesize', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'name' => 'Name',
			'erovideo_id' => 'Erovideo',
			'marked' => 'Marked',
			'filesize' => 'Filesize',
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

		$criteria->compare('id', $this->id,true);
		$criteria->compare('name', $this->name,true);
		$criteria->compare('erovideo_id', $this->erovideo_id,true);
		$criteria->compare('marked', $this->marked);
		$criteria->compare('filesize', $this->filesize,true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SexVideos the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
