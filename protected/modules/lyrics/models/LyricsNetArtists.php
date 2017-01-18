<?php
/**
 * This is the model class for table "{{lyricsnet_artists}}".
 *
 * The followings are the available columns in table '{{lyricsnet_artists}}':
 * @property string $id
 * @property string $lyricsnet_id
 * @property string $lyricsnet_tag
 * @property string $name
 */
class LyricsNetArtists extends CActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{lyricsnet_artists}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lyricsnet_id, lyricsnet_tag, name', 'required'),
			array('lyricsnet_id', 'length', 'max'=>10),
			array('lyricsnet_tag, name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, lyricsnet_id, lyricsnet_tag, name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'albums' => array(self::HAS_MANY, 'LyricsNetAlbums', 'artist_id'),
			'songs' => array(self::HAS_MANY, 'LyricsNetSongs', 'artist_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'lyricsnet_id' => 'Lyricsnet',
			'lyricsnet_tag' => 'Lyricsnet Tag',
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
		$criteria->compare('lyricsnet_id', $this->lyricsnet_id,true);
		$criteria->compare('lyricsnet_tag', $this->lyricsnet_tag,true);
		$criteria->compare('name', $this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LyricsNetArtists the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function scopes() {
		return array(
			'alphabetically' => array(
				'order' => '`name` ASC',
			),
			'filled' => array(
				'condition' => 'songs_count > 0',
			),
		);
	}
}
