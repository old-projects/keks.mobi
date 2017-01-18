<?php
/**
 * This is the model class for table "{{librusec_books}}".
 *
 * The followings are the available columns in table '{{librusec_books}}':
 * @property string $id
 * @property string $genre_id
 * @property string $title
 * @property string $series
 * @property integer $series_number
 * @property string $librusec_id
 * @property string $fb2_filesize
 * @property string $add_time
 * @property string $language
 * @property integer $librusec_rate
 * @property string $_keywords
 */
class LibrusecBooks extends CActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{librusec_books}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('librusec_id', 'required'),
			array('series_number, librusec_rate', 'numerical', 'integerOnly'=>true),
			array('genre_id', 'length', 'max'=>10),
			array('title, series, _keywords', 'length', 'max'=>255),
			array('librusec_id, filesize', 'length', 'max'=>20),
			array('language', 'length', 'max'=>20),
			array('add_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, genre_id, title, series, series_number, librusec_id, fb2_filesize, add_time, language, librusec_rate, _keywords', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'genres' => array(self::MANY_MANY, 'LibrusecGenres', Yii::app()->db->tablePrefix.'librusec_genres_books(book_id, genre_id)'),
			'authors' => array(self::MANY_MANY, 'LibrusecAuthors', Yii::app()->db->tablePrefix.'librusec_authors_books(book_id, author_id)'),
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
			'genre_id' => 'Genre',
			'title' => 'Title',
			'series' => 'Series',
			'series_number' => 'Series Number',
			'librusec_id' => 'Librusec',
			'fb2_filesize' => 'Fb2 Filesize',
			'add_time' => 'Add Time',
			'language' => 'Language',
			'librusec_rate' => 'Librusec Rate',
			'_keywords' => 'Keywords',
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
		$criteria->compare('genre_id', $this->genre_id,true);
		$criteria->compare('title', $this->title,true);
		$criteria->compare('series', $this->series,true);
		$criteria->compare('series_number', $this->series_number);
		$criteria->compare('librusec_id', $this->librusec_id,true);
		$criteria->compare('fb2_filesize', $this->fb2_filesize,true);
		$criteria->compare('add_time', $this->add_time,true);
		$criteria->compare('language', $this->language,true);
		$criteria->compare('librusec_rate', $this->librusec_rate);
		$criteria->compare('_keywords', $this->_keywords,true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LibrusecBooks the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
