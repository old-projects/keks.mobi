<?php
/**
 * This is the model class for table "{{librusec_authors}}".
 *
 * The followings are the available columns in table '{{librusec_authors}}':
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $patronymic
 * @property string $nickname
 */
class LibrusecAuthors extends CActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{librusec_authors}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('full_name', 'required'),
			array('full_name', 'length', 'max'=>255),
			array('first_name, middle_name, last_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, first_name, last_name, patronymic, nickname', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'books' => array(self::MANY_MANY, 'LibrusecBooks', Yii::app()->db->tablePrefix.'librusec_authors_books(author_id, book_id)'),
		);
	}

	public function behaviors(){
		return array(
			'ESaveRelatedBehavior' => array(
				'class' => 'application.components.ESaveRelatedBehavior'
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'patronymic' => 'Patronymic',
			'nickname' => 'Nickname',
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
		$criteria->compare('first_name', $this->first_name,true);
		$criteria->compare('last_name', $this->last_name,true);
		$criteria->compare('patronymic', $this->patronymic,true);
		$criteria->compare('nickname', $this->nickname,true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LibrusecAuthors the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
