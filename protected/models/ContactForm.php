<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel
{
	public $name;
	public $email;
	public $body;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('body, verifyCode', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
		);
	}

	public function attributeLabels()
	{
		return array(
			'name' => 'Ваше имя (никнейм)',
			'email' => 'Обратный адрес для ответа',
			'body' => 'Сообщение',
			'verifyCode' => 'Код подтверждения',
		);
	}

	public function attributeDescriptions()
	{
		return array(
			'email' => 'Можете ввести, если ожидаете ответа на ваше предложение или вопрос.',
			'verifyCode' => 'Введите символы, изображённые на картинке. Регистр не имеет значения.',
		);
	}
}