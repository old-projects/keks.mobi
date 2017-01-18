<?php
/**
 * This is the model class for table "{{prikol_poltava_images}}".
 *
 * The followings are the available columns in table '{{prikol_poltava_images}}':
 * @property string $id
 * @property string $poltava_id
 * @property string $set_id
 * @property string $filename
 * @property string $filesize
 * @property integer $marked
 */
class PoltavaImages extends CActiveRecord {

	/**
	 * Используется для получения статистики
	 */
	public $total_images;
	public $total_images_size;

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{poltava_images}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('poltava_id, set_id, filename, filesize', 'required'),
			// array('marked', 'numerical', 'integerOnly'=>true),
			// array('poltava_id, set_id', 'length', 'max'=>10),
			// array('filename', 'length', 'max'=>255),
			// array('filesize', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, poltava_id, set_id, filename, filesize, marked', 'safe', 'on'=>'search'),
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
			'poltava_id' => 'Poltava',
			'set_id' => 'Set',
			'filename' => 'Filename',
			'filesize' => 'Filesize',
			'marked' => 'Marked',
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
		$criteria->compare('poltava_id', $this->poltava_id,true);
		$criteria->compare('set_id', $this->set_id,true);
		$criteria->compare('filename', $this->filename,true);
		$criteria->compare('filesize', $this->filesize,true);
		$criteria->compare('marked', $this->marked);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PrikolPoltavaImages the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * Возвратить путь до файла картинки относительно webroot в данном формате.
	 */
	public function getFilePath() {
		return Yii::app()->downloadsManager->filesDirectory.self::calculateImageFilename($this->id, 'jpg');
	}

	/**
	 * Возвратить путь до файла картинки относительно webroot в данном формате.
	 */
	public function getOriginalFilePath() {
		return Yii::app()->downloadsManager->filesDirectory.self::calculateImageFilename($this->id, $this->extension);
	}

	/**
	 * Возвратить путь до файла трека относительно webroot в данном формате.
	 */
	public function getSourceLink() {
		return 'http://poltava.info/static/prikol/'.$this->poltava_dir.'/'.$this->poltava_id.'.'.$this->extension;
	}	

	/**
	 * Возвращает стандартизованный путь до файла картинки.
	 */
	static public function calculateImageFilename($image_id, $extension) {
		$block = ceil($image_id / Yii::app()->getModule('images')->imagesBlockSize);
		return '/images/'.$block.'/'.$image_id.'.'.$extension;
	}

}
