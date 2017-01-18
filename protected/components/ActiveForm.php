<?php
class ActiveForm extends CActiveForm {
	public function description($model, $attribute) {
		$descriptions = $model->attributeDescriptions();
		if (isset($descriptions[$attribute])) {
			return CHtml::tag('div', array('class' => 'description'), $descriptions[$attribute]);
		}
	}
}