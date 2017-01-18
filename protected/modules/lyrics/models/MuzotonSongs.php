<?php
/**
 * This is the model class for table "{{muzoton_songs}}".
 *
 * The followings are the available columns in table '{{muzoton_songs}}':
 * @property string $id
 * @property string $muzoton_id
 * @property string $muzoton_link_id
 * @property string $title
 * @property string $add_time
 * @property string $lyrics
 * @property string $parsed
 */
class MuzotonSongs extends CActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{muzoton_songs}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('muzoton_id, muzoton_link, muzoton_title', 'required'),
			array('muzoton_id', 'length', 'max'=>10),
			array('muzoton_link, title, muzoton_title', 'length', 'max'=>255),
			array('parsed', 'length', 'max'=>1),
			array('add_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, muzoton_id, muzoton_link_id, title, add_time, lyrics, parsed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'artists' => array(self::MANY_MANY, 'MuzotonArtists', Yii::app()->db->tablePrefix.'muzoton_artists_songs(song_id, artist_id)')
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
			'muzoton_id' => 'Muzoton',
			'muzoton_link_id' => 'Muzoton Link',
			'title' => 'Title',
			'add_time' => 'Add Time',
			'lyrics' => 'Lyrics',
			'parsed' => 'Parsed',
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
		$criteria->compare('muzoton_id', $this->muzoton_id,true);
		$criteria->compare('muzoton_link_id', $this->muzoton_link_id,true);
		$criteria->compare('title', $this->title,true);
		$criteria->compare('add_time', $this->add_time,true);
		$criteria->compare('lyrics', $this->lyrics,true);
		$criteria->compare('parsed', $this->parsed,true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MuzotonSongs the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * Возвратить путь до файла текста.
	 */
	public function getPath() {
		return self::calculateSongFilename($this->id);
	}

	/**
	 * Возвращает стандартизованный путь до файла картинки.
	 */
	static public function calculateSongFilename($song_id) {
		$block = ceil($song_id / Yii::app()->getModule('lyrics')->songsPerBlock);
		return '/lyrics/rus/'.$block.'/'.$song_id;
	}

	public function scopes() {
		return array(
			'active' => array(
				'condition' => 'skipped = "0"',
			),
		);
	}
}
