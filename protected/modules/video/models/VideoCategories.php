<?php

/**
 * This is the model class for table "{{video_categories}}".
 *
 * The followings are the available columns in table '{{video_categories}}':
 * @property integer $id
 * @property string $name
 * @property string $youtube_name
 * @property integer $deprecated
 */
class VideoCategories extends CActiveRecord {

	public $deprecated = 1;

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{video_categories}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, youtube_name', 'required'),
			array('deprecated', 'in', 'range' => array(0, 1)),
			array('name, youtube_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, youtube_name, deprecated', 'safe', 'on'=>'search'),
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
			'youtube_name' => 'Youtube Name',
			'deprecated' => 'Deprecated',
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

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name,true);
		$criteria->compare('youtube_name', $this->youtube_name,true);
		$criteria->compare('deprecated', $this->deprecated);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VideoCategories the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	/**
	 * 
	 */
	static public function getCategoriesForListBox() {
		$categories = array();
		foreach (self::model()->findAllByAttributes(array('deprecated' => 0)) as $category) {
			$categories[$category->id] = $category->name;
		}
		return $categories;
	}
}
