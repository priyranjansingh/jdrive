<?php


/**
 * Bg class.
 * Bg is the data structure for keeping
 * username of a particular user.
 */
class Bg extends CFormModel {

    public $profile;
    
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            array('profile', 'required'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'profile' => "Profile Background",
        );
    }
    
       

}
