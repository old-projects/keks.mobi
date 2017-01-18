<?php
/**
 * This is the model class for table "{{muzoton_artists}}".
 *
 * The followings are the available columns in table '{{muzoton_artists}}':
 * @property string $id
 * @property string $muzoton_tag
 * @property string $muzoton_link_id
 * @property string $muzoton_name
 * @property string $name
 * @property integer $songs_count
 */
class MuzotonArtists extends CActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{muzoton_artists}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('muzoton_tag, muzoton_name, name', 'required'),
			array('songs_count', 'numerical', 'integerOnly' => true),
			array('muzoton_tag, muzoton_name, name', 'length', 'max' => 255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, muzoton_tag, muzoton_name, name, songs_count', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'songs' => array(self::MANY_MANY, 'MuzotonSongs', Yii::app()->db->tablePrefix.'muzoton_artists_songs(artist_id, song_id)')
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
			'muzoton_tag' => 'Muzoton Tag',
			'muzoton_link_id' => 'Muzoton Link',
			'muzoton_name' => 'Muzoton Name',
			'name' => 'Name',
			'songs_count' => 'Songs Count',
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
		$criteria->compare('muzoton_tag', $this->muzoton_tag,true);
		$criteria->compare('muzoton_link_id', $this->muzoton_link_id,true);
		$criteria->compare('muzoton_name', $this->muzoton_name,true);
		$criteria->compare('name', $this->name,true);
		$criteria->compare('songs_count', $this->songs_count);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MuzotonArtists the static model class
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
