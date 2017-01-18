<?php
/**
 * This is the model class for table "{{librusec_genres}}".
 *
 * The followings are the available columns in table '{{librusec_genres}}':
 * @property string $id
 * @property string $homelib_index
 * @property string $homelib_genre
 * @property string $parent_id
 * @property string $name
 */
class LibrusecGenres extends CActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{librusec_genres}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('homelib_index', 'length', 'max'=>20),
			array('name', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, homelib_index, homelib_genre, parent_id, name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'books' => array(self::MANY_MANY, 'LibrusecBooks', Yii::app()->db->tablePrefix.'librusec_genres_books(genre_id, book_id)'),
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
			'homelib_index' => 'Homelib Index',
			'homelib_genre' => 'Homelib Genre',
			'parent_id' => 'Parent',
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
		$criteria->compare('homelib_index', $this->homelib_index,true);
		$criteria->compare('homelib_genre', $this->homelib_genre,true);
		$criteria->compare('parent_id', $this->parent_id,true);
		$criteria->compare('name', $this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LibrusecGenres the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function defaultScope() {
		return array(
			'order' => 'name ASC',
		);
	}

	public function scopes() {
		return array(
			'main' => array(
				'condition' => 'homelib_genre = ""',
			),
		);
	}
}
