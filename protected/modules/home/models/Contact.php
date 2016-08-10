<?php

/**
 * Contact class.
 * Contact is the data structure for keeping
 * contact form data. It is used by the 'contact' action of home module 'DefaultController'.
 */
class Contact extends CFormModel
{
	public $name;
	public $email;
	public $subject;
	public $message;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// required fields
			array('name, email, subject, message', 'required'),
			// email needs to be a email
			array('email', 'email'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'name'=>'Name',
			'email' => 'Email',
			'subject' => 'Subject',
			'message' => 'Message'
		);
	}
}
