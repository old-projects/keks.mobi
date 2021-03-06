<?php
/**
 * This is the model class for table "{{azlyrics_artists}}".
 *
 * The followings are the available columns in table '{{azlyrics_artists}}':
 * @property string $id
 * @property string $azlyrics_tag
 * @property string $name
 */
class AzlyricsArtists extends CActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{azlyrics_artists}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('azlyrics_tag, name', 'required'),
			array('azlyrics_tag, name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, azlyrics_tag, name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'songs' => array(self::HAS_MANY, 'AzlyricsSongs', 'artist_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'azlyrics_tag' => 'Azlyrics Tag',
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
		$criteria->compare('azlyrics_tag', $this->azlyrics_tag,true);
		$criteria->compare('name', $this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AzlyricsArtists the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
