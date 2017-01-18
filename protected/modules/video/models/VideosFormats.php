<?php
/**
 * This is the model class for table "{{videos_formats}}".
 *
 * The followings are the available columns in table '{{videos_formats}}':
 * @property string $id
 * @property string $youtube_itag
 * @property string $youtube_type
 * @property string $youtube_quality
 * @property string $format
 * @property string $filesize
 * @property string $download_last_time
 * @property string $downloads_count
 */
class VideosFormats extends CActiveRecord {

	const
		FORMAT_3GP = '3gp',
		FORMAT_MP4 = 'mp4',
		FORMAT_FLV = 'flv',
		FORMAT_WEBM = 'webm';

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{videos_formats}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('youtube_itag, youtube_type, youtube_quality, format', 'required'),
			array('youtube_itag', 'length', 'max' => 3),
			array('youtube_type', 'length', 'max' => 250),
			array('youtube_quality', 'length', 'max' => 6),
			array('format', 'length', 'max' => 4),
			array('filesize', 'length', 'max' => 20),
			array('downloads_count', 'length', 'max' => 10),
			array('download_last_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, youtube_itag, youtube_type, youtube_quality, format, filesize, download_last_time, downloads_count', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'video' => array(self::BELONGS_TO, 'Videos', 'video_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'youtube_itag' => 'Youtube Itag',
			'youtube_type' => 'Youtube Type',
			'youtube_quality' => 'Youtube Quality',
			'format' => 'Format',
			'filesize' => 'Filesize',
			'download_last_time' => 'Download Last Time',
			'downloads_count' => 'Downloads Count',
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

		$criteria->compare('id', $this->id, true);
		$criteria->compare('youtube_itag', $this->youtube_itag, true);
		$criteria->compare('youtube_type', $this->youtube_type, true);
		$criteria->compare('youtube_quality', $this->youtube_quality, true);
		$criteria->compare('format', $this->format, true);
		$criteria->compare('filesize', $this->filesize, true);
		$criteria->compare('download_last_time', $this->download_last_time, true);
		$criteria->compare('downloads_count', $this->downloads_count, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VideosFormats the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
