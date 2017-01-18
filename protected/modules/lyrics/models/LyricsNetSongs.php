<?php
/**
 * This is the model class for table "{{lyricsnet_songs}}".
 *
 * The followings are the available columns in table '{{lyricsnet_songs}}':
 * @property string $id
 * @property string $lyricsnet_id
 * @property string $artist_id
 * @property string $album_id
 * @property string $title
 * @property string $lyrics
 */
class LyricsNetSongs extends CActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{lyricsnet_songs}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lyricsnet_id, artist_id, album_id, title', 'required'),
			array('lyricsnet_id, artist_id, album_id', 'length', 'max'=>10),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, lyricsnet_id, artist_id, album_id, title, lyrics', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'artist' => array(self::BELONGS_TO, 'LyricsNetArtists', 'artist_id'),
			'album' => array(self::BELONGS_TO, 'LyricsNetAlbums', 'album_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'lyricsnet_id' => 'Lyricsnet',
			'artist_id' => 'Artist',
			'album_id' => 'Album',
			'title' => 'Title',
			'lyrics' => 'Lyrics',
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
		$criteria->compare('lyricsnet_id', $this->lyricsnet_id,true);
		$criteria->compare('artist_id', $this->artist_id,true);
		$criteria->compare('album_id', $this->album_id,true);
		$criteria->compare('title', $this->title,true);
		$criteria->compare('lyrics', $this->lyrics,true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LyricsNetSongs the static model class
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
		return '/lyrics/eng/'.$block.'/'.$song_id;
	}

	public function scopes() {
		return array(
			'active' => array(
				'condition' => 'skipped = "0"',
			),
		);
	}
}
