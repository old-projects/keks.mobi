<?php

/**
 * This is the model class for table "{{prime_music_categories}}".
 *
 * The followings are the available columns in table '{{prime_music_categories}}':
 * @property string $id
 * @property string $primemusic_id
 * @property string $name
 */
class PrimeMusicCategories extends CActiveRecord {
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{prime_music_categories}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('primemusic_id, name', 'required'),
			array('primemusic_id', 'length', 'max'=>10),
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, primemusic_id, name', 'safe', 'on'=>'search'),
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
			'primemusic_id' => 'Primemusic',
			'name' => 'Name',
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
		$criteria->compare('primemusic_id', $this->primemusic_id,true);
		$criteria->compare('name', $this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PrimeMusicCategories the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * 
	 */
	static public function getCategoriesForListBox() {
		$categories = array();
		foreach (self::model()->findAll() as $category) {
			$categories[$category->id] = $category->name;
		}
		return $categories;
	}
}
