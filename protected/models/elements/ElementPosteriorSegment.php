<?php

/**
 * This is the model class for table "element_posterior_segment".
 *
 * The followings are the available columns in table 'element_posterior_segment':
 * @property string $id
 * @property string $event_id
 * @property string $value
 */
class ElementPosteriorSegment extends BaseElement
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ElementHPC the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'element_posterior_segment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, event_id, description_left, description_right, image_string_left, image_string_right', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, description_left, description_right, image_string_left, image_string_right', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
			'description_left' => 'Description (left)',
			'description_right' => 'Description (right)',
			'image_string_left' => 'EyeDraw (left)',
			'image_string_right' => 'EyeDraw (right)'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('event_id',$this->event_id,true);
		$criteria->compare('description_left',$this->description_left,true);
		$criteria->compare('description_right',$this->description_right,true);
		$criteria->compare('image_string_left',$this->image_string_left,true);
		$criteria->compare('image_string_right',$this->image_string_right,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
