<?php
/**
 * This is the model class for table "{{prikol_poltava_images_set}}".
 *
 * The followings are the available columns in table '{{prikol_poltava_images_set}}':
 * @property string $id
 * @property string $poltava_id
 * @property string $title
 * @property string $add_time
 * @property string $views_count
 * @property string $view_last_time
 * @property integer $marked
 */
class PoltavaImagesSets extends CActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{poltava_images_sets}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('poltava_id, views_count, view_last_time', 'required'),
			// array('marked', 'numerical', 'integerOnly'=>true),
			// array('poltava_id, views_count', 'length', 'max'=>10),
			// array('title', 'length', 'max'=>255),
			// array('add_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, poltava_id, title, add_time, views_count, view_last_time, marked', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'mainImage' => array(self::BELONGS_TO, 'PoltavaImages', 'main_image_id'),
			'images' => array(self::HAS_MANY, 'PoltavaImages', 'set_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'poltava_id' => 'Poltava',
			'title' => 'Title',
			'add_time' => 'Add Time',
			'views_count' => 'Views Count',
			'view_last_time' => 'View Last Time',
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
		$criteria->compare('title', $this->title,true);
		$criteria->compare('add_time', $this->add_time,true);
		$criteria->compare('views_count', $this->views_count,true);
		$criteria->compare('view_last_time', $this->view_last_time,true);
		$criteria->compare('marked', $this->marked);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PrikolPoltavaImagesSetss the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * Получить limit случайных сетов
	 * @return PoltavaImagesSets[]
	 */
	static public function getRandomSets($limit = 5) {
		$sets = array();
		foreach (self::model()->findAll() as $s) {
				$sets[] = $s->id;
			}
		shuffle($sets);
		$ids = array_slice($sets, 0, $limit);
		return self::model()->findAll('id IN ('.implode(',', $ids).')');
	}

}
